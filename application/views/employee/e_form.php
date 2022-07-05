<!--begin::Modal-->
<div class="modal fade" id="e-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--begin::Form-->
      <?php echo form_open('', array('class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => 'e-form')); ?>
      <input type="hidden" name="e_id">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-portlet__body">
          <div class="form-group m-form__group row">
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label" for="description">Employee ID*:</label>
              <input type="text" class="form-control m-input" placeholder="Employee ID" name="e_employee_id" id="e-employee-id" readonly="">
              <span class="m-form__help">Please enter a employee ID</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label" for="description">Employee Name*:</label>
              <input type="text" class="form-control m-input" placeholder="Employee Name" name="e_employee_name" id="e-employee-name">
              <span class="m-form__help">Please enter a employee name</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label" for="description">Email*:</label>
              <input type="email" class="form-control m-input" placeholder="Email" name="e_email" id="e-email">
              <span class="m-form__help">Please enter a email</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label">Head Name*:</label>
              <select class="form-control m-input m-input--square m-select2" name="e_head_name" id="e-head-name">
                <option value="">- Choose Head Name -</option>
              </select>
              <span class="m-form__help">Please choose a head name</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label">Department*:</label>
              <select class="form-control m-input m-input--square m-select2" name="e_department" id="e-department">
                <option value="">- Choose Department -</option>
                <?php foreach ($department->result() as $value) {
                    echo "<option value='$value->id'>$value->department_name</option>";
                } ?>
              </select>
              <span class="m-form__help">Please choose a department</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label">Join Date*:</label>
              <div class="input-group date">
                <input type="text" class="form-control m-input" placeholder="Select date" autocomplete="off" id="e-join-date" name="e_join_date" readonly="">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-calendar"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Please choose a date</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label" for="breed">Level*:</label>
              <select class="form-control m-input m-input--square m-select2" name="e_level" id="e-level">
                <option value="">- Choose Level -</option>
                <?php foreach ($level->result() as $value) {
                    echo "<option value='$value->id'>$value->level_name</option>";
                } ?>
              </select>
              <span class="m-form__help">Please choose a level</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label" for="breed">Area*:</label>
              <select class="form-control m-input m-input--square m-select2" name="e_area" id="e-area">
                <option value="">- Choose Area -</option>
                <?php foreach ($area->result() as $value) {
                    echo "<option value='$value->id'>$value->area_name</option>";
                } ?>
              </select>
              <span class="m-form__help">Please choose a area</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label">Resign Date*:</label>
              <div class="input-group date">
                <input type="text" class="form-control m-input" placeholder="Select date" autocomplete="off" id="e-resign-date" name="e_resign_date" readonly="">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-calendar"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Please choose a date</span>
            </div>
            <div class="col-lg-4 m-form__group-sub">
              <label class="col-form-label">Status*:</label>
              <div class="m-radio-inline">
                <label class="m-radio m-radio--state-brand">
                  <input type="radio" name="e_status" value="1"> Active
                  <span></span>
                </label>
                <label class="m-radio m-radio--state-brand">
                  <input type="radio" name="e_status" value="0"> Inactive
                  <span></span>
                </label>
              </div>
              <span class="m-form__help">Can't edit a status here.</span>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
          <!-- FORM FOOT HERE, IF ANY -->
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn m-btn--pill m-btn--air btn-secondary" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn m-btn--pill m-btn--air btn-primary" id="e-btn-submit">Save</button>
      </div>
      <?php echo form_close(); ?>
      <!--end::Form-->
    </div>
  </div>
</div>
<!--end::Modal-->