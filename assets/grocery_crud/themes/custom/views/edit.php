<?php
	//$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/flexigrid/js/flexigrid-edit.js');

	//$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class="flexigrid crud-form box" style='width: 100%;' data-unique-hash="<?php echo $unique_hash; ?>">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-pencil fa-fw"></i> <?php echo $this->l('form_edit'); ?> <?php echo $subject?></h3>
	</div>
	<div id='main-table-box' class="box-body">
		<?php echo form_open( $update_url, 'method="post" class="form-horizontal" id="crudForm" autocomplete="off" enctype="multipart/form-data"'); ?>
                <div class="row" style="margin-bottom: 20px;">
		<?php $focus = 'none'; $i=1; foreach($fields as $field) { ?>
                    <div class="col-md-6">
			<div class='row' id="<?php echo $field->field_name; ?>_field_box">
                            <div class="form-group" style="margin:5px 20px;">
				<div class='form-display-as-box col-lg-3 control-label' id="<?php echo $field->field_name; ?>_display_as_box">
					<label>
						<?php echo strtoupper($input_fields[$field->field_name]->display_as) ?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?>
					</label>
				</div>
				<div class='form-input-box  col-lg-9' id="<?php echo $field->field_name; ?>_input_box">
					<?php echo $input_fields[$field->field_name]->input?>
				</div>
                            </div>
			</div>
                    </div>
			<?php if ($i == 1): $focus = "field-".$field->field_name; endif ?>
		<?php $i++; } ?>
                </div>
                        
		<?php if(!empty($hidden_fields)){?>
		<!-- Start of hidden inputs -->
			<?php
				foreach($hidden_fields as $hidden_field){
					echo $hidden_field->input;
				}
			?>
		<!-- End of hidden inputs -->
		<?php }?>
		<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
		<div id='report-error' class='report-div error alert alert-danger' role="alert"></div>
		<div id='report-success' class='report-div success alert alert-success'></div>

		<button  id="form-button-save" type='submit' class="btn btn-primary"/><?php echo $this->l('form_update_changes'); ?></button>
		<?php 	if(!$this->unset_back_to_list) { ?>
		<button type='button' id="save-and-go-back-button" class="btn btn-info"/><?php echo $this->l('form_update_and_go_back'); ?></button>
		<button type='button' class="btn btn-default" id="cancel-button" /><?php echo $this->l('form_cancel'); ?></button>
		<?php 	} ?>
		<span class='small-loading' id='FormLoading'><img src="<?php echo base_url('assets/svg/loading-spin-primary.svg') ?>" alt="loading..."> <?php echo $this->l('form_update_loading'); ?></span>
	<?php echo form_close(); ?>
	</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';
	var focus = '<?php echo $focus ?>';	
	var message_alert_edit_form = "<?php echo $this->l('alert_edit_form')?>";
	var message_update_error = "<?php echo $this->l('update_error')?>";
</script>