@extends('admin.master')

@push('header.top')
<link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
@endpush

@push('footer')
<script src="/assets/js/select2.min.js"></script>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <x-back-button />
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">{{ __('Slider Ekle') }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <x-alert />
                    <form action="{{ route('admin.sliders.updateOrCreate', $slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Slider İsmi') }}</label>
                                    <input id="name" name="name" class="form-control" type="text" value="{{ $slider->name ?? old('name') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text_1">{{ __('Slider Yazı 1') }}</label>
                                    <input id="text_1" name="text_1" class="form-control" type="text" value="{{ $slider->text_1 ?? old('text_1') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text_2">{{ __('Slider Yazı 2') }}</label>
                                    <input id="text_2" name="text_2" class="form-control" type="text" value="{{ $slider->text_2 ?? old('text_2') }}">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Slider Açıklama') }}</label>
                                    <input id="description" name="description" class="form-control" type="text" value="{{ $slider->description ?? old('description') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="button_text">{{ __('Slider Buton Adı') }}</label>
                                    <input id="button_text" name="button_text" class="form-control" type="text" value="{{ $slider->button_text ?? old('button_text') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="button_action">{{ __('Slider Buton Link') }}</label>
                                    <input id="button_action" name="button_action" class="form-control" type="text" value="{{ $slider->button_action ?? old('button_action') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                @if($slider->cover)
                                    <a target="_blank" href="{{ Helper::getImage($slider->cover, 1200) }}">{{ __('Yüklü görseli göster') }}</a>
                                @endif
                                <div class="form-group">
                                    <label for="cover">{{ __('Slider Görsel') }}</label>
                                    <input id="cover" name="cover" class="form-control" type="file" value="{{ $slider->cover ?? old('cover') }}">
                                </div>
                            </div>
                        </div>


                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">{{ __('Kaydet') }}</button>
                            @if($slider->exists)
                                <button type="button" class="btn btn-danger submit-btn" onclick="destroySlider('{{ route('admin.sliders.destroy', $slider->id) }}')">{{ __('Sil') }}</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function destroySlider(url) {
            Swal.fire({
                title: 'Emin misin?',
                text: 'Slider\'ı silmek istediğinine emin misin?',
                icon: 'question',
                confirmButtonText: 'Evet, sil.',
                cancelButtonText: 'Vazgeç',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url).then(function (res) {
                        if (res.data.message) {
                            Swal.fire({
                                title: res.data.message,
                                icon: res.data.status,
                                confirmButtonText: 'Tamam'
                            })
                        }

                        if(res.data.redirect) {
                            setTimeout(function () {
                                window.location = res.data.redirect
                            }, 500)
                        }
                    })
                }
            })
        }
    </script>
@endpush
