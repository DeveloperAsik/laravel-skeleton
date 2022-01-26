<script>
    var fnToaStr= function(string, type, opt){ 
        var color = 'color:green; font-size:12px'; 
        if(opt && opt.consoleOnly && opt.consoleOnly == true){
            console.log('%c log: ' + string, color);
        }else{
            var headerTxt = '';
            headerTxt = opt.header; 
            toastr.options = { 
                "closeButton": opt.closeButton, 
                "debug": opt.debug, 
                "newestOnTop": opt.newestOnTop, 
                "progressBar": opt.progressBar,
                "positionClass": opt.positionClass, 
                "preventDuplicates": opt.preventDuplicates, 
                "onclick": opt.onclick, 
                "showDuration": opt.showDuration, 
                "hideDuration": opt.hideDuration, 
                "timeOut": opt.timeOut,
                "extendedTimeOut": opt.extendedTimeOut, 
                "showEasing": opt.showEasing, 
                "hideEasing": opt.hideEasing, 
                "showMethod": opt.showMethod, 
                "hideMethod": opt.hideMethod
            };  
            switch (type){ 
                case 'info': 
                case 'warning': 
                    (_env && _env !== 'production') ? toastr.info(string, headerTxt): ''; 
                    color = 'color:#fe8642; font-size:12px'; 
                    break; 
                case 'success': 
                    (_env && _env !== 'production') ? toastr.success(string, headerTxt): ''; 
                    break;
                case 'error': 
                case 'danger': 
                    (_env && _env !== 'production') ? toastr.error(string, headerTxt): ''; 
                    color = 'color:#a40000; font-size:12px'; 
                    break; 
            }
            console.log('%c log: ' + string, color);
        }
    };
    var fnSetSleep = function (ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    };
    var str_slug = function (string) {
        var str = string.replace(/\+/g, '');
        str = str.replace(/:/g, '');
        str = str.replace(/,/g, '');
        str = str.replace(/\./g, '');
        str = str.replace(/&/g, '');
        str = str.replace(/\|/g, '');
        str = str.replace(/ /g, '-');
        str = str.replace(/\--/g, '-');
        str = str.replace(/\---/g, '-');
        return str.toLowerCase();
    };
    var fnSetPaginationInfo = function (el, data) {
        if (el) {
            for (var i = 0; i < Object.keys(data).length; i++) {
                var key = Object.keys(data)[i];
                $(el).attr(key, data[key]);
            }
        }
    };
    var fnGetDateNow = function (format) {
        if (!format)
            format = 'd-m-Y h:i:s';
        return dateFormat(new Date(), format);
    };
    var fnAjaxSend = function (formdata, uri, type, header, async, file) {
        var result = null;
        if (file == true) {
            return  $.ajax({
                url: uri,
                cache: false,
                type: type,
                data: formdata,
                headers: (header) ? header : '',
                async: async,
                enctype: 'multipart/form-data',
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                CrossDomain: true
            });
        }
        if (formdata) {
            if (async) {
                return $.ajax({url: uri, type: type, dataType: 'json', data: formdata, headers: (header) ? header : '', async: true, CrossDomain: true, });
            } else {
                return $.ajax({url: uri, type: type, dataType: 'json', data: formdata, headers: (header) ? header : '', async: false, CrossDomain: true, });
            }
        } else {
            return $.ajax({url: uri, type: type, dataType: 'json', headers: (header) ? header : '', async: false, CrossDomain: true, });
        }
        return result;
    };
    var loadingBg = function (action, el = '', msg = '', response) {
        if (action === 'start' && el == '') {
            console.log('load bg');
            //$('.parent-loader').css('display', 'block');
            $('body').append('<div id="loading_bg" style="z-index:9999; background-color:#f9f9fb; opacity:0.8; width:100%; height:100%; position: fixed; top:0px; left:0px"><button style="position:fixed; top: 40%; left: 50%; background-color: transparent; border: none; color: #fff;" class="btn btn-primary btn-loading btn-xl btn-svg-icon"><svg width="16px" height="16px"><use xlink:href="'+_base_assets_url+'/images/loading/sprite.svg#quickview-16"></use></svg></button></div>');
        } else {
            if (el) {
                var color = 'rgb(204, 51, 51)';
                if (response === 'success') {
                    color = 'rgb(52, 194, 105)';
                }
                $(el).html('<p style="color:' + color + '">' + msg + '</p>');
            }
            //$('.parent-loader').css('display', 'none');
            $('#loading_bg').remove();
    }
    };
    var loadingImg = function (el, act, opt) {
        if (!el)
            el = 'img-loading';
        if (!opt)
            opt = 'circle-loading';
        var animation = bodymovin.loadAnimation({container: document.getElementById(el),
            // Required
            path: _path_json + '/lottie/' + opt + '.json', // Required
            renderer: 'svg', // Required
            loop: true, // Optional
            autoplay: true, // Optional
            name: "Loading cuy... sabar ye", // Name for future reference. Optional.
        });
        if (act === 'play' || act == 'start') {
            $('#' + el).show();
            animation.play();
        } else if (act === 'destroy' || act === 'stop') {
            animation.destroy();
            $('#' + el).hide();
        }
    };
    var capitalize = function (s) {
        return s[0].toUpperCase() + s.slice(1);
    };
    var playLoadingAnimation = function (el) {
        var element = $(el);
        lottie.loadAnimation({container: element, // the dom element that will contain the animation
            renderer: 'svg', loop: true, autoplay: true, path: _path_json + '/lottie/circle-loading.json' // the path to the animation json
        });
    };
    var formatCurrency = function (number) {
        return new Intl.NumberFormat(['ban', 'id']).format(number);
    };
    
    var Globaljs = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('Globaljs successfully load', 'success', {timeOut: 2000});
                $('.close').on('click', function(){
                    var type = $(this).attr('data-dismiss');
                    if(type == 'alert'){
                        fnAjaxSend({type: type, close:true}, _base_url + '/remove-session-flash', 'POST', {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, false);
                    }
                });
            }
        };
    }();
    jQuery(document).ready(function () {
        Globaljs.init();
    });
    jQuery(window).on("load", function () {
        fnToaStr('page completed load', 'success', {timeOut: 2000});
    });
</script>
