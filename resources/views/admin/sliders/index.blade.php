@extends('admin.master')

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-4">
                    <h4 class="page-title">{{ __('Sliderlar') }}</h4>
                </div>
                <div class="col-sm-8 col-8 text-right m-b-20">
                    <a href="{{ route('admin.sliders.edit') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> {{ __('Yeni Ekle') }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-alert />

                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th style="width:10%;">{{ __('Slider Adı') }}</th>
                                <th class="text-right">{{ __('Eylem') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $slider->name }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-primary">{{ __('Düzenle') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
