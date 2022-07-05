<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    //Form validation
	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});
	jQuery.validator.addMethod("filesize_max", function(value, element, param) {
	    var isOptional = this.optional(element),
	        file;
	    
	    if(isOptional) {
	        return isOptional;
	    }
	    
	    if ($(element).attr("type") === "file") {
	        
	        if (element.files && element.files.length) {
	            
	            file = element.files[0];            
	            return ( file.size && file.size <= param ); 
	        }
	    }
	    return false;
	}, "File size is too large.");

	var form = $("#form-add");
	form.validate({
		rules: {
		    foto: {
		      required: true,
		      extension: "jpg|jpeg|png",
		      filesize_max: 20000000
		    }
		  },
	  	submitHandler: function(form) {
	    	form.submit();
	  	}
	 });

	$('#i-btn-attach').click(function(event) {
		/* Act on the event */
		reset_form();
		$('#q').val();
	  	$('#modal-add').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
	});
		
	function reset_form(){
		$('#form-add')[0].reset();
		form.validate().resetForm();
		form.find(".error").removeClass("error");
	}

	function zoom_(a, b){
		$('#img').attr('src', a);
		$('#note-display').text('NOTE: ' + b);
		$('#modal-zoom').modal('show');
	}
</script>