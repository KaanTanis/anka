@extends('admin.master')

@push('header.top')
<link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
<script src="https://cdn.tiny.cloud/1/7isaa99gbuhj3vcz5a24uek5vqil4qpeiiercz5c8ua5jq4i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@push('footer')
<script src="/assets/js/select2.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea.tinymce',
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
                    <h4 class="page-title">{{ __('Sayfa Ekle') }} @if($page->lang) <i class="flag-icon flag-icon-{{ \App\Helper::langDetails($page->lang)['flag_code'] }} flag-icon-square"></i> @endif</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <x-alert />
                    <form action="{{ route('admin.pages.updateOrCreate', ['type' => request()->type, 'page' => $page->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @php
                                $pageFields = new \App\PageFields();
                            @endphp

{{--                            {{ dd($pageFields->get()['fields'][2]) }}--}}
                            @foreach($pageFields->get()['fields'] as $field)
                                @php
                                    $name = $field->fieldsTable ? 'fields[' . $field->name . ']' : $field->name;
                                    $label = $field->label;
                                    $placeholder = $field->placeholder;
                                    $type = $field->type;
                                    $multiple = $field->multiple;
                                    $required = $field->required;
                                    $tinymce = $field->tinymce;
                                    $col = $field->col;
                                    $value = ($field->fieldsTable ? ($page->fields[$field->name] ?? null) : $page[$field->name]) ?? null
                                @endphp
                                @switch($field->component)
                                    @case('input-field')
                                    <div class="col-md-{{ $col }}">
                                        <div class="form-group">
                                            <label for="{{ $name }}">
                                                {{ $label }}
                                                @if($type == 'file' && $multiple == null && $value != null)
                                                    <br>
                                                    <a href="{{ Helper::getImage($value, 600) }}" target="_blank" class="btn btn-success fa fa-eye text-white p-2"></a>
                                                    <button
                                                        onclick="imgDestroyBtn('{{ route('admin.pages.destroySingleImage', [
                                                                'type' => request()->type,
                                                                'post' => $page->id,
                                                                'field_name' => $name
                                                                ]) }}')"
                                                        type="button" class="btn btn-danger fa fa-trash text-white p-2"></button>
                                                @endif
                                            </label>
                                            <input id="{{ $name }}" name="{{ $name }}{{ $multiple != null ? '[]' : null }}" class="form-control"
                                                   type="{{ $type }}" value="@if(! is_array($value)){{ $value }}@endif" {{ $multiple }} {{ $required }}>
                                            @if(is_array($value))
                                                <h3 style="margin-top: 15px; position: relative; bottom: -20px">{{ __('Yüklü Ekler') }}</h3>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        @foreach($value as $array)
                                                            <div id="image_id_{{ $array['id'] }}" class="col-md-2 col-xs-4">
                                                                <i onclick="imgDestroyBtn('{{ route('admin.pages.destroyArrayFields', [
                                                    'type' => request()->type,
                                                    'post' => $page->id,
                                                    'field' => $name,
                                                    'arrayId' => $array['id']
                                                    ]) }}', '{{ $array['id'] }}')" class="fa fa-trash imgDestroyBtn"></i>
                                                                <img style="width: 100%; max-height: 100px; object-fit: cover" src="{{ Helper::getImage($array['src']) }}" alt="">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    @break

                                    @case('textarea-field')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="{{ $name }}">{{ $label }}</label>
                                            <textarea class="form-control {{ $tinymce == true ? 'tinymce' : null }}" name="{{ $name }}" id="{{ $name }}"
                                                      rows="3" {{ $required }}>{{ $value }}</textarea>
                                        </div>
                                    </div>
                                    @break
                                @endswitch
                            @endforeach
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

@push('footer')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/custom.js"></script>
@endpush
