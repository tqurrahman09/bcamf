var malFormPasswordReset = function(){
    let formChangePassword = $('#mal-form-changepassword')
    formChangePassword.resetForm()
    formChangePassword.find(".has-danger").removeClass("has-danger")
    formChangePassword.find(".form-control-feedback").remove()
}
var InitJS = {
    init:function() {
        var formChangePassword = $('#mal-form-changepassword')
        formChangePassword.validate( {
            rules: {
                cur_password: {
                    required: !0,
                    remote: {
                        url: baseUrl + "profil/current_password",
                        async: false,
                        type: 'post',
                        dataType: 'json',
                        complete: function(data){
                            if (data.responseJSON) {
                                $('#new-password, #re-newpassword').prop('readonly', false)
                            } else {
                                $('#new-password, #re-newpassword').prop('readonly', true)
                            }
                        }
                    }
                }
                , new_password: {
                    required: !0
                }
                , re_newpassword: {
                    required: !0,
                    reEnter: true
                }
            }
            , messages: {
                cur_password: {
                  remote: 'Password is wrong'
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formChangePassword) {
                $.ajax({
                    url : baseUrl + "profil/change_password",
                    type: "POST",
                    data: new FormData($(formChangePassword)[0]),
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        $("#btn-changepassword").addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                    }
                    , success: function(data) {
                        if(data.status) //if success close modal and reload ajax table
                        {
                            $("#btn-changepassword").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                            toastr.success(data.message, "Update Successfull!",{
                              "closeButton": "true"
                            })
                            malFormPasswordReset()
                        }
                        else
                        {
                            $("#btn-changepassword").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                            toastr.warning(data.message, "Update Warning!",{
                              "closeButton": "true"
                            })
                        }
                    }
                    , statusCode: {
                        500: function() {
                            toastr.error("Terjadi kesalahan pada server.", "Update Failed!",{
                                "closeButton": "true"
                            })
                            $("#btn-changepassword").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                        }
                    }
                })
            }
        }
        ),
        $.validator.addMethod("reEnter", function(value, element) {
            return $('#new-password').val() == value;
        }, 'Not match with new password.');
    }
};
jQuery(document).ready(function() {
    InitJS.init()
}
);