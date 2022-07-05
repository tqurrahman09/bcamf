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
                order: [],
                ajax: {
                    url: baseUrl + "report_pc/ajax_list",
                    type: "POST"
                },
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
                // $("#div_table1").hide();
                // $("#div_table2").show();
                //     console.log(data);
                // for (var i = 0; i < 4; i++) {
                // $("<tr>").appendTo($("#mal-table"))      // Create new row, append it to the table's html.
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="'+[(data[0])]+'">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')
                //         .append('<td><input readonly type="text" class="form-control" name="employee_id[]" value="asd">')   
            // }
          // $('#no').val(data.pc_no);
          // $('#name').val(data.username);
          // $('#dept').val(data.pc_name);
          // $('#area').val(data.area_name);
          // $('#date').val(data.date_from);
          // $('#bkk').val(data.bkk_no);
          // $('#acc').val(data.account_code);
          // $('#amm').val(data.amount);
          // $('#desc').val(data.remark);
            })
            // .fail(function() {
            //   console.log("error");
            // });
            })
        }

    };


    jQuery(document).ready(function() {
        InitJs.init();

    });
</script>