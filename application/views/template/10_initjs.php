<!--begin::Base Scripts -->
<script src="<?php echo base_url('assets/metronic/vendors/base/vendors.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/demo/default/base/scripts.bundle.js'); ?>" type="text/javascript"></script>
<!-- begin atan -->
<script src="<?php echo base_url('assets/metronic/demo/default/base/cleave.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/demo/default/base/cleave-phone.i18n.js'); ?>" type="text/javascript"></script>
<!-- end atan -->
<!--end::Base Scripts -->
<!--begin::Page Vendors Scripts -->
<script src="<?php echo base_url('assets/metronic/vendors/custom/datatables/datatables.bundle.js'); ?>" type="text/javascript"></script>
<!--end::Page Vendors Scripts -->
<!--begin::Page Resources -->
<script> 
	var baseUrl = '<?php echo site_url() ?>'; 
	var formAdd = $("#a-form");
	var formEdit = $("#e-form");
	var formImport = $("#i-form");
	var modalAdd = $("#a-modal");
	var modalEdit = $("#e-modal");
	var modalDetail = $("#d-modal");
	var modalImport = $("#i-modal");
	var table;
	var tableGroup;
	// var csrfName = '<?php //echo $this->security->get_csrf_token_name(); ?>';
	// var csrfHash = '<?php //echo $this->security->get_csrf_hash(); ?>';
	// $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
	//     if (originalOptions.data) { 
	//          originalOptions.data.append(csrfName, csrfHash); 
	//     }
	// });
</script>
<!--end::Page Resources -->