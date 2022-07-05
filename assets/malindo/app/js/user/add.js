var malFormAddReset = function(){
    formAdd.resetForm()
    formAdd.find(".has-danger").removeClass("has-danger")
    formAdd.find(".form-control-feedback").remove()
}
var AddJs = {
    init:function() {
        formAdd.validate( {
            rules: {
                namaBarang: {
                    required: !0,
                    remote: {
                        url: baseUrl + "user/ajax_checknameadd",
                        type: 'post'
                    }
                },
                hargaBeli: {
                    required: !0,
                },
                hargaJual: {
                    required: !0,
                },
                stok: {
                    required: !0,
                },
            }
            , messages: {
                namaBarang: {
                  remote: 'Nama Barang suah ada!.'
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formAdd) {
                $.ajax({
                    url: baseUrl + "user/ajax_add", 
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
                          toastr.success(data.message, "Save Successfull!",{
                              "closeButton": "true"
                          })
                        } else {
                          $("#btn-submit").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                          toastr.warning(data.message, "Save Failed!",{
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
        )
        , $("#btn-form").click(function() {
            malFormAddReset()
            $(".modal-title").text("Tambah Barang")
            modalAdd.modal({backdrop: 'static', keyboard: false})
        }
        )
    }
};
jQuery(document).ready(function() {
    AddJs.init()
}
);