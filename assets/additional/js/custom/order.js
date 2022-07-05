$(document).ready(function() {
    
    var baseurl = window.location.origin;
    
    $("#field-mobil_id").on('change', function() {
        
        var idmobil = $("#field-mobil_id").val();
        
        $.ajax({
            
            url: baseurl + '/dikrental/transaction/get_harga/'+ idmobil, 
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data.results, function(k, v){
                    $("#field-harga").val(v['harga_sewa']);
                    var harga = $("#field-harga").val();
                    var dp = $('#field-dp').val();
                    var disc = $('#field-discount').val();
                    var total = parseInt(harga) - parseInt(dp) - parseInt(disc);
                    $('#field-total').val(total);
                }); 
            }
            
        });
        
    });
    
    $("#field-harga, #field-discount, #field-dp").on('keyup keypress change', function() {
        var harga = $("#field-harga").val();
        var dp = $('#field-dp').val();
        var disc = $('#field-discount').val();
        var total = parseInt(harga) - parseInt(dp) - parseInt(disc);
        $('#field-total').val(total);
    });
    
});