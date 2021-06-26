<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use MongoDB\BSON\Type;

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
        if (! in_array($type, Helper::$pages))
            abort(404);
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($type)
    {
        $pages = Page::where('type', $type)->orderBy('order')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * @param $type
     * @param Page $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($type, Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param $type
     * @param Page $page
     * @param Request $pageRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrCreate($type, Page $page, PageRequest $pageRequest)
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
     * @param Page $page
     * @param $imageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyImage($type, Page $page, $imageId)
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
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($type, Page $page)
    {
        $page->delete();
        // todo: destroy images

        return response()->json([
            'status' => 'success',
            'message' => __('Sayfa silindi'),
            'redirect' => route('admin.pages.index', \request()->type)
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
            Page::find($val)->update(['order' => $order++]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Sıralama güncellendi'
        ]);
    }
}
