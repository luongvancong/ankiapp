$(function() {
    // Action click chọn hãng
    /*
    $(document).on('click', '.action-choice-hsx', function(e) {
        e.preventDefault();
        var $this = $(this);
        if($this.find('i').hasClass('fa-square-o')) {
            $this.find('i').removeClass('fa-square-o').addClass('fa-check-square');
        } else {
            $this.find('i').removeClass('fa-check-square').addClass('fa-square-o');
        }

    });
    */


    // Cuộn hãng sx
    $('.action-viewmore-hsx').click(function() {
        var $sidebar = $('.hsx-list-sidebar');
        var $this = $(this);
        $sidebar.toggleClass('scrollup');

        if($sidebar.hasClass('scrollup')) {
            $this.text('Xem thêm');
        } else {
            $this.text('Thu lại');
        }
    });


    // Action tìm hsx
    $('#hsx-search-inp').keyup(function() {
        var $this = $(this);
        $.ajax({
            url : BrandConfigs.ajax_find_brand,
            type : 'GET',
            data : {
                q : $this.val(),
                current_id : $this.data('current_id')
            },
            success : function(response) {
                var $ul = $('#hsx-list-sidebar');
                $ul.find('.hsx-item').remove();
                for(var i in response) {
                    $ul.append(response[i].html);
                }
            }
        });
    });

    // Action sort
    $('#sort-action').change(function() {
        var url = urlAddParams('sort', $(this).val());
        window.location.href = url;
    });

    // Action layout
    $('.action-layout').click(function() {
        var $this = $(this);
        var url = urlAddParams('layout', $this.data('layout'));
        window.location.href = url;
    });


    // SCROLL PAGINATION
    $('#product-listing').infinitescroll({
        loading: {
            msgText: "<div>Đang tải thêm...</div>",
            selector : '#pl-loading'
        },
        extraScrollPx: 500,
        dataType: 'json',
        appendCallback: false,
        nextSelector: "#custom-pagination li.active + li > a",
        navSelector: "#custom-pagination"
    }, function(response, opts) {
        if(response.currentPage <= 3) {
            if(response.code == 1) {
                $('#product-listing').append(response.html);
                $('#paginator-wrapper').html(response.html_pagination);
                $('#button-load-more').html(response.html_button_viewmore);
            } else {
                $('#paginator-wrapper').html('');
                $('#button-load-more').html('');
            }
        } else {
            $('#product-listing').infinitescroll('pause');
        }

        $('#custom-pagination').show();
    });

    // Click vào nút xem thêm
    // load thêm sản phẩm
    $(document).on('click', '#btn-link-view-more', function(e) {
        e.preventDefault();

        var $this = $(this);
        var url = $this.attr('href');

        $.ajax({
            url : url,
            type : 'GET',
            dataType : 'json',
            beforeSend : function() {
                showLoading();
            },
            success : function(response) {
                hideLoading();
                if(response.code == 1) {
                    $('#product-listing').append(response.html);
                    $('#paginator-wrapper').html(response.html_pagination);
                    $('#button-load-more').html(response.html_button_viewmore);
                } else {
                    $('#paginator-wrapper').html('');
                    $('#button-load-more').html('');
                }
            }
        });
    });


});