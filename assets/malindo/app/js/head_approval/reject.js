var reject_ = function(id){
    swal({
        title: "Confirmation!",
        text: "Are you sure want to reject this request?",
        confirmButtonText: "<span><i class='la la-check-circle-o'></i><span>Yes</span></span>",
        confirmButtonClass: "btn btn-primary m-btn m-btn--pill m-btn--air m-btn--icon",
        showCancelButton: !0,
        cancelButtonText: "<span><i class='la la-times-circle-o'></i><span>No</span></span>",
        cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
    }).then((result) => {
      if (result.value) {
        $.ajax({
            url : baseUrl + "head_approval/ajax_reject",
            type: "POST",
            dataType: "JSON",
            data: {data: id},
            success: function(data)
            {
                if (data.status) {
                  table.ajax.reload(null,false)
                  swal(
                    'Rejected!',
                    data.message,
                    'success'
                  )
                } else {
                  swal(
                    'Reject Failed!',
                    data.message,
                    'error'
                  )
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal(
                  'Reject Failed!',
                  'Something wrong on server.',
                  'error'
                )
            }
        })
      }
    })    
}