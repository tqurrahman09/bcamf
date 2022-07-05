var malFormEditReset = function(){
    formEdit.resetForm()
    formEdit.find(".has-danger").removeClass("has-danger")
    formEdit.find(".form-control-feedback").remove()
}
var edit_ = function(id){
  $.ajax({
    url: baseUrl + "user/ajax_edit",
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
      $('[name="e_id"]').val(id);
      $('[name="e_namaBarang"]').val(data.namaBarang);
      $('[name="e_hargaBeli"]').val(data.hargaBeli);
      $('[name="e_hargaJual"]').val(data.hargaJual);
      $('[name="e_stok"]').val(data.stok);
      $(".modal-title").text("Edit Barang")
      modalEdit.modal({backdrop: 'static', keyboard: false})
      mApp.unblock("#mal-table")
      formEdit.validate( {
            rules: {
              e_namaBarang: {
                required: !0,
                remote: {
                  url: baseUrl + "user/ajax_checknameedit",
                  type: 'post',
                  data: {
                    e_id: function() {
                      return $("#e-id").val();
                    }
                  }
                }
              },
              e_hargaBeli: {
                  required: !0,
              },
              e_hargaJual: {
                  required: !0,
              },
              e_stok: {
                  required: !0,
              },
            }
            , messages: {
                e_namaBarang: {
                  remote: 'Nama Barang Sudah Ada!'
                }
            }
            , invalidHandler:function(e, t) {
                toastr.warning("Mohon isi form dengan benar.", "Save Failed!",{
                    "closeButton": "true"
                })
            }
            , submitHandler:function(formEdit) {
                $.ajax({
                    url: baseUrl + "user/ajax_editsubmit", 
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