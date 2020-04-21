(function ($) {
    "use strict";
    $(document).ready(function () {
        /*==Slim Scroll ==*/
        if ($.fn.slimScroll) {
            $('.event-list').slimscroll({
                height: '305px',
                wheelStep: 20
            });
            $('.conversation-list').slimscroll({
                height: '360px',
                wheelStep: 35
            });
            $('.to-do-list').slimscroll({
                height: '300px',
                wheelStep: 35
            });
        }

        /*==Easy Pie chart ==*/
        if ($.fn.easyPieChart) {
            $('.epie-chart').easyPieChart({
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                },
                barColor: "#f8a20f",
                lineWidth: 5,
                size:80,
                trackColor: "#efefef",
                scaleColor:"#cccccc"

            });

        }

        $(document).on('click', '.event-close', function () {
            $(this).closest("li").remove();
            return false;
        });

        $('.progress-stat-bar li').each(function () {
            $(this).find('.progress-stat-percent').animate({
                height: $(this).attr('data-percent')
            }, 1000);
        });

        $('.stat-tab .stat-btn').click(function () {
            $(this).addClass('active');
            $(this).siblings('.btn').removeClass('active');
        });

        $('select.styled').customSelect();
        $("#sortable-todo").sortable();


        /*Calendar*/
        $(function () {
            $('.evnt-input').keypress(function (e) {
                var p = e.which;
                var inText = $('.evnt-input').val();
                if (p == 13) {
                    if (inText == "") {
                        alert('Empty Field');
                    } else {
                        $('<li>' + inText + '<a href="#" class="event-close"> <i class="ico-close2"></i> </a> </li>').appendTo('.event-list');
                    }
                    $(this).val('');
                    $('.event-list').scrollTo('100%', '100%', {
                        easing: 'swing'
                    });
                    return false;
                    e.epreventDefault();
                    e.stopPropagation();
                }
            });
        });
    });
})(jQuery);