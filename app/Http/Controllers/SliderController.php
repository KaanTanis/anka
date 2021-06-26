<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

/**
 * Class SliderController
 * @package App\Http\Controllers
 */
class SliderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * @param Slider $slider
     * @param SliderRequest $sliderRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrCreate(Slider $slider, SliderRequest $sliderRequest)
    {
        $data = $sliderRequest->all();

        if (isset($data['cover']))
            $file = Helper::image($data['cover'], false, 100);

        $data['cover'] = $file ?? $slider->cover;

        $slider->fill($data)->save();

        return back()->with([
            'status' => 'success',
            'message' => __('Slider kaydedildi')
        ]);
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        //todo: image destroy
        return response()->json([
            'status' => 'success',
            'message' => __('Slider silindi'),
            'redirect' => route('admin.sliders.index')
        ]);
    }
}
