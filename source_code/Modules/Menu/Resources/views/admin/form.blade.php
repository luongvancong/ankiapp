<form class="" method="POST" action="">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel">
                <div class="panel-heading">
                    Loại danh mục
                </div>
            </div>
            <div class="list-group">
                @foreach(Modules\Menu\Repositories\Menu::getTypeOptions() as $key => $value)
                    <?php
                        $url = route('admin.menu.create', ['type' => $key]);
                        if($menu->getId() > 0) {
                            $url = route('admin.menu.edit', [$menu->getId(), 'type' => $key]);
                        }
                    ?>
                    <a href="{{ $url }}" class="list-group-item {{ $type == $key ? 'active' : '' }}">{{ $value }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-sm-9">
            @if($type == Modules\Menu\Repositories\Menu::TYPE_CUSTOM)
                @include('menu::admin/partials/custom')
            @elseif($type == Modules\Menu\Repositories\Menu::TYPE_POST)
                @include('menu::admin/partials/post')
            @elseif($type == Modules\Menu\Repositories\Menu::TYPE_POST_CATEGORY)
                @include('menu::admin/partials/post-category')
            @elseif($type == Modules\Menu\Repositories\Menu::TYPE_PAGE)
                @include('menu::admin/partials/page')
            @endif

            <div class="form-group">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-sm btn-primary">{{ trans('form.btn.update') }}</button>
            </div>
        </div>
    </div>
</form>