<script>

    var ProfileJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnAlertStr('ProfileJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        ProfileJS.init();
    });
</script>