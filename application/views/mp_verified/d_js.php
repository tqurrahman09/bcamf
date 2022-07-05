<script>
  var delete_ = function(id){
      swal({
          title: "Confirmation!",
          text: "Are you sure want verify this data?",
          confirmButtonText: "<span><i class='la la-check-circle-o'></i><span>Yes</span></span>",
          confirmButtonClass: "btn btn-primary m-btn m-btn--pill m-btn--air m-btn--icon",
          showCancelButton: !0,
          cancelButtonText: "<span><i class='la la-times-circle-o'></i><span>No</span></span>",
          cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
      }).then((result) => {
        if (result.value) {
          $.ajax({
              url : baseUrl + "mp-verified/ajax-delete",
              type: "POST",
              dataType: "JSON",
              data: {data: id},
              success: function(data)
              {
                  if (data.status) {
                    table.ajax.reload(null,false)
                    swal(
                      'Verified!',
                      data.message,
                      'success'
                    )
                  } else {
                    swal(
                      'Failed!',
                      data.message,
                      'error'
                    )
                  }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  swal(
                    'Failed to verified!',
                    'Data is not verified.',
                    'error'
                  )
              }
          })
        }
      })    
  }
</script>