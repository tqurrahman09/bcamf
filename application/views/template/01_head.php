<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Nutech | <?php echo $this->title; ?></title>
		<meta name="description" content="Basic datatables examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Web font -->

		<!--begin::Page Vendors Styles -->
		<link href="<?php echo base_url('assets/metronic/vendors/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/vendors/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Page Vendors Styles -->

		<!--begin::Base Styles -->
		<link href="<?php echo base_url('assets/metronic/vendors/base/vendors.bundle.css'); ?>" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="<?php echo base_url('assets/metronic/demo/default/base/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/malindo/img/title.png'); ?>" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-page--loading-enabled m-page--loading"> <!-- add form minimize:: m-aside-left--minimize m-brand--minimize -->

		<!-- begin::Page loader -->
		<div class="m-page-loader m-page-loader--base">
			<div class="m-blockui">
				<span>Please wait...</span>
				<span>
					<div class="m-loader m-loader--brand"></div>
				</span>
			</div>
		</div>
		<!-- end::Page loader -->

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">