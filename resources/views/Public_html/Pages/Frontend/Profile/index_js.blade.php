<script>
    var IndexJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnAlertStr('IndexJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        IndexJS.init();
    });
</script>
