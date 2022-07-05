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
                url: baseUrl + "hrd_approval/ajax_list",
                type: "POST"
            },
            headerCallback:function(table, a, t, n, s) {
                table.getElementsByTagName("th")[0].innerHTML='\n<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">\n<input type="checkbox" value="" class="m-group-checkable">\n<span></span>\n</label>'
            },
            lengthMenu: [
                  [ 10, 25, 50, 100, 200, -1 ],
                  [ '10 rows', '25 rows', '50 rows', '100 rows', '200 rows', 'Show all' ]
            ],
            columnDefs: [
                { 
                    targets: -1,
                    orderable: !1,
                },
                {
                    targets:0, 
                    width:"30px", 
                    className:"dt-right", 
                    orderable:!1, 
                    render:function(table, a, t, n) {
                        if(t[6] != "Head rejected" && t[6] != "HRD rejected" && t[6] != "HRD approved"){
                            return '\n<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">\n<input name="leave_selected[]" type="checkbox" value="'+table+'" class="m-checkable" id="leave-selected">\n<span></span>\n</label>'
                        } else {
                            return ''
                        }
                    },
                },
            ]        
        }),
        table.on("change", ".m-group-checkable", function() {
            var e=$(this).closest("table").find("td:first-child .m-checkable"), a=$(this).is(":checked");
            $(e).each(function() {
                a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
            })
        }),
        table.on("change", "tbody tr .m-checkbox", function() {
            $(this).parents("tr").toggleClass("active")
        })
    }
};
jQuery(document).ready(function() {
    InitJs.init()
}

);