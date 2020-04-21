@extends('admin/layouts/master')

@section('main-content')
    <h3>Thêm thương hiệu và danh mục <b>{{ $category->getName() }}</b></h3>
    <div class="panel-body">
        <div class="col-sm-6">
            <h5>Đang chọn</h5>
            <ul>
                @foreach($brands as $brand)
                    <li><a href="{{ route('admin.category.doAttachBrand', [$category->getId(), $brand->getId()]) }}">{{ $brand->getName() }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6">
            <h5>Đã chọn</h5>
            <ul>
                @foreach($brandSelected as $brand)
                    <li><a href="{{ route('admin.category.detachBrand', [$category->getId(), $brand->getId()]) }}">{{ $brand->getName() }} <i class="fa fa-close"></i></a></li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
