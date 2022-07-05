<!-- begin::Modal-->
<div class="modal fade" id="a-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--begin::Form-->
      <?php echo form_open('', array('class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => 'a-form')); ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-portlet__body">
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Group Name</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <input type="text" name="group_name" class="form-control m-input" id="name-group" placeholder="Nama Group" maxlength="30">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-group"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Enter a group name</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Module</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <select name="modules[]" id="module_" class="form-control m-input" multiple="multiple">
                  <?php foreach ($data['modules'] as $value) { ?>
                  <option value="<?php echo $value->id; ?>"><?php echo ucwords($value->alias); ?></option>
                  <?php } ?>
                </select>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-plus-circle"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Select a module</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="offset-lg-2 col-lg-4 col-md-9 col-sm-12">
              <label class="m-checkbox">
                <input type="checkbox" name="is_accounting" id="is-accounting" value="1"> Accounting?
                <span></span>
              </label>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
          <!-- FORM FOOT HERE, IF ANY -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn m-btn--pill m-btn--air btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn m-btn--pill m-btn--air btn-primary" id="btn-submit">Save</button>
      </div>
      <?php echo form_close(); ?>
      <!--end::Form-->
    </div>
  </div>
</div>
<!--end::Modal-->