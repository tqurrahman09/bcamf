var malFormAddReset = function(){
    formAdd.resetForm()
    formAdd.find(".has-danger").removeClass("has-danger")
    formAdd.find(".form-control-feedback").remove()
}
var AddJs = {
    init:function() {
        formAdd.validate( {
            rules: {
                group_name: {
                    required: !0
                }
                , modules: {
                    required: !0
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning(e, t,{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formAdd) {
                $.ajax({
                    url : baseUrl + "otoritas/ajax_add_group",
                    type: "POST",
                    data: new FormData($(formAdd)[0]),
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        $("#btn-submit").addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                    }
                    , success: function(data) {
                        if(data.status) //if success close modal and reload ajax table
                        {
                            reload_table()
                            reload_table_group()
                            $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                            modalAdd.modal('hide')
                            toastr.success(data.message, "Save Successfull!",{
                              "closeButton": "true"
                            })
                        }
                        else
                        {
                            $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                            toastr.warning("Error", "Save Failed!",{
                              "closeButton": "true"
                            })
                        }
                    }
                    , statusCode: {
                        500: function() {
                            toastr.error("Terjadi kesalahan pada server.", "Save Failed!",{
                                "closeButton": "true"
                            })
                            $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                        }
                    }
                })
            }
        }
        ),
        modalAdd.on("shown.bs.modal", function() {
            $("#module_").select2( {
                placeholder: "Select a state"
            })
        }
        ),
        $("#btn-form").click(function() {
            malFormAddReset()
            $(".modal-title").text("Add Data")
            modalAdd.modal({backdrop: 'static', keyboard: false})
        })
    }
};
jQuery(document).ready(function() {
    AddJs.init()
}
);