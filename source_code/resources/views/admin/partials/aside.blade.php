<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">

            @foreach(admin_sidebar() as $item)
                @if(isset($item['items']))
                    @if(auth()->user()->can("root:root") || isset($item['permission']) && auth()->user()->can($item['permission']) && array_get($item, 'active') == 1)
                        <li data-order="{{ array_get($item, 'order') }}" data-can="" data-root="" data-active="{{ array_get($item, 'active') }}" class="sub-menu">
                            <a href="javascript:;" class="{{ isset($item['pattern_active']) ? (Request::is($item['pattern_active']) ? 'active': '') : '' }}">
                                <i class="{{ array_get($item, 'icon') }}"></i>
                                <span>{{ array_get($item, 'title') }}</span>
                            </a>
                            <ul class="sub">
                            @foreach($item['items'] as $subItem)
                                <li class="{{ isset($subItem['pattern_active']) ? (Request::is($subItem['pattern_active']) ? 'active': '') : '' }}">
                                    <a href="{{ array_get($subItem, 'url') }}">{{ array_get($subItem, 'title') }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </li>
                    @endif
                @else
                    @if(auth()->user()->can('root:root') || isset($item['permission']) && auth()->user()->can($item['permission']) && array_get($item, 'active') == 1)
                        <li data-order="{{ array_get($item, 'order') }}" data-can="" data-active="{{ array_get($item, 'active') }}">
                            <a class="{{ isset($item['pattern_active']) ? (Request::is($item['pattern_active']) ? 'active': '') : '' }}" href="{{ array_get($item, 'url') }}">
                                <i class="{{ array_get($item, 'icon') }}"></i>
                                <span>{{ array_get($item, 'title') }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
