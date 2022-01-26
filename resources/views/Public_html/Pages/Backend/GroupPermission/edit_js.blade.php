<script>
    var EditJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('EditJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        EditJS.init();
    });
</script>
