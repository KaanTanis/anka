<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\PageRequest;
use App\Models\Log;
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
        $pages = Post::whereNull('parent_id')->where('type', $type)->orderBy('order')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($type, Post $page)
    {
        // todo: PageFields limit check
        $lang = \request()->lang;
        if ($lang) {
            $langPage = $page->_lang($lang);

            if (is_null($langPage)) {
                $original = Post::where('id', $page->id)->select('title', 'type')->first()->toArray();
                $copy = array_merge($original, ['lang' => $lang, 'parent_id' => $page->id]);

                $page = Post::create($copy);
            } else {
                $page = $langPage;
            }

            return redirect()->route('admin.pages.edit', ['type' => request()->type, 'page' => $page->id]);
        } else {
            $page = $page;
        }

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

        if (isset($fieldFiles['fields'])) { // Fields Files
            foreach ($fieldFiles['fields'] as $key => $field) {
                if (is_array($data['fields'][$key])) {
                    $bulk = $page->field($key); // Old files infos
                    $id = uniqid();
                    $orderNo = 1;
                    foreach ($data['fields'][$key] as $arrayField) {
                        $src = Helper::image($arrayField);
                        $bulk[] = ['id' => $id++, 'order' => $orderNo++, 'src' => $src]; // Merge with old files
                    }

                    $data['fields'][$key] = $bulk; // Updata with new data
                } else {
                    $src = Helper::image($field);
                    $data['fields'][$key] = $src;
                }
            }
        }

        $data['type'] = $type;

        $oldFields = $page->fields;
        $newDatas = $data['fields'] ?? [];

        foreach ($newDatas as $key => $value) {
            unset($oldFields[$key]);
        }

        if ($oldFields) {
            $merged = array_merge($oldFields, $newDatas);
        } else {
            $merged = $newDatas;
        }
        $data['fields'] = $merged;

        $page->fill($data)->save();

        return back()->with([
            'status' => 'success',
            'message' => __('Successfully Updated')
        ]);
    }

    /**
     * @param $type
     * @param Post $post
     * @param $field
     * @param $arrayId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyArrayField($type, Post $post, $field, $arrayId)
    {
        $data = $post->fields;

        // Since the incoming data is an array, it comes in the form of field[key]. Catch the key
        $fieldName = Str::between($field, '[', ']');

        // Get the field on key
        foreach ($data[$fieldName] as $key => $value) {
            if ($value['id'] == $arrayId)
                $index = $key;
        }
        unset($data[$fieldName][$index]);
        // todo: If the index doesn't exist?

        $post->update(['fields' => $data]);

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully Updated')
        ]);
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($type, Post $page)
    {
        Post::where('parent_id', $page->id)->delete();
        // todo: model
        $page->delete();
        // todo: destroy files

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully Updated'),
            'redirect' => route('admin.pages.index', \request()->type)
        ]);
    }

    /**
     * @param $type
     * @param Post $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroySingleImage($type, Post $post)
    {
        // Since the incoming data is an array, it comes in the form of field[key]. Catch the key
        $fieldName = Str::between(\request()->field_name, '[', ']');
        $data = $post->fields;

        unset($data[$fieldName]);

        $post->update(['fields' => $data]);

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully Updated'),
            'redirect' => route('admin.pages.edit', [
                'type' => \request()->type,
                'page' => $post->id
            ])
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
            'message' => __('Successfully Updated')
        ]);
    }

    public function sortArrayField($type, Post $post, $field, Request $request)
    {
        $fieldName = Str::between($field, '[', ']');

        $data = $post->fields;
        $oldFields = $data[$fieldName];
        $collection = collect($oldFields);
        $newCollectionForField = [];

        $order = 1;
        foreach ($request->all() as $item) {
            $arrayId = Str::after($item, 'image_id_');

            $newCollection = $collection->where('id', $arrayId)->first();
            $newCollection['order'] = $order++;
            $newCollectionForField[$fieldName][] = $newCollection;
        }

        unset($data[$fieldName]);
        $merged = array_merge($data, $newCollectionForField);

        $post->update(['fields' => $merged]);

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully Updated')
        ]);
    }
}
