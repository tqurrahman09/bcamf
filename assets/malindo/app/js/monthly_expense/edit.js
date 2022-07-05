var malFormEditReset = function(){
    formEdit.resetForm()
    formEdit.find(".has-danger").removeClass("has-danger")
    formEdit.find(".form-control-feedback").remove()
}
var edit_ = function(id){
  $.ajax({
    url: baseUrl + "employee/ajax_edit",
    type: 'POST',
    dataType: 'JSON',
    data: {data: id},
    beforeSend: function() {
      mApp.block("#mal-table", {
        overlayColor: "#000000",
        type: "loader",
        state: "info",
        size: "lg"
      })
    },
    success: function(data) {
      malFormEditReset()
      $('[name="e_id"]').val(id)
      $('[name="e_employee_id"]').val(data.employee_id)
      $('[name="e_employee_name"]').val(data.employee_name)
      $('[name="e_email"]').val(data.email)
      $('#e-head-name option[value='+data.head+']').prop("selected", "selected")
      $('#e-department option[value='+data.department_id+']').prop("selected", "selected")
      $('#e-join-date').datepicker('setDate', new Date(data.join_date))
      $('[name="e_level"]').val(data.level)
      $('#e-area option[value='+data.area+']').prop("selected", "selected")
      $('input[name="e_status"][value="'+data.status+'"]').prop('checked', true)
      $('#e-resign-date').datepicker('setDate', new Date(data.resign_date))
      $(".modal-title").text("Edit Data")
      modalEdit.modal({backdrop: 'static', keyboard: false})
      mApp.unblock("#mal-table")
      formEdit.validate( {
            rules: {
                e_employee_id: {
                    required: !0
                },
                e_employee_name:{
                    required: !0
                },
                e_head_name:{
                    required: !0
                },
                e_department:{
                    required: !0
                },
                e_join_date:{
                    required: !0
                },
                e_level:{
                    required: !0
                },
                e_area:{
                    required: !0
                },
                e_email:{
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
                    url: baseUrl + "employee/ajax_editsubmit", 
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
                          modalEdit.modal('hide')
                          toastr.warning(data.message, "Warning!",{
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
        var eMalePercent, eFemaleStart, eMaleStart, t;
        t=mUtil.isRTL()? {
            leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'
        }
        : {
            leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
        };
        $("#e-join-date").datepicker( {
            format:"dd-mm-yyyy", rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !0, templates: t
        }
        ),
        $("#e-resign-date").datepicker( {
            format:"dd-mm-yyyy", rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !0, templates: t
        }
        ),
        $("#e-modal").on("shown.bs.modal", function() {
            $("#e-head-name").select2( {
                placeholder: "Select a head",
                ajax: {
                    url: baseUrl + "employee/ajax_getemployee",
                    dataType: 'json',
                    data: function (params) {
                      var query = {
                        data: params.term,
                      }
                      return query;
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    }
                }
            }
            ), $("#e-department").select2( {
                placeholder: "Select a department"
            }
            ), $("#e-level").select2( {
                placeholder: "Select a level"
            }
            ), $("#e-area").select2( {
                placeholder: "Select a area"
            }
            )
        }
        )
    }
};
jQuery(document).ready(function() {
    EditJs.init()
}
);