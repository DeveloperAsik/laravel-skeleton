<script>
    var ViewJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('ViewJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        ViewJS.init();
    });
</script>
