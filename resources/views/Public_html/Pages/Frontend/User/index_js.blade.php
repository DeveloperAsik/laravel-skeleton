<script>
    var LoginJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('LoginJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        LoginJS.init();
    });
</script>
