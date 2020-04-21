<div class="gallery-control">
    <div class="thumnail-container mg-bt-10">
        <img src="{{ old($controlName, parse_file_url('sm_' . $defaultValueControl)) ? parse_file_url('sm_' . old($controlName, $defaultValueControl)) : '/images/no-image.png' }}" class="{{ !old($controlName, $defaultValueControl) ? 'hide' : '' }} img-thumnail" id="{{ $imgId }}">
    </div>
    <input type="hidden" name="{{ $controlName }}" value="{{ old($controlName, $defaultValueControl) }}">
    <span id="{{ md5($controlName.$imgId.$defaultValueControl) }}" class="act-show-gallery btn btn-xs btn-danger">Chọn ảnh từ gallery</span>

    <script type="text/javascript">
        $(function() {
            $('#{{ md5($controlName.$imgId.$defaultValueControl) }}').fancybox({
                type: 'iframe',
                href: '/admin/resource/gallery/index?control_name={{ $controlName }}&srcSelectorId={{ $imgId }}',
                afterShow : function() {
                    $('.fancybox-type-iframe').css({top: 55});
                }
            });
        });
    </script>
    <style type="text/css">
        .fancybox-type-iframe {
            top: 55px !important;
        }
        .fancybox-inner {
            min-height: 500px !important;
        }
    </style>
</div>