<script>
    var InitJs = {
        init:function() {
            $("#periode").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary"
            }),
            table = $("#mal-table").DataTable( {
                responsive:!0,
                searchDelay:500, 
                pagingType:"full_numbers",
                processing: !1,
                serverSide: !0,
                // rowGroup: {
                //     dataSrc: 1
                // },
                
                columnDefs: [
                    { 
                        targets: -1,
                        orderable: !1,
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    // 'colvis',
                {
                extend: 'pageLength',
                text: '<span class="fa fa-eye"></span> Show',
                className: '',
                exportOptions: {
                    columns: [ ]
                  }
                },
                {
                    extend: 'excel',
                    text: '<span class="fa fa-file-excel"></span> Export Excel',
                    exportOptions: {
                           columns: [ 0,1,2,3,4,5,6,7,8]
                
                }},
                {
                    extend: 'pdf',
                    text: '<span class="fa fa-file-pdf"></span> Export PDF',
                    exportOptions: {
                           columns: [ 0,1,2,3,4,5,6,7,8]
                }},
                {
                    extend: 'print',
                    text: '<span class="fa fa-print"></span> Print',
                    exportOptions: {
                           columns: [ 0,1,2,3,4,5,6,7,8]
                    
                }},
                ]
                        
            }),
            $("#periode").on('change', function(event) {
            event.preventDefault();
            $.ajax({
              url: '<?php echo site_url('report_pc/ajax_getdata') ?>',
              type: 'POST',
              dataType: 'json',
              data : {id : $(this).val()},
              success : (function(datax){
                console.log(datax);
              })
            })
            .done(function(data) {
            })
            // .fail(function() {
            //   console.log("error");
            // });
            })
        }

    };


    jQuery(document).ready(function() {
        InitJs.init();
        
        $("#mal-table-2").DataTable();
    });
</script>