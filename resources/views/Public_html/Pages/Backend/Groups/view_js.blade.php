<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    var ViewJS = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnAlertStr('ViewJS successfully load', 'success', {timeOut: 2000});
                var table = $('#groups').DataTable({
                    "sPaginationType": "bootstrap",
                    "paging": true,
                    "pagingType": "full_numbers",
                    "pageLength": 10,
                    "ordering": false,
                    "serverSide": true,
                    "cache": false,
                    "processing": true,
                    "lengthChange": false,
                    "language": {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    "ajax": {
                        url: _base_extraweb_uri + '/ajax/post/get-group-list',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST'
                    },
                    "columns": [
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "description"},
                        {"data": "is_active"},
                        {"data": "action"}
                    ]
                });
            }
        };
    }();
    jQuery(document).ready(function () {
        ViewJS.init();
    });
</script>
