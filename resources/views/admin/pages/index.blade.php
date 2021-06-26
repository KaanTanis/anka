@extends('admin.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-4">
                    <h4 class="page-title">{{ __('Sayfalar') }}</h4>
                </div>
                <div class="col-sm-8 col-8 text-right m-b-20">
                    <a href="{{ route('admin.pages.edit', ['type' => request()->type]) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> {{ __('Yeni Ekle') }}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-alert />

                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                            <tr>
                                <th style="width: 10%">{{ __('Sıra') }}</th>
                                <th style="width: 90%">{{ __('Sayfa Adı') }}</th>
                                <th class="text-right">{{ __('Eylem') }}</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            @foreach($pages as $page)
                            <tr id="{{ $page->id }}">
                                <td style="width: 10%" class="handle"><i class="fa fa-arrows-v"></i></td>
                                <td style="width: 90%">{{ $page->title }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.pages.edit', ['type' => request()->type, 'page' => $page->id]) }}" class="btn btn-primary">{{ __('Düzenle') }}</a>
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
