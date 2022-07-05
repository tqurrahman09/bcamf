function selectGroup(){     
    table.draw()
}

function reload_table(){
    table.ajax.reload(null,false) //reload datatable ajax 
}

function reload_table_group(){
    tableGroup.ajax.reload(null,false) //reload datatable ajax
    reload_table()
}

function insert_(module_id, level, insert){
    var temp    
    if (insert) {
        temp = 0
    }else{
        temp = 1
    }
    $.ajax({
        url : baseUrl + "otoritas/insert",
        type: "POST",
        data: {module_id:module_id, level:level, insert:temp},
        success: function(data)
        {
            reload_table()
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Update')
        }
    })
}

function update_(module_id, level, insert){
    var temp    
    if (insert) {
        temp = 0
    }else{
        temp = 1
    }
    $.ajax({
        url : baseUrl + "otoritas/update",
        type: "POST",
        data: {module_id:module_id, level:level, update:temp},
        success: function(data)
        {
            reload_table()
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Update')
        }
    })
}

function delete_(module_id, level, insert){
    var temp    
    if (insert) {
        temp = 0
    }else{
        temp = 1
    }
    $.ajax({
        url : baseUrl + "otoritas/delete",
        type: "POST",
        data: {module_id:module_id, level:level, delete:temp},
        success: function(data)
        {
            reload_table()
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Update')
        }
    })
}

function view_(module_id, level, insert){
    var temp    
    if (insert) {
        temp = 0
    }else{
        temp = 1
    }
    $.ajax({
        url : baseUrl + "otoritas/view",
        type: "POST",
        data: {module_id:module_id, level:level, view:temp},
        success: function(data)
        {
            reload_table()
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Update')
        }
    })
}

function sepecialAccess_(module_id, level, value_, function_){
    var temp    
    if (value_) {
        temp = 0
    }else{
        temp = 1
    }
    $.ajax({
        url : baseUrl + "otoritas/special_access",
        type: "POST",
        data: {
            module_id: module_id, 
            level: level, 
            value_:temp, 
            function_: function_
        },
        success: function(data)
        {
            reload_table()
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error Update')
        }
    })
}

var InitJs = {
    init:function() {
        table = $("#table").DataTable({ 
            responsive:!0,
            searchDelay:500, 
            pagingType:"full_numbers",
            processing: !1,
            serverSide: !0,
            order: [],
            ajax: {
                url: baseUrl + "otoritas/ajax_list",
                type: "POST",
                data: function(data) {
                    data.groups = $('input[name=group]:checked').val()
                },
            },
            columnDefs: [
                { 
                    targets: [ -1, -2, -3, -4, -5 ], //last column
                    orderable: false, //set not orderable
                },
                
            ], 
        }),
        tableGroup = $('#table-group').DataTable({ 
            responsive:!0,
            searchDelay:500, 
            pagingType:"full_numbers",
            processing: !1,
            serverSide: !0,
            order: [],
            ajax: {
                url: baseUrl + "otoritas/ajax_group_list",
                type: "POST"
            },
            columnDefs: [
                { 
                    targets: [ 0, -1 ], //last column
                    orderable: false, //set not orderable
                }
            ], 
        })
    }
};
jQuery(document).ready(function() {
    InitJs.init()
}

);