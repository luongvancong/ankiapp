$(function() {
   // Warning when delete an item
   //
   $('.btn-delete-action').click(function(ev) {
      ev.preventDefault();
      var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
      if (answer) return window.location.href = $(this).attr('href');
      else return false;
   });

   $('.btn-active-action')
   .hover(toggleStyleEditBtn, toggleStyleEditBtn)
   .click(function(e) {
      e.preventDefault();
      var $this = $(this);
      $.ajax({
         url : $this.attr('href'),
         type : 'GET',
         dataType : 'json',
         beforeSend: function() {
            // initSpin();
         },
         success : function(data) {

            $(document).trigger('action_active_success');

            // stopSpin();
            if(data.code === 1) {
               var _btn = $this.find('i');
               if(data.status == 1) {
                  $this.html('<i class="fa fa-check-square fa-2x"></i>');
               }else{
                  $this.html('<i class="fa fa-square-o fa-2x"></i>');
               }
            }else{
               alert(data.message);
            }
         }
      })
   });

   $('.checkbox_all').click(function(ev) {
      var that = $(this);
      that.parents('.checkbox-list').find('.checkbox-child').prop('checked', that.is(':checked'));
   });
});

/**
 * Preview image before upload
 * @param  event
 * @return img dom
 */
function fileSelect(evt) {
   if (window.File && window.FileReader && window.FileList && window.Blob) {
      var files = evt.target.files;
      var result = '';
      var file;
      for (var i = 0; file = files[i]; i++) {
         // if the file is not an image, continue
         if (!file.type.match('image.*')) {
            continue;
         }

         reader = new FileReader();
         reader.onload = (function (tFile) {
            return function (evt) {
               var div = document.createElement('div');
               div.className = "img-preview-wrapper";
               div.innerHTML = '<img class="img-preview" src="' + evt.target.result + '" />';
               $('.preview-uploader').html(div);
            };
         }(file));
         reader.readAsDataURL(file);
      }
   } else {
      alert('The File APIs are not fully supported in this browser.');
   }
}

/**
 * Hàm thay đổi style class cho nút active
 */
function toggleStyleEditBtn () {
   var _btn = $(this).find('i');
   if (_btn.hasClass('fa-check-square')) {
      _btn.removeClass('fa-check-square').addClass('fa-square-o fa-2x');
   } else {
      _btn.removeClass('fa-square-o').addClass('fa-check-square fa-2x');
   }
}


// TinyMCE - Config
tinymce.init({
   selector: ".ckeditor",
   theme: "modern",
   width: '100%',
   height: 450,
   // ===========================================
   // INCLUDE THE PLUGIN
   // ===========================================
   plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools codesample jbimages'
   ],

   // ===========================================
   // PUT PLUGIN'S BUTTON on the toolbar
   // ===========================================
   toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
   toolbar2: 'print preview media | fontsizeselect fontselect forecolor backcolor emoticons | codesample',


   // ===========================================
   // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
   // ===========================================

   fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',

   font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times;ElleFuturaBook=ElleFuturaBook',

   relative_urls: false,

   image_advtab: true
});

try {
   $.fn.select2.defaults.set( "theme", "bootstrap" );
   $('.select2').select2();
} catch(error) {
   console.log(error);
}

$(function() {
   $('img').on('error', function(e) {
      // console.log('gg');
      var $this = $(this);
      // console.log(e.currentTarget);
      $this.attr('src', '/images/no-image.png');
   });
});

/**
 * Auto fill slug with title,name
 * @param  string source
 * @param  string destination
 * @return void
 */
function auto_fill_slug(source, destination) {
   $(source).on('keyup', function() {
      var $this = $(this);
      var slug = strSlug(removeAccents($this.val()));
      $(destination).val(slug.toLowerCase());
   });
}

/**
 * Tạo slug tự động
 */
$(function() {
   auto_fill_slug('#slug-source', '#slug-target');
   auto_fill_slug('.slug-source', '.slug-target');
});

/**
 * Format money hiển thị
 */
$.fn.auto_format_price = function() {
   return this.each(function(e) {
      var element = $(this);

      // Default
      $(element.data('target')).text(formatCurrency(element.val()));

      element.on('keyup', function() {
         var $this = $(this);
         $(element.data('target')).text(formatCurrency($this.val()));
      });
   });
}

$(function() {
   $('.price-source').auto_format_price();
});

$(function() {
   // Tooltip
   $('[data-toggle="tooltip"]').tooltip();
});

$(function() {
   $( ".datepicker" ).datepicker({
      dateFormat: "dd/mm/yy"
   })
});