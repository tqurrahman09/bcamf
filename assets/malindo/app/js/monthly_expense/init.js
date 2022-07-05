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
                url: baseUrl + "monthly-expense/ajax-list",
                type: "POST"
            },
            columnDefs: [
                { 
                    targets: -1,
                    orderable: !1,
                }
            ]        
        }),
        $('#i-btn-print').click(function(event) {
            /* Act on the event */
            var printContent = document.getElementById('print-area');
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }),
    }
};
jQuery(document).ready(function() {
    InitJs.init()
}

);