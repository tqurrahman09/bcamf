<?php
//$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
$this->set_js_lib($this->default_theme_path . '/flexigrid/js/jquery.form.js');
$this->set_js_config($this->default_theme_path . '/flexigrid/js/flexigrid-edit.js');

//$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
$this->set_js_lib($this->default_javascript_path . '/jquery_plugins/config/jquery.noty.config.js');
?>
<div class="flexigrid crud-form box" style='width: 100%;' data-unique-hash="<?php echo $unique_hash; ?>">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list fa-fw"></i> <?php echo $this->l('list_record'); ?> <?php echo $subject ?></h3>
    </div>
    <div id='main-table-box' class="box-body">
        <?php echo form_open($read_url, 'method="post" class="form-horizontal" id="crudForm" autocomplete="off" enctype="multipart/form-data"'); ?>

        <?php foreach ($fields as $field) { ?>
            <div class="form-group">
                <label class="col-sm-offset-2 col-sm-2 control-label">
                    <?php echo $input_fields[$field->field_name]->display_as ?><?php echo ($input_fields[$field->field_name]->required) ? "<span class='required'>*</span> " : "" ?>
                    <strong>:</strong>
                </label>
                <div class="col-sm-6" id="<?php echo $field->field_name; ?>_input_box">
                    <?php echo $input_fields[$field->field_name]->input ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($hidden_fields)) { ?>
            <!-- Start of hidden inputs -->
            <?php
            foreach ($hidden_fields as $hidden_field) {
                echo $hidden_field->input;
            }
            ?>
            <!-- End of hidden inputs -->
        <?php } ?>
            
        <div class="box-footer">
            <?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php } ?>
            <div id='report-error' class='report-div error alert alert-danger' role="alert"></div>
            <div id='report-success' class='report-div success alert alert-success'></div>

            <button type="button" id="cancel-button" class="btn btn-default back-to-list col-sm-offset-2"><?php echo $this->l('form_back_to_list'); ?></button>

            <span class='small-loading' id='FormLoading'><?php echo $this->l('form_update_loading'); ?></span>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    var validation_url = '<?php echo $validation_url ?>';
    var list_url = '<?php echo $list_url ?>';

    var message_alert_edit_form = "<?php echo $this->l('alert_edit_form') ?>";
    var message_update_error = "<?php echo $this->l('update_error') ?>";
</script>