<script>
	var malFormAddReset = function(){
	    formAdd.resetForm()
	    formAdd.find(".has-danger").removeClass("has-danger")
	    formAdd.find(".form-control-feedback").remove()
	}
	var cleave = new Cleave($(".budget_bbm").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					})
					var cleave2 = new Cleave($(".budget_pulsa").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					});
					var cleave3 = new Cleave($(".budget_hotel").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					});
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
	        $("#periode").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary"
            }),
	        formAdd.validate( {
	            rules: {
	                month:{
	                    required: !0,
	                },
	                //by ronix : 10-10-2019
	                unpaid_amt:{
	                    required: !0,
	                },
	                //end by ronix
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
	                /* --- begin atan --- */
					var cleave = new Cleave($(".budget_bbm").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					});

					var cleave = new Cleave($(".budget_pulsa").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					});

					var cleave = new Cleave($(".budget_hotel").last(), {
					    numeral: true,
					    numeralThousandsGroupStyle: 'thousand'
					});
	                /* --- end atan --- */
	            }, 0);
	        })
	    }
	};
	jQuery(document).ready(function() {
	    AddJs.init();
        /* --- begin atan --- */
	    $(".budget_bbm").each(function(){
	    	var cleave = new Cleave(this, {
			    numeral: true,
			    numeralThousandsGroupStyle: 'thousand'
			});
	    })
	    $(".budget_pulsa").each(function(){
	    	var cleave = new Cleave(this, {
			    numeral: true,
			    numeralThousandsGroupStyle: 'thousand'
			});
	    })
	    $(".budget_hotel").each(function(){
	    	var cleave = new Cleave(this, {
			    numeral: true,
			    numeralThousandsGroupStyle: 'thousand'
			});
	    })
        /* --- end atan --- */
	}
	);
</script>