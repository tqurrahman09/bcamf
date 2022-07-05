var malformImportReset = function(){
    formImport.resetForm()
    formImport.find(".has-danger").removeClass("has-danger")
    formImport.find(".form-control-feedback").remove()
}
var ImportJs = {
    init:function() {
        formImport.validate( {
            rules: {
                file: {
                    required: !0
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formImport) {
                $.ajax({
                    url: baseUrl + "employee/ajax_import", 
                    type: "POST",
                    dataType: "JSON",             
                    data: new FormData($(formImport)[0]),
                    cache: false,
                    contentType: false,             
                    processData: false,
                    beforeSend: function() {
                        $("#i-btn-submit").addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                    }     
                    , success: function(data) {
                        if (data.status) {
                          table.ajax.reload(null,false)
                          $("#i-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                          modalImport.modal('hide')
                          toastr.success(data.message, "Update Successfull!",{
                              "closeButton": "true"
                          })
                        } else {
                          $("#i-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                          toastr.warning(data.message, "Update Failed!",{
                              "closeButton": "true"
                          })
                        }
                    }
                    , statusCode: {
                        500: function() {
                            toastr.error("Terjadi kesalahan pada server.", "Save Failed!",{
                                "closeButton": "true"
                            })
                            $("#i-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                        }
                    }
                })
            }
        }
        ),
        $("#i-btn-form").click(function() {
            malformImportReset()
            $(".modal-title").text("Import Employee")
            modalImport.modal({backdrop: 'static', keyboard: false})
        })
    }
};
jQuery(document).ready(function() {
    ImportJs.init()
}
);