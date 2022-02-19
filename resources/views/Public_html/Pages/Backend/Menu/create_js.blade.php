<script>
    var EditJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnAlertStr('EditJS successfully load', 'success', {timeOut: 2000});
                $('input[name="level"]').on('change', function () {
                    var value = $(this).val();
                    console.log(value);

                });
            }
        };
    }();
    jQuery(document).ready(function () {
        EditJS.init();
    });
</script>
