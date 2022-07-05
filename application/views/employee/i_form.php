<!--begin::Modal-->
<div class="modal fade" id="i-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <!--begin::Form-->
      <?php echo form_open_multipart('', array('class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => 'i-form')); ?>
      <div class="modal-header">
        <h5 class="modal-title" id="a-exampleModalLabel">Form Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-portlet__body">
          <div class="form-group m-form__group">
            <label for="exampleInputEmail1">File Browser</label>
            <div></div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="file" name="file">
              <label class="custom-file-label selected" for="file"></label>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
          <!-- FORM FOOT HERE, IF ANY -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn m-btn--pill m-btn--air btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn m-btn--pill m-btn--air btn-primary" id="i-btn-submit">Import</button>
      </div>
      <?php echo form_close(); ?>
      <!--end::Form-->
    </div>
  </div>
</div>
<!--end::Modal-->