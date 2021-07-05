<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\PageRequest;
use App\Models\Post;
use Illuminate\Http\Request;

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
     * @param Request $pageRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrCreate($type, Post $page, PageRequest $pageRequest)
    {
        $data = $pageRequest->all();
        $fieldFiles = $pageRequest->file();

        if (isset($fieldFiles['fields'])) {
            foreach ($fieldFiles['fields'] as $key => $field) {
                $src = Helper::image($field);
                $data['fields'][$key] = $src;
            }
        }

        $data['type'] = $type;

        if (isset($data['cover']))
            $cover = Helper::image($data['cover']);

        if (isset($data['banner']))
            $banner = Helper::image($data['banner']);

        $data['cover'] = $cover ?? $page->cover;
        $data['banner'] = $banner ?? $page->banner;

        if (isset($data['images'])) {
            $images;
            $id = uniqid();
            foreach ($data['images'] as $image) {
                $src = Helper::image($image);

                $images[] = ['id' => $id++, 'src' => $src];
            }

            $data['images'] = array_merge($page->images ?? [], $images);
        }


        $page->fill($data)->save();

        return back()->with([
            'status' => 'success',
            'message' => __('Sayfa başarıyla güncellendi')
        ]);
    }

    /**
     * @param $type
     * @param Post $page
     * @param $imageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyImage($type, Post $page, $imageId)
    {
        $data = $page->images;

        foreach ($data as $key => $value) {
            if ($value['id'] == $imageId)
                $index = $key;
        }

        unset($data[$index]);
        $data = array_values($data);

        $page->update(['images' => $data]);
        // todo: if success, delete image file

        return response()->json([
            'status' => 'success',
            'message' => __('Görsel silindi')
        ]);
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($type, Post $page)
    {
        $page->delete();
        // todo: destroy images

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
