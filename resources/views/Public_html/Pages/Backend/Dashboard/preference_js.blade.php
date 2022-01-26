<script>
    var PreferenceJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('PreferenceJS successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        PreferenceJS.init();
    });
</script>
