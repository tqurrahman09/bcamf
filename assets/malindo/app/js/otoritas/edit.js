var malFormEditReset = function(){
    formEdit.resetForm()
    formEdit.find(".has-danger").removeClass("has-danger")
    formEdit.find(".form-control-feedback").remove()
}
var edit_ = function(id){
  $.ajax({
    url: baseUrl + "otoritas/ajax_edit_group",
    type: 'POST',
    dataType: 'JSON',
    data: {data: id},
    beforeSend: function() {
      mApp.block("#e-modal .modal-content", {
        overlayColor: "#000000",
        type: "loader",
        state: "success",
        size: "lg"
      })
    },
    success: function(data) {
      malFormEditReset()
      $.ajax({
            url : baseUrl + "otoritas/ajax_get_otoritas/",
            type: "POST",
            dataType: "JSON",
            data: {data: id},
            success: function(data)
            {
                $('#e-module_').val(data).trigger('change');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                toastr.warning(jqXHR.responseText, "Server Error!",{
                    "closeButton": "true"
                })
            }
        });
      $('[name="e_id"]').val(id);
      $('[name="e_group_name"]').val(data.group_name);
      $("#e-is-accounting").prop("checked", parseInt(data.is_accounting));
      $(".modal-title").text("Edit Data")
      modalEdit.modal({backdrop: 'static', keyboard: false})
      mApp.unblock("#e-modal .modal-content")
      formEdit.validate( {
            rules: {
                e_group_name: {
                    required: !0
                }
                , e_modules: {
                    required: !0
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formEdit) {
                $.ajax({
                    url: baseUrl + "otoritas/ajax_update_group", 
                    type: "post",
                    dataType: "JSON",             
                    data: new FormData($(formEdit)[0]),
                    cache: false,
                    contentType: false,             
                    processData: false,
                    beforeSend: function() {
                        $("#e-btn-submit").addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                    }     
                    , success: function(data) {
                        if (data.status) {
                          table.ajax.reload(null,false)
                          $("#e-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                          modalEdit.modal('hide')
                          toastr.success(data.message, "Update Successfull!",{
                              "closeButton": "true"
                          })
                        } else {
                          $("#e-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
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
                            $("#e-btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                        }
                    }
                })
            }
        })
    },
    error: function(e) {
      console.log(e)
    }
  })
}
var EditJs = {
    init:function() {
        modalEdit.on("shown.bs.modal", function() {
            $("#e-module_").select2( {
                placeholder: "Select a state"
            })
        }
        )
    }
};
jQuery(document).ready(function() {
    EditJs.init()
}
);