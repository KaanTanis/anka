@if(request()->url() != url()->previous())
    <a href="{{ url()->previous() }}" class="btn btn-white text-dark"><i class="fa fa-arrow-left mr-2"></i>{{ __('Geri Git') }}</a>
@endif
