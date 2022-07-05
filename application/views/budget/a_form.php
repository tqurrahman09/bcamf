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
    <!--begin::Portlet-->
    <?php echo form_open(site_url('budget/add-submit'), array('id' => 'a-form')); ?>
    <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-progress">
          <!-- here can place a progress bar-->
        </div>
        <div class="m-portlet__head-wrapper">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
              <?php echo ucfirst($this->table_title); ?>
              </h3>
            </div>
          </div>
          <div class="m-portlet__head-tools">
            <a href="<?php echo site_url('budget') ?>" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-arrow-left"></i>
                <span>Back</span>
              </span>
            </a>
            <button type="submit" value="save" name="action" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
            <span>
              <i class="la la-save"></i>
              <span>Save</span>
            </span>
            </button>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <?php
        $errors = $this->session->userdata('errors');
        if(!empty($errors)){
        ?>
        <div class="m-alert m-alert--icon m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
          <div class="m-alert__icon">
            <i class="la la-warning"></i>
          </div>
          <div class="m-alert__text">
            <strong>Something wrong!</strong> <?php echo $errors ?>
          </div>
          <div class="m-alert__close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
          </div>
        </div>
        <?php } ?>
        <div class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
          <div class="m-form__section m-form__section--first">
            <div class="m-form__heading">
              <h3 class="m-form__heading-title">Header</h3>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-md-3 m-form__group-sub">
                <label class="col-form-label">User Id</label>
                <select class="form-control m-input selectpickers" name="user_id" id="user_id" data-live-search="true" required="true">
                  <option value="" selected disabled>- Choose Akun -</option>
                    <?php foreach ($user as $value) { ?>
                  <option value="<?php echo $value->user_id ?>"><?php echo $value->worker_code.' - '.$value->username; ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col-md-3 m-form__group-sub">
                <label class="col-form-label">Budget BBM</label>
                <input type="text" style="text-align: right;" class="form-control m-input budget_bbm" name="budget_bbm" id="budget_bbm" placeholder="Budget BBM">
              </div>
              <div class="col-md-3 m-form__group-sub">
                <label class="col-form-label">Budget Pulsa</label>
                <input type="text" style="text-align: right;" class="form-control m-input budget_pulsa" name="budget_pulsa" id="budget_pulsa" placeholder="Budget Pulsa">
              </div>
              <div class="col-md-3 m-form__group-sub">
                <label class="col-form-label">Budget Hotel</label>
                <input type="text" style="text-align: right;" class="form-control m-input budget_hotel" name="budget_hotel" id="budget_hotel" placeholder="Budget Hotel">
              </div>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        </div>
      </div>
    </div>
      
    <?php echo form_close(); ?>
    <!--end::Portlet-->
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>

