@extends('admin.master')

@push('header.bottom')
<link rel="stylesheet" type="text/css" href="/assets/plugins/morris/morris.css">
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.circliful.css">
@endpush

@push('footer')
<script src="/assets/js/Chart.bundle.js"></script>
<script src="/assets/js/chart.js"></script>
<script src="/assets/plugins/morris/morris.js"></script>
<script src="/assets/plugins/raphael/raphael-min.js"></script>
<script src="/assets/js/jquery.circliful.min.js"></script>
@endpush
@section('content')
<div class="page-wrapper">
    <div class="content">
        <h1>Hoş geldin, {{ auth()->user()->name }}</h1>
    </div>
</div>
@endsection
