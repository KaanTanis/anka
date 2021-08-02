<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\PageRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $type = \request()->type;
        $pages = [];
        foreach (Helper::pages_details() as $pages_detail) {
            $pages[] = $pages_detail['method_name'];
        }

        if (! in_array($type, $pages))
            abort(404);
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($type)
    {
        $pages = Post::where('type', $type)->orderBy('order')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($type, Post $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param $type
     * @param Post $page
     * @param PageRequest $pageRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrCreate($type, Post $page, PageRequest $pageRequest)
    {
        $data = $pageRequest->all();
        $fieldFiles = $pageRequest->file();

        if (isset($fieldFiles['fields'])) { // Fields tablosuna gelen dosya varsa
            foreach ($fieldFiles['fields'] as $key => $field) { // dosyaları ayıkla
                if (is_array($data['fields'][$key])) { // dosya array ise
                    $bulk = $page->fields($key); // eski verileri aklında tut
                    $id = uniqid(); // rastgele id ver (silerken kolaylık)
                    foreach ($data['fields'][$key] as $arrayField) { // dosyaları tek tek al
                        $src = Helper::image($arrayField); // dosya sistemine ekle ve yolunu al
                        $bulk[] = ['id' => $id++, 'src' => $src]; // eski verilerle birleştir
                    }

                    $data['fields'][$key] = $bulk; // data[fields] içinde yeni verileri güncelle
                } else { // gelen dosya tek ise
                    $src = Helper::image($field); // dosya sistemine ekle ve yolunu al
                    $data['fields'][$key] = $src; // fields tablosuna input adıyla ekle
                }
            }
        }

        $data['type'] = $type;

        $oldFields = $page->fields; // eski verileri aklında tut
        $newDatas = $data['fields']; // yeni verileri yeni değişkene al

        foreach ($newDatas as $key => $value) { // yeni verileri al
            unset($oldFields[$key]); // Eski ve yeni verileri karşılaştır. Çakışanları sil
        }

        $merged = array_merge($oldFields, $newDatas); // Eski verilerden çakışmayanlarla, yeni çakışan verileri birleştir
        $data['fields'] = $merged; // fields tablosunu bu birleşen değere göre değiştir

        $page->fill($data)->save(); // veritabanına kaydet

        return back()->with([
            'status' => 'success',
            'message' => __('Sayfa başarıyla güncellendi')
        ]);
    }

    public function destroyArrayField($type, Post $post, $field, $arrayId)
    {
        $data = $post->fields;

        // gelen veri array olduğu için field[key] şeklinde geliyor. Keyi yakala
        $fieldName = Str::between($field, '[', ']');

        // yakalanan key'e göre array fieldini getir.
        foreach ($data[$fieldName] as $key => $value) {
            if ($value['id'] == $arrayId) // eğer gönderilen id, veritabanındakiyle eşleşirse
                $index = $key; // index numarasını al
        }
        unset($data[$fieldName][$index]); // yakalanan index numarasını field arrayından sil
        // todo: ya eğer index yoksa?

        $post->update(['fields' => $data]);

        return response()->json([
            'status' => 'success',
            'message' => __('Görsel silindi')
        ]);
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($type, Post $page)
    {
        $page->delete();
        // todo: destroy files

        return response()->json([
            'status' => 'success',
            'message' => __('Sayfa silindi'),
            'redirect' => route('admin.pages.index', \request()->type)
        ]);
    }

    public function destroySingleImage($type, Post $page)
    {
        if(\request()->table_name) {
            $page->update([\request()->table_name => null]);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('Silme işlemi başarılı'),
            /*'redirect' => route('admin.pages.edit', [
                'type' => \request()->type,
                'page' => $page->id
            ])*/
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request)
    {
        $order = 1;
        foreach ($request->all() as $item => $val) {
            Post::find($val)->update(['order' => $order++]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Sıralama güncellendi'
        ]);
    }
}
