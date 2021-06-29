@if ($errors->any())

    <style>
        .alert ul {
            margin: 0 !important;
            padding: 0 20px !important;
        }
    </style>

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))

    <style>
        .alert ul {
            margin: 0 !important;
            padding: 0 20px !important;
        }
    </style>

    <div class="alert alert-{{ session('status') }}">
        <ul>
            <li>{{ session('message') }}</li>
        </ul>
    </div>
@endif
