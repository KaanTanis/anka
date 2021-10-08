@extends('admin.master')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-4">
                    <h4 class="page-title">{{ __('Items') }}</h4>
                </div>

                @php
                    $pageFields = new \App\PageFields();
                @endphp

                @if($pageFields->get()['page_details']['limit'] < $pages->count() || $pageFields->get()['page_details']['limit'] == null)
                <div class="col-sm-8 col-8 text-right m-b-20">
                    <a href="{{ route('admin.pages.edit', ['type' => request()->type]) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> {{ __('Add New') }}</a>
                </div>
                @endif

            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-alert />

                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th style="width: 10%">{{ __('Sort') }}</th>
                                <th style="width: 90%">{{ __('Item Name') }}</th>
                                <th style="width: 90%">{{ __('Kategori') }}</th>
                                <th class="text-center">{{ __('Language') }}</th>
                                <th class="text-right">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            @foreach($pages as $page)
                            <tr id="{{ $page->id }}">
                                <td style="width: 10%" class="handle"><i class="fa fa-arrows-v"></i></td>
                                <td style="width: 90%">{{ $page->title }}</td>
                                <td style="width: 90%">{{ \App\Models\Post::where('id', $page->field('categories'))->first()->title ?? null }}</td>

                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        @foreach(\App\Helper::$languages as $language)
                                            <a type="button" class="mr-2"
                                               href="{{ route('admin.pages.edit', ['type' => request()->type, 'page' => $page->id, 'lang' => $language['lang']]) }}"
                                            ><i class="flag-icon flag-icon-{{ $language['flag_code'] }} flag-icon-square"></i></a>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="text-right">
                                    <a href="{{ route('admin.pages.edit', ['type' => request()->type, 'page' => $page->id]) }}" class="btn btn-primary">{{ __('Edit') }}</a>
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

    @push('footer')
        <style>
            .handle:hover {
                cursor: pointer;
            }
        </style>
        <!-- Latest Sortable -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>

        <script>
            $('#sortable').sortable({
                handle: '.handle',
                stop: function (event, ui) {
                    let data = $(this).sortable('toArray');

                    axios.post('{{ route('admin.pages.order', request()->type) }}', data).then((res) => {
                        console.log(res.data)
                    })
                }
            });
        </script>
    @endpush


@endsection
