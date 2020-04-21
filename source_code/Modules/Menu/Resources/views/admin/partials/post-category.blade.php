<div class="panel">
    <div class="panel-heading">
        Danh mục tin tức
    </div>
</div>

@include('menu::admin/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Danh mục</label>
    <select class="form-control" name="object_id">
        <option value="">Chọn một danh mục</option>
        @foreach($postCategories as $item)
            <option value="{{ $item->getId() }}" {{ $menu->getType() == Modules\Menu\Repositories\Menu::TYPE_POST_CATEGORY && $menu->getObjectId() == $item->getId() ? 'selected' : '' }}><?php for($i = 0; $i < $item->level; $i ++) echo '--'; ?>{{ $item->getName() }}</option>
        @endforeach
    </select>
    {!! alertError('object_id') !!}
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('admin.menu.ajax.searchPostCategory') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == Modules\Menu\Repositories\Menu::TYPE_POST_CATEGORY)
            <?php
                $postCategory = app('Modules\Post\Repositories\Category\PostCategoryRepository')->find($menu->getObjectId());
            ?>
            @if($postCategory)
                $('#keyword').tokenInput('add', {
                    id: {{ $postCategory->getId() }},
                    name: '{{ $postCategory->getName() }}'
                });
            @endif
        @endif
    });
</script>
@endsection