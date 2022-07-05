var ApprovesJS = {
    init:function() {
        $("#a-btn-form").on('click', function(event) {
            event.preventDefault()
            /* Act on the event */
            let id = [];
            $.each($("input[name='leave_selected[]']:checked"), function(){            
                id.push($(this).val());
            });
            if ($('input[name="leave_selected[]"]:checked').length > 0) {
                swal({
                    title: "Confirmation!",
                    text: "Are you sure want to approve selected request?",
                    confirmButtonText: "<span><i class='la la-check-circle-o'></i><span>Yes</span></span>",
                    confirmButtonClass: "btn btn-info m-btn m-btn--pill m-btn--air m-btn--icon",
                    showCancelButton: !0,
                    cancelButtonText: "<span><i class='la la-times-circle-o'></i><span>No</span></span>",
                    cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url : baseUrl + "hrd_approval/ajax_approves",
                            type: "POST",
                            dataType: "JSON",
                            data: {data: id},
                            beforeSend: function(){
                                mApp.block("body", {
                                    overlayColor: "#000000",
                                    type: "loader",
                                    state: "info",
                                    size: "lg"
                                  })
                            },
                            success: function(data){
                                table.ajax.reload(null,false)
                                mApp.unblock("body")
                                if (data.status) {
                                  table.ajax.reload(null,false)
                                  swal(
                                    'Approved!',
                                    data.message,
                                    'success'
                                  )
                                } else {
                                  swal(
                                    'Approve Failed!',
                                    data.message,
                                    'error'
                                  )
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown){
                                mApp.unblock("body")
                                toastr.error("Server error, please contact administrator.", "Error!",{
                                          "closeButton": "true",
                                          "timeOut": "60000"
                                      })
                            }
                        })
                    }
                })
            } else {
                toastr.warning("Please select request.", "Warning!",{
                              "closeButton": "true"
                          })
            }
        })
    }
};
jQuery(document).ready(function() {
    ApprovesJS.init()
}
);