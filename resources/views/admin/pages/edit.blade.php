@extends('admin.master')

@push('header.top')
<link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
<script src="https://cdn.tiny.cloud/1/7isaa99gbuhj3vcz5a24uek5vqil4qpeiiercz5c8ua5jq4i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@push('footer')
<script src="/assets/js/select2.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        height: 320
    });
</script>
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content">
            <x-back-button />
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">{{ __('Sayfa Ekle') }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <x-alert />
                    <form action="{{ route('admin.pages.updateOrCreate', ['type' => request()->type, 'page' => $page->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Başlık') }}</label>
                                    <input id="title" name="title" class="form-control" type="text" value="{{ $page->title ?? old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Açıklama') }}</label>
                                    <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $page->description ?? old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">{{ __('İçerik') }}</label>
                                    <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ $page->content ?? old('content') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seo_title">{{ __('Seo Başlık') }}</label>
                                    <input id="seo_title" name="seo_title" class="form-control" type="text" value="{{ $page->seo_title ?? old('seo_title') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seo_description">{{ __('Seo Açıklama') }}</label>
                                    <input id="seo_description" name="seo_description" class="form-control" type="text" value="{{ $page->seo_description ?? old('seo_description') }}">
                                </div>
                            </div>

                            @if($page->cover)
                                <a target="_blank" href="{{ Helper::getImage($page->cover, 600) }}">{{ __('Yüklü görseli göster') }}</a>
                            @endif
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="cover">
                                <label class="custom-file-label">{{ __('Kapak Fotoğrafı') }}</label>
                            </div>

                            @if($page->banner)
                                <a target="_blank" href="{{ Helper::getImage($page->banner, 600) }}">{{ __('Yüklü görseli göster') }}</a>
                            @endif
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" name="banner">
                                <label class="custom-file-label">{{ __('Sayfa İçi Banner') }}</label>
                            </div>

                            <div class="custom-file mb-5 mt-5">
                                <input type="file" class="custom-file-input" name="images[]" multiple>
                                <label class="custom-file-label">{{ __('Galeri') }}</label>
                            </div>

                            @if($page->images)
                                <h3>{{ __('Yüklü Görseller') }}</h3>
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach($page->images as $image)
                                            <div id="image_id_{{ $image['id'] }}" class="col-md-2 col-xs-4">
                                                <i onclick="imgDestroyBtn('{{ route('admin.pages.destroyImage', [
                                                    'type' => request()->type,
                                                    'page' => $page->id,
                                                    'imageId' => $image['id']
                                                    ]) }}', '{{ $image['id'] }}')" class="fa fa-trash imgDestroyBtn"></i>
                                                <img style="width: 100%; max-height: 100px; object-fit: cover" src="{{ Helper::getImage($image['src']) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- todo: make:component --}}
                            @if(isset(\App\Helper::pages()[request()->type]))
                                @if(isset(\App\Helper::pages()[request()->type]['fields']))
                                    @foreach(\App\Helper::pages()[request()->type]['fields'] as $key => $field)
                                        @if($field == 'text' || $field == 'number' || $field == 'file')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="_{{ $key }}">{{ $key }}</label>
                                                    @if($field == 'file' && isset($page->fields[$key]))
                                                        <a href="{{ Helper::getImage(($page->fields[$key]), 600) }}" target="_blank" class="fa fa-eye p-2 btn btn-success"></a>
                                                        <button type="button" class="fa fa-trash p-2 btn btn-danger"></button>
                                                        <input type="text" name="fields[{{ $key }}]" class="d-none" value="{{ $page->fields[$key] }}">
                                                    @endif
                                                    <input id="_{{ $key }}" name="fields[{{ $key }}]" class="form-control" type="{{ $field }}" value="{{ $page->fields[$key] ?? null }}">
                                                </div>
                                            </div>
                                        @endif

                                        @if($field == 'textarea')
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="_{{ $key }}">{{ $key }}</label>
                                                    <textarea name="fields[{{ $key }}]" id="_{{ $key }}" class="form-control" cols="30" rows="3">{{ $page->fields[$key] ?? null }}</textarea>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endif


                            @push('footer')
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                <script>
                                    function imgDestroyBtn(url, id) {
                                        Swal.fire({
                                            title: 'Emin misin?',
                                            text: 'Bir görsel siliyorsun.',
                                            icon: 'question',
                                            confirmButtonText: 'Evet, sil.',
                                            cancelButtonText: 'Vazgeç',
                                            showCancelButton: true
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                axios.post(url).then(function (res) {
                                                    Swal.fire({
                                                        title: res.data.message,
                                                        icon: res.data.status,
                                                        confirmButtonText: 'Tamam'
                                                    })
                                                    if(res.data.status === 'success') {
                                                        $('#image_id_' + id).fadeOut(600, function () {
                                                            $(this).remove();
                                                        })
                                                    }
                                                })
                                            }
                                        })
                                    }


                                    function destroyPage(url) {
                                        Swal.fire({
                                            title: 'Emin misin?',
                                            text: 'Sayfa kalıcı olarak silinecek',
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
                        </div>


                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">{{ __('Kaydet') }}</button>
                            @if($page->exists)
                                <button type="button" class="btn btn-danger submit-btn" onclick="destroyPage('{{ route('admin.pages.destroy', [
                                    'type' => request()->type,
                                    'page' => $page->id
                                ]) }}')">{{ __('Sil') }}</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
