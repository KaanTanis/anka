<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ route('admin.home') == request()->url() ? 'active' : null }}">
                    <a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> <span>{{ __('Dashboard') }}</span></a>
                </li>

                <hr>
                <li class="menu-title">{{ __('Sayfalar') }}

                <li class="{{ Helper::active('admin.pages.index', ['type' => 'projects'], 3) }}">
                    <a href="{{ route('admin.pages.index', ['type' => 'projects'], 3) }}"><i class="fa fa-building"></i> <span>{{ __('Projeler') }}</span></a>
                </li>

                {{--<li class="{{ Helper::active('admin.pages.index', ['type' => 'gallery'], 3) }}">
                    <a href="{{ route('admin.pages.index', ['type' => 'gallery'], 3) }}"><i class="fa fa-picture-o"></i> <span>{{ __('Galeri') }}</span></a>
                </li>

                <li class="{{ Helper::active('admin.pages.index', ['type' => 'blog'], 3) }}">
                    <a href="{{ route('admin.pages.index', ['type' => 'blog'], 3) }}"><i class="fa fa-paper-plane"></i> <span>{{ __('Blog') }}</span></a>
                </li>--}}

                <li class="{{ Helper::active('admin.pages.index', ['type' => 'kvkk'], 3) }}">
                    <a href="{{ route('admin.pages.index', ['type' => 'kvkk'], 3) }}"><i class="fa fa-lock"></i> <span>{{ __('KVKK') }}</span></a>
                </li>

                <li class="{{ Helper::active('admin.pages.index', ['type' => 'blog'], 3) }}">
                    <a href="{{ route('admin.pages.index', ['type' => 'blog'], 3) }}"><i class="fa fa-file-text"></i> <span>{{ __('Blog') }}</span></a>
                </li>

                <li class="menu-title">{{ __('Site Genel') }}</li>
                <li class="{{ Helper::active('admin.sliders.index') }}">
                    <a href="{{ route('admin.sliders.index') }}"><i class="fa fa-picture-o"></i> <span>{{ __('Slider') }}</span></a>
                </li>


            </ul>
        </div>
    </div>
</div>
