<!-- Select2 -->
<script src="{{config('app.base_assets_uri')}}/templates/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
var fnGetMenu = function (level, module_id) {
    loadingImg('img-loading', 'start');
    var uri = _base_extraweb_uri + '/ajax/get/get-menu-by-level';
    var type = 'GET';
    var formdata = {
        module_id: module_id,
        level: level
    };
    var response = fnAjaxSend(formdata, uri, type, {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, false);
    //console.log(response.responseJSON);return false;
    if (response.status === 200) {
        setTimeout(function () {
            loadingImg('img-loading', 'stop');
            $('#levelID').html(response.responseJSON.data);
        }, 1100);
    } else {
        setTimeout(function () {
            loadingImg('img-loading', 'stop');
            $('#levelID').html('');
        }, 1100);
    }
};
var fnGetMenuChild = function (parent_id, level, module_id) {
    loadingImg('img-loading', 'start');
    var uri = _base_extraweb_uri + '/ajax/get/get-menu-child';
    var type = 'GET';
    var formdata = {
        parent_id: parent_id,
        module_id: module_id,
        level: level
    };
    var response = fnAjaxSend(formdata, uri, type, {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, false);
    if (response.status === 200) {
        setTimeout(function () {
            loadingImg('img-loading', 'stop');
            $('#levelChildID').html(response.responseJSON.data);
        }, 1100);
    } else {
        setTimeout(function () {
            loadingImg('img-loading', 'stop');
            $('#levelChildID').html('');
        }, 1100);
    }
};
var fnSelectMenu = function (e, level, module_id) {
    var parent_id = e.value;
    fnGetMenuChild(parent_id, level, module_id);
};
var EditJS = function () {
    return {
        //main function to initiate the module
        init: function () {
            fnAlertStr('EditJS successfully load', 'success', {timeOut: 2000});
            $('#icon').select2({
                theme: 'bootstrap4'
            });
            //$('input[name="level"]').on('change', function () {
            //    var value = $(this).val();
            //    console.log(value);
            //    if(value > 1){
            //        fnGetMenu(value);
            //    }
            //});
            $('select[name="module_id"]').on('change', function () {
                var module_id = $(this).val();
                var value = parseInt($('input[name="level"]').val());
                console.log(value);
                if (value > 1) {
                    fnGetMenu(value, module_id);
                }
            });

            $('#submit_form_add_menu').on('click', function () {
                var formdata = {
                    title: $('input[name="title"]').val(),
                    path: $('input[name="path"]').val(),
                    icon: $('select[name="icon"]').val(),
                    level: parseInt($('input[name="level"]').val()),
                    is_badge: ($('input[type="checkbox"][name="is_badge"]').checked == true) ? 1 : 0,
                    badge: $('select[name="badge"]').val(),
                    badge_text: $('input[name="badge_text"]').val(),
                    badge_value: $('input[name="badge_value"]').val(),
                    module_id: parseInt($('select[name="module_id"]').val()),
                    is_active: ($('input[type="checkbox"][name="is_active"]').checked == true) ? 1 : 0
                };
                console.log(formdata);
                return false;
            });
        }
    };
}();
jQuery(document).ready(function () {
    EditJS.init();
});
</script>
