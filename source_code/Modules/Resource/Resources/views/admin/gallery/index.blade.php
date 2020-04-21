<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/gallery.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/js/fancybox-2.15/source/jquery.fancybox.css">

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/fancybox-2.15/source/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript" src="/bs3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/js/dropzone/dropzone.min.css">
    <script type="text/javascript" src="/js/dropzone/dropzone.min.js"></script>
</head>
<body>
    <div class="panel">
        <div class="panel-body">
            <div class="gallery-container">
                <div class="row">
                    <div class="col-sm-2 item-colsystem mg-bt-20">
                        <div class="item first-upload" data-toggle="modal" data-target="#modal-upload">
                            <i class="icon fa fa-upload"></i>
                        </div>
                    </div>
                    @foreach($images as $item)
                        <div class="col-sm-2 item-colsystem mg-bt-20">
                            <div class="item">
                                <img class="img" src="{{ parse_file_url('md_'.$item['name']) }}">
                                <div class="btn-group">
                                    <span data-image="{{ $item->name }}" data-image_uri="{{ parse_file_url('md_' . $item->name) }}" class="act-select-image btn btn-sm btn-primary" title="Chọn ảnh"><i class="fa fa-hand-o-up"></i></span>
                                    <span data-image="{{ $item->name }}" data-action="delete" class="btn btn-danger btn-sm act-delete-image" title="Xóa"><i class="fa fa-trash"></i></span>
                                    <a href="{{ parse_file_url($item->name) }}" class="_fancybox btn btn-sm btn-default" title="Phóng to"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-xs-12">
                        <div class="pull-right">{!! $images->appends($_GET)->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" data-toggle="modal" data-target="#modal-upload" class="btn btn-primary btn-sm btn-upload">Upload</button>
    </div>

    <div id="modal-upload" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload image</h4>
                </div>
                <div class="modal-body">
                    <div id="my-awesome-dropzone" class="dropzone"></div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$(function() {
    $('.lazy').lazyload();

    $('._fancybox').fancybox({
        helpers: {
            title : {
                type : 'float'
            }
        },
        afterLoad: function(cur, prev) {
            console.log(cur);
            // $(cur.inner).append('<button class="btn btn-xs btn-primary">Choice</button>');
        }
    });

    $('.act-select-image').click(function() {
        var fileControl = parent.document.querySelector('input[name="'+ getParamsFromURL('control_name') +'"]');
        $(fileControl).val($(this).data('image'));
        var imgSrc = parent.document.getElementById(getParamsFromURL('srcSelectorId'));
        $(imgSrc).attr('src', $(this).data('image_uri')).removeClass('hide');

        parent.jQuery.fancybox.close(true);
    });

    $('.act-delete-image').click(function() {
        if(confirm("Bạn có chắc chắn muốn xóa ảnh này")) {
            var $this = $(this);
            $.ajax({
                url : '{{ route("admin.gallery.delete") }}',
                type : 'POST',
                data : {
                    image : $this.data('image'),
                    _token: '{{ csrf_token() }}'
                },
                success : function(response) {
                    $this.parents('.item-colsystem').remove();
                }
            });
        }
    });

    Dropzone.autoDiscover = false;
    var myAwesomeDropzone = new Dropzone("#my-awesome-dropzone", {
        url: "{{ route('admin.gallery.uploads') }}?_token={{ csrf_token() }}",
        maxFilesize: 300,
        maxFiles: 25,
        addRemoveLinks: true,
        uploadMultiple: true,
        acceptedFiles: "image/*",
        parallelUploads: 25,
        dictDefaultMessage: "Choose a image file from computer",
        dictInvalidFileType: "Allow file *.jpg, *.jpeg",
        dictFileTooBig : "Max upload file size is 1MB, this file very big",
        dictRemoveFile: "Remove this file",
        dictMaxFilesExceeded: "You can not upload anymore file",
        success: function(e, response) {
            if(response.code === 1) {
                window.location.reload();
            }
        }
    });

});
</script>
</body>
</html>

