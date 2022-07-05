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
        $("#month, .trans-date").datepicker( {
            format:"dd-mm-yyyy", rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !0, templates: t
        }
        ),
        formAdd.validate( {
            rules: {
                month:{
                    required: !0,
                },
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formAdd) {
                this.submit();
            }, errorPlacement: function (error, element) {
                if ($(element).is('select')) {
                    element.next().after(error)
                } else if(element.attr("name") == "date"){
                    error.insertAfter(element.parent())
                } else {
                    error.insertAfter(element)
                }
            }
        }
        ),
        $repeater = $("#a-repeater").repeater({
                        initEmpty: !1,
                        defaultValues: {
                            
                        },
                        show: function() {
                            $(this).slideDown()
                        },
                        hide: function(e) {
                            $(this).slideUp(e)
                        },
                        isFirstItemUndeletable: true
        }),
        $repeater.setList(details),
        $(".selectpickers").selectpicker(),
        $(".btn-m-repeater").click(function(){
            setTimeout(function(){  
                $(".selectpickers").selectpicker()
                $(".trans-date").datepicker( {
                    format:"dd-mm-yyyy", rtl: mUtil.isRTL(), todayBtn: "linked", clearBtn: !0, todayHighlight: !0, autoclose: !0, templates: t
                })
            }, 0);
        })
    }
};
jQuery(document).ready(function() {
    AddJs.init()
}
);