<div class="m-grid__item m-grid__item--fluid m-wrapper">
  <!-- BEGIN: Subheader -->
  <div class="m-subheader ">
    <div class="d-flex align-items-center">
      <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator"><?php echo ucfirst($this->module_title); ?></h3>
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
          <li class="m-nav__item m-nav__item--home">
            <a href="#" class="m-nav__link m-nav__link--icon">
              <i class="m-nav__link-icon la la-home"></i>
            </a>
          </li>
          <li class="m-nav__item">
            <a href="" class="m-nav__link">
              <span class="m-nav__link-text"><?php echo $this->breadcrumb; ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- END: Subheader -->
  <div class="m-content">
    <?php if(!is_null($this->info)){ ?>
    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
      <div class="m-alert__icon">
        <i class="flaticon-exclamation m--font-brand"></i>
      </div>
      <div class="m-alert__text">
        <?php echo $this->info; ?>
      </div>
    </div>
    <?php } ?>
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
              <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
            <?php echo $this->table_title; ?>
            </h3>
          </div>
        </div>
      </div>
      <!--begin::Form-->
      <?php echo form_open('leave/add', array('class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => 'a-form')); ?>
      <div class="m-portlet__body">
        <?php if($this->session->userdata('message')){ ?>
        <div class="form-group m-form__group m--margin-top-10">
          <div class="m-alert m-alert--icon m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
            <div class="m-alert__icon">
              <i class="la la-info"></i>
            </div>
            <div class="m-alert__text">
              <strong>FYI!</strong> <?php echo $this->session->userdata('message'); ?>
            </div>
            <div class="m-alert__close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              </button>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="form-group m-form__group row">
          <div class="col-lg-4 m-form__group-sub">
            <label class="form-control-label">Date*:</label>
            <input type="text" class="form-control m-input" name="date" id="date" readonly="">
            <span class="m-form__help">Please enter your leave dates</span>
          </div>
          <div class="col-lg-3 m-form__group-sub">
            <label class="form-control-label">Head:</label>
            <input type="text" class="form-control m-input" name="head" id="head" value="<?php echo $head->row()->head_name; ?>" disabled="true">
            <span class="m-form__help">Generate automatically</span>
          </div>
        </div>
        <div class="form-group m-form__group row">
          <div class="col-lg-4 m-form__group-sub">
            <label class="form-control-label">Purpose*:</label>
            <div class="m-input-icon m-input-icon--right">
              <textarea class="form-control m-input" name="purpose" id="purpose" rows="3"></textarea>
            </div>
            <span class="m-form__help">Please enter your purpose</span>
          </div>
          <div class="col-lg-4 m-form__group-sub">
            <label class="form-control-label">Job*:</label>
            <div class="m-input-icon m-input-icon--right">
              <textarea class="form-control m-input" name="job" id="job" rows="3"></textarea>
            </div>
            <span class="m-form__help">Please enter your job</span>
          </div>
        </div>
        <div class="form-group m-form__group row">
          <div class="col-lg-4 m-form__group-sub">
            <label class="form-control-label">Job Delegation*:</label>
            <input type="text" class="form-control m-input" name="job_delegation" id="job-delegation">
            <span class="m-form__help">Please enter your job delegation</span>
          </div>
          <div class="col-lg-4 m-form__group-sub">
            <label class="form-control-label">Type*:</label>
            <select class="form-control m-input" name="type" id="type">
              <option value="">- Type -</option>
              <option value="1">Leave</option>
              <option value="2">Change Day</option>
            </select>
            <span class="m-form__help">Please enter type of leave</span>
          </div>
        </div>
        <div class="form-group m-form__group row">
          <div class="m-widget29">
            <div class="m-widget_content">
              <h3 class="m-widget_content-title">Your leave in this periode</h3>
              <div class="m-widget_content-items">
                <div class="m-widget_content-item">
                  <span>In progress</span>
                  <span class="text-warning">2</span>
                </div>
                <div class="m-widget_content-item">
                  <span>Leave right</span>
                  <span class="text-primary">15</span>
                </div>
                <div class="m-widget_content-item">
                  <span>Leave taken</span>
                  <span class="text-danger">3</span>
                </div>
                <div class="m-widget_content-item">
                  <span>Leave remain</span>
                  <span class="text-success">12</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
          <div class="row">
            <div class="col-lg-6">
              <button type="Submit" class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" name="save" value="save">
              <span>
                <i class="la la-save"></i>
                <span>Save</span>
              </span>
              </button>
              <a href="<?php echo site_url('leave'); ?>" class="btn btn-danger m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                <span>
                  <i class="la la-undo"></i>
                  <span>Cancel</span>
                </span>
              </a>
            </div>
            <div class="col-lg-6 m--align-right">
              <button type="Submit" class="btn btn-success m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" name="submit" value="submit">
              <span>
                <i class="la la-send"></i>
                <span>Submit</span>
              </span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
      <!--end::Form-->
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>