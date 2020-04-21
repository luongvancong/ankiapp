"use strict";

(function($) {
    var ScrollPagination = function() {
        this.continue = false;
    };


    ScrollPagination.prototype = {
        init : function(obj, opts) {
            var target = opts.scrollTarget;

            var that = this;
            that.continue = true;
            $(obj).attr('scrollPagination', 'enabled');


            $(target).scroll(function(event){
                if ($(obj).attr('scrollPagination') == 'enabled') {
                    that.loadContent(obj, opts);
                }
                else {
                    event.stopPropagation();
                }
            });

            that.loadContent(obj, opts);
        },

        loadContent : function(obj, opts) {
            var that = this;
            var target = opts.scrollTarget;
            var mayLoadContent = $(target).scrollTop() + opts.heightOffset >= $(document).height() - $(target).height();
            if (mayLoadContent && that.continue == true) {
                if (opts.beforeLoad != null) {
                    opts.beforeLoad();
                }
                $(obj).children().attr('rel', 'loaded');

                var $paginator = $('#custom-pagination');
                var $nextUrl   = $paginator.find('li.active').next();
                var url        = $nextUrl.find('a').attr('href');

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: opts.contentData,
                    success: function(data) {
                        if(data.code == 1) {
                            $(obj).append(data.html);
                            $('#paginator-wrapper').html(data.html_pagination);
                            var objectsRendered = $(obj).children('[rel!=loaded]');

                            that.continue = true;

                            if (opts.afterLoad != null) {
                                opts.afterLoad(objectsRendered);
                            }
                        }
                    },
                    dataType: 'json'
                });
            }
        }
    }


    $.fn.extend({
        scrollPagination : function(options) {

            var $loading   = $('#loading');

            var defaults = {
                url : '',
                method : 'GET',
                scrollTarget : window,
                scrollTo : 500,
                heightOffset : 100,
                dataType : 'json',
                beforeSend : function() {
                    $loading.show();
                },
                success : function(response) {

                }
            }

            var opts = $.extend(defaults, options);

            return this.each(function() {
                var s = new ScrollPagination();
                s.init($(this), opts);
            });
        }
    });
})(jQuery)
