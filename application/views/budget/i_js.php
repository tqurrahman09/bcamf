<script>
    var InitJs = {
        init:function() {
            table = $("#mal-table").DataTable( {
                responsive:!0,
                searchDelay:500, 
                pagingType:"full_numbers",
                processing: !1,
                serverSide: !0,
                // rowGroup: {
                //     dataSrc: 1
                // },
                order: [],
                ajax: {
                    url: baseUrl + "budget/ajax-list",
                    type: "POST"
                },
                columnDefs: [
                    { 
                        targets: -1,
                        orderable: !1,
                    }
                ]        
            })
        }
    };
    jQuery(document).ready(function() {
        InitJs.init();
    });
</script>