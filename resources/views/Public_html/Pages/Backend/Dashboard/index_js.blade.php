<script>
    var DashboardJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('DashboardJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        DashboardJS.init();
    });
</script>
