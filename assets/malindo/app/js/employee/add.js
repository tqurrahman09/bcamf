var malFormAddReset = function(){
    formAdd.resetForm()
    formAdd.find(".has-danger").removeClass("has-danger")
    formAdd.find(".form-control-feedback").remove()
}
var AddJs = {
    init:function() {
        var t;
        t=mUtil.isRTL()? {
            leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'
        }
        : {
            leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
        };
        $("#a-join-date").datepicker( {
            format:"dd-mm-yyyy", rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !0, templates: t
        }
        ),
        formAdd.validate( {
            rules: {
                a_employee_id: {
                    required: !0
                },
                a_employee_name:{
                    required: !0
                },
                a_head_name:{
                    required: !0
                },
                a_department:{
                    required: !0
                },
                a_join_date:{
                    required: !0
                },
                a_level:{
                    required: !0
                },
                a_area:{
                    required: !0
                },
                a_email:{
                    required: !0
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formAdd) {
                $.ajax({
                    url: baseUrl + "employee/ajax_add", 
                    type: "POST",
                    dataType: "JSON",             
                    data: new FormData($(formAdd)[0]),
                    cache: false,
                    contentType: false,             
                    processData: false,
                    beforeSend: function() {
                        $("#btn-submit").addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                    }     
                    , success: function(data) {
                        if (data.status) {
                          table.ajax.reload(null,false)
                          $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                          modalAdd.modal('hide')
                          toastr.success(data.message, "Update Successfull!",{
                              "closeButton": "true"
                          })
                        } else {
                          $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
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
                            $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                        }
                    }
                })
            }
        }
        ),
        $("#a-modal").on("shown.bs.modal", function() {
            $("#a-head-name").select2( {
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
            ), $("#a-department").select2( {
                placeholder: "Select a department"
            }
            ), $("#a-level").select2( {
                placeholder: "Select a level"
            }
            ), $("#a-area").select2( {
                placeholder: "Select a area"
            }
            )
        }
        ),
        $("#btn-form").click(function() {
            malFormAddReset()
            $(".modal-title").text("Add Employee")
            modalAdd.modal({backdrop: 'static', keyboard: false})
        })
    }
};
jQuery(document).ready(function() {
    AddJs.init()
}
);