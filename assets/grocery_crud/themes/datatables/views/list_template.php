<?php
	$this->set_css('assets/additional/js/plugins/datatables/dataTables.bootstrap.css');

	// Jquery
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);	
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	if (!$this->is_IE7()) {
		$this->set_js_lib($this->default_javascript_path.'/common/list.js');
	}

	$this->set_js('assets/additional/js/plugins/datatables/jquery.dataTables.min.js');
	$this->set_js('assets/additional/js/plugins/datatables/dataTables.bootstrap.min.js');

	// $this->set_js($this->default_theme_path.'/datatables/js/cookies.js');
	$this->set_js($this->default_theme_path.'/datatables/js/flexigrid.js');

    $this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Fancybox */
	$this->set_css('assets/additional/js/plugins/fancybox/jquery.fancybox.css');
	$this->set_js('assets/additional/js/plugins/fancybox/jquery.fancybox.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

	$this->set_js('assets/metronic/vendors/custom/datatables/datatables.bundle.js');
	$this->set_js($this->default_theme_path.'/datatables/js/metronic-table.min.js');

	/** Jquery UI */
	$this->load_js_jqueryui();
?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo $subject?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
</script>
<!--ga faham-->
<div id='list-report-error' class='report-div error ' ></div>
<!--alert-->
<div id='list-report-success' class='report-div success report-list' ></div>

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
				<?php echo $subject ?>
				</h3>
			</div>
		</div>
		<?php if(!$unset_add || !$unset_export || !$unset_print){?>
		<div class="m-portlet__head-tools">
			<ul class="m-portlet__nav">
				<?php if(!$unset_add){?>
				<li class="m-portlet__nav-item">
					<a href="<?php echo $add_url?>" title="<?php echo $this->l('list_add'); ?> <?php echo $subject?>" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
						<span>
							<i class="la la-plus"></i>
							<span><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
						</span>
					</a>
				</li>
				<?php } ?>
				<li class="m-portlet__nav-item"></li>
				<?php if(!$unset_export || !$unset_print) { ?>
				<li class="m-portlet__nav-item">
					<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
						<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
							<i class="la la-ellipsis-h m--font-brand"></i>
						</a>
						<div class="m-dropdown__wrapper">
							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
							<div class="m-dropdown__inner">
								<div class="m-dropdown__body">
									<div class="m-dropdown__content">
										<ul class="m-nav">
											<li class="m-nav__section m-nav__section--first">
												<span class="m-nav__section-text">Export or print</span>
											</li>
											<?php if(!$unset_export) { ?>
											<li class="m-nav__item">
												<a class="m-nav__link" href="<?php echo $export_url; ?>">
													<i class="m-nav__link-icon la la-file-excel-o"></i>
													<span class="m-nav__link-text"><?php echo $this->l('list_export');?></span>
												</a>
											</li>
											<?php } ?>
											<?php if(!$unset_print) { ?>
											<li class="m-nav__item">
												<a class="m-nav__link print-anchor" href="<?php echo $print_url; ?>" target="_blank">
													<i class="m-nav__link-icon flaticon-technology"></i>
													<span class="m-nav__link-text"><?php echo $this->l('list_print');?></span>
												</a>
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<!-- iki pencariane -->
	<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>
	<div class="m-portlet__body ajax_list" id="ajax_list">
		<?php echo $list_view?>
	</div>
	<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'><span id="btn-refresh"></span></div>
	<?php echo form_close(); ?>		
</div>
<script>
	var successMesage = "<?php echo $success_message; ?>";
</script>