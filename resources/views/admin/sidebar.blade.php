<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ route('admin.home') == request()->url() ? 'active' : null }}">
                    <a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> <span>{{ __('Dashboard') }}</span></a>
                </li>

                <hr>
                <li class="menu-title">{{ __('Sayfalar') }}
                @foreach(\App\Helper::pages_details() as $detail)
                    <li class="{{ Helper::active('admin.pages.index', ['type' => $detail['method_name']]) }}">
                        <a href="{{ route('admin.pages.index', ['type' => $detail['method_name']]) }}"><i class="{{ $detail['icon'] }}"></i> <span>{{ $detail['page_name'] }}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
