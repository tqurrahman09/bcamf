var malFormAddReset = function(){
    formAdd.resetForm()
    formAdd.find(".has-danger").removeClass("has-danger")
    formAdd.find(".form-control-feedback").remove()
}
var RequestJS = {
    init:function() {
        var t;
        t=mUtil.isRTL()? {
            leftArrow: '<i class="la la-angle-right"></i>', rightArrow: '<i class="la la-angle-left"></i>'
        }
        : {
            leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
        };
        $("#date").datepicker( {
            format:"dd-mm-yyyy", rtl: mUtil.isRTL(), multidate: !0, todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !1, templates: t
        }
        ),
        $("#type").select2( {
            placeholder: "Select a type of leave"
        }
        ),
        formAdd.validate( {
            rules: {
                date: {
                    required: !0
                },
                purpose:{
                    required: !0
                },
                job:{
                    required: !0
                },
                job_delegation:{
                    required: !0
                },
                type:{
                    required: !0
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formAdd) {
                this.submit();
            }
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
    RequestJS.init()
}
);