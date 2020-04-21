<div class="panel">
    <div class="panel-heading" role="tab" id="headingOne">
        Tin tức
    </div>
</div>

@include('menu::admin/partials/general-control')

<div class="form-group {{ hasValidator('object_id') }}">
    <label class="control-label"><b class="text-danger">*</b> Tin tức</label>
    <input type="text" id="keyword" name="object_id" class="form-control" placeholder="Tìm một tin tức">
    {!! alertError('object_id') !!}
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('#keyword').tokenInput('{{ route('admin.menu.ajax.searchPost') }}', {
            method: 'GET',
            queryParam: 'q',
            tokenLimit: 1
        });

        @if($menu->getId() > 0 && $menu->getType() == Modules\Menu\Repositories\Menu::TYPE_POST)
            <?php
                $post = app('Modules\Post\Repositories\PostRepository')->find($menu->getObjectId());
            ?>
            @if($post)
                $('#keyword').tokenInput('add', {
                    id: {{ $post->getId() }},
                    name: '{{ $post->getTitle() }}'
                });
            @endif
        @endif
    });
</script>
@endsection
