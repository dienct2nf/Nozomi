const Loader = function () {}
Loader.prototype = {
    require: function (scripts, callback) {
        this.loadCount = 0;
        this.totalRequired = scripts.length;
        this.callback = callback;
        for (var i = 0; i < scripts.length; i++) {
            if (scripts[i].indexOf('.js') >= 0) {
                this.writeScript(scripts[i]);
            } else if (scripts[i].indexOf('.css') >= 0) {
                this.writeStyle(scripts[i]);
            }
        }
    },
    loaded: function (evt) {
        this.loadCount++;
        if (this.loadCount == this.totalRequired && typeof this.callback == 'function') this.callback.call();
    },
    writeScript: function (src) {
        var list = document.getElementsByTagName('script');
        var i = list.length,
            flag = false;
        while (i--) {
            if (list[i].src === src) {
                flag = true;
                break;
            }
        }
        // if we didn't already find it on the page, add it
        if (!flag) {
            var self = this;
            var s = document.createElement('script');
            s.type = "text/javascript";
            s.async = true;
            s.src = src;
            s.addEventListener('load', function (e) {
                self.loaded(e);
            }, false);
            var head = document.getElementsByTagName('head')[0];
            head.appendChild(s);
        }
    },
    writeStyle: function (src) {
        var list = document.getElementsByTagName('link');
        var i = list.length,
            flag = false;
        while (i--) {
            if (list[i].src === src) {
                flag = true;
                break;
            }
        }
        // if we didn't already find it on the page, add it
        if (!flag) {
            var self = this;
            var s = document.createElement('link');
            s.rel = "stylesheet";
            s.href = src;
            s.addEventListener('load', function (e) {
                self.loaded(e);
            }, false);
            var head = document.getElementsByTagName('head')[0];
            head.appendChild(s);
        }
    },
    submitConfirm: function() {
        $(document).on('click', '.delete-confirm', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                title: 'Bạn đã chắc chắn?',
                text: "Bản ghi này và thông tin chi tiết sẽ bị xóa vĩnh viễn!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy bỏ',
                confirmButtonText: 'Đồng ý'
              }).then((result) => {
                if (result.value) {
                    form[0].submit();
                }
              })
        });
    },
    convertToSlug: function(text) {
        var title, slug;
        //Lấy text từ thẻ input title
        title = text;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        slug = slug.replace(/ /gi, '');
        return slug;
    },
    convertToSlugPermisson: function(text) {
        return text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'');
    },

    previewGoogle: function() {
        var domain = window.location.hostname;
        var self = this;
        $(".google-preview").keyup(function(e) {
            var id = $(this).attr('id');
            if (id.indexOf('_seo') == -1) {
                var idSlug = id.replace('jp','vi');
                var value = domain+' › '+self.convertToSlug($('#'+idSlug).val())+' &nbsp;<i class="fa fa-caret-down">';
            } else {
                var value = $(this).val();
            }
            if (value.length > 0) {
                $('#'+id+'_preview').html(value);
            }
        })
    },
    previewGoogleLoad: function() {
        var domain = window.location.hostname;
        var self = this;
        $(".google-preview").each(function() {
            var id = $(this).attr('id');
            if (id.indexOf('_seo') == -1) {
                var idSlug = id.replace('jp','vi');
                var value = domain+' › '+self.convertToSlug($('#'+idSlug).val())+' &nbsp;<i class="fa fa-caret-down">';
            } else {
                var value = $(this).val();
            }
            if (value.length > 0) {
                $('#'+id+'_preview').html(value);
            }
        })
    },
    previewGoogleProduct: function() {
        var domain = window.location.hostname;
        var self = this;
        $(".google-preview").keyup(function(e) {
            var id = $(this).attr('id');
            var slug = domain+' › '+self.convertToSlug($('#name').val())+' &nbsp;<i class="fa fa-caret-down">';
            var value = $(this).val();
            if (value.length > 0) {
                $('#'+id+'_preview').html(value);
                $('#url_preview').html(slug);
            }
        })
    },
    previewGoogleLoadProduct: function() {
        var domain = window.location.hostname;
        var self = this;
        $(".google-preview").each(function() {
            var id = $(this).attr('id');
            var slug = domain+' › '+self.convertToSlug($('#name').val())+' &nbsp;<i class="fa fa-caret-down">';
            var value = $(this).val();
            if (value.length > 0) {
                $('#'+id+'_preview').html(value);
                $('#url_preview').html(slug);
            }
        })
    },
    uniquePermission: function(id) {
        var self = this;
        $("#"+id).keyup(function(e) {
            $(this).val(self.convertToSlugPermisson($('#'+id).val()));
        })
    },
    removeThumb: function() {
        $('#lfm').filemanager('image'); // load
        var noimg = '/photos/1/background/thumb.jpg';
        $('[data-toggle="tooltip"]').tooltip()
        $('#delete-thumb').click(function() {
            $('#thumbnail').val('');
            $('#holder').attr('src', noimg);

        })
    },
    appendCkeditor: function() {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&responseType=json&_token='+_token,
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='+_token,
            extraPlugins: 'wordcount, justify, showblocks, colorbutton, image2, font, uploadimage, iframe',
        };
        return options;
    },

    removeThumbAlbum: function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('click', '.delete-thumb', function (e) {
            var url = $(this).data('url');
            var id = $(this).data('id');
            var link = $('#thumbnail_m').val();
            link = link.split(',');
            const index = link.indexOf(url);
            if (index > -1) {
                link.splice(index, 1);
            }
            $('#'+id).remove();
            $('#thumbnail_m').val(link.join());
        })
    },

    deleteImg: function() {
        $(document).on('click', '.delete-thumb-album', function (e) {

            if(!confirm("Bạn muốn xóa hình ảnh này?")) {
               return false;
             }

            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            // var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax(
                {
                  url: url, //or you can use url: "company/"+id,
                  type: 'DELETE',
                  data: {
                    _token: token,
                    id: id,
                },
                success: function (response){
                    Swal.fire(
                      'Thành công!',
                      'Xóa hình ảnh thành công!',
                      'success'
                    )
                    $('#'+id).remove();
                }
             });
              return false;
           });
    },
    linkingtoSeo: function() {
        var domain = window.location.hostname;
        var self = this;
        $(".google-preview, .description_link").keyup(function(e) {
            var id = $(this).attr('id');
            var title_seo = id.split("_").shift();
            title_seo += '_seo_'+id.split("_").pop();
            // set value
            $('#'+title_seo).val($(this).val());
            if (id.indexOf('title_vi') > 0) {
                var idSlug = id.replace('jp','vi');
                var value = domain+' › '+self.convertToSlug($('#'+idSlug).val())+' &nbsp;<i class="fa fa-caret-down">';
            } else {
                var value = $(this).val();
            }
            if (value.length > 0) {
                $('#'+title_seo+'_preview').html(value);
            }
        })
    },
    slugCreate: function() {
        var self = this;
        $(".google-preview").keyup(function(e) {
            var slug = self.convertToSlug($(this).val());
            if (slug.length > 0) {
                $('#slug_vi').val(slug);
            }
        })
    },
    initInputmaskDateTime: function() {
        jQuery(".init-inputmask").each(function() {
            var id = jQuery(this).attr('id');
            jQuery('#'+id).inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        });
    },
}
// load class
var app = new Loader();
var ckeditorOptions = app.appendCkeditor();
