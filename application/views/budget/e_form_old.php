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
    <?php echo form_open(site_url('petty-chash/edit-submit'), array('id' => 'a-form')); ?>
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
            <a href="<?php echo site_url('petty-chash') ?>" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-arrow-left"></i>
                <span>Back</span>
              </span>
            </a>
            <?php if ((!$pc->cancel && !$pc->post && !$pc->import) || $this->session->userdata($this->config->item('is_accounting')) || $this->authority->__is_super_admin()) { ?>
              <button type="submit" value="save" name="action" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-save"></i>
                <span>Save</span>
              </span>
              </button>
            <?php } ?>
            <?php if (((!$pc->cancel && !$pc->import) || $this->session->userdata($this->config->item('is_accounting')) || $this->authority->__is_super_admin()) && !$pc->post) { ?>
              <button type="submit" value="post" name="action" class="btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-check-square-o"></i>
                <span>Post</span>
              </span>
              </button>
            <?php } ?>
            <?php if (!$pc->cancel && !$pc->import && !$pc->post) { ?>
              <button type="submit" value="cancel" name="action" class="btn btn-danger m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-close"></i>
                <span>Cancel</span>
              </span>
              </button>
            <?php } ?>
            <?php if ($pc->post) { ?>
              <button type="submit" value="print" name="action" class="btn btn-info m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
              <span>
                <i class="la la-print"></i>
                <span>Print</span>
              </span>
              </button>
            <?php } ?>
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
            <input type="hidden" name="id" value="<?php echo str_replace(" ", "+", $this->input->get('q')); ?>">
            <div class="form-group m-form__group row">
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">No PC</label>
                <input type="text" class="form-control m-input" name="pc_no" id="pc-no" placeholder="No PC" readonly="true" value="<?php echo $pc->pc_no ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-4 m-form__group-sub">
                <label class="col-form-label m-form__group-sub">Periode</label>
                <input type="text" class="form-control m-input" name="periode" id="periode" readonly="true" value="<?php echo date('m/d/Y', strtotime($pc->date_from)).' - '.date('m/d/Y', strtotime($pc->date_to)); ?>">
                <span class="m-form__help">Please choose a periode</span>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Name</label>
                <input type="text" class="form-control m-input" name="name" id="name" placeholder="Name" readonly="true" value="<?php echo $pc->username ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Rek.</label>
                <input type="text" class="form-control m-input" name="rek" id="rek" placeholder="Rek." readonly="true" value="<?php echo $pc->rek_no; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Department:</label>
                <input type="text" class="form-control m-input" name="department" id="department" placeholder="Department" readonly="true" value="<?php echo $user->dept_name; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Area:</label>
                <input type="text" class="form-control m-input" name="area" id="area" placeholder="Area" readonly="true" value="<?php echo $pc->area_name; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">PC Unpaid:</label>
                <select class="form-control m-input selectpickers" name="pc_unpaid" id="pc-unpaid" data-live-search="true">
                  <option value="">- PC Unpaid -</option>
                  <?php foreach ($pc_unpaid->result() as $value) { ?>
                  <option value="<?php echo $value->pc_no ?>" <?=($value->pc_no == $pc->pc_unpaid) ? 'selected': ''; ?>><?php echo $value->pc_no; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <?php if($this->session->userdata($this->config->item('is_accounting')) || $this->authority->__is_super_admin()) { ?>
            <div class="form-group m-form__group row">
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">PPH:</label>
                <input type="text" class="form-control m-input" name="pph" id="pph" placeholder="PPH" value="<?php echo $pc->pph; ?>">
                <span class="m-form__help">Please enter pph if any</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">AX Journal Number:</label>
                <input type="text" class="form-control m-input" name="ax_journal_number" id="ax-journal-number" placeholder="AX Journal Number" value="<?php echo $pc->journal_ax_num; ?>">
                <span class="m-form__help">Please enter ax journal number</span>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="m-form__section m-form__section--first">
            <div class="m-form__heading">
              <h3 class="m-form__heading-title">Detail</h3>
            </div>
            <div id="a-repeater">
              <div class="row" id="m_repeater_1">
                <div data-repeater-list="details" class="col-lg-12">
                  <div data-repeater-item class="form-group m-form__group row align-items-center">
                    <div class="col-md-3 m-form__group-sub">
                      <div class="m-form__group">
                        <div class="m-form__label">
                          <label class="m-label m-label--single">Date:</label>
                        </div>
                        <div class="m-form__control">
                          <input type="text" class="form-control m-input trans-date" name="trans_date" required="true" placeholder="Choose Trans Date" readonly="true">
                        </div>
                      </div>
                      <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-3 m-form__group-sub">
                      <div class="m-form__group">
                        <div class="m-form__label">
                          <label class="m-label m-label--single">No. BKK:</label>
                        </div>
                        <div class="m-form__control">
                          <input type="text" class="form-control m-input" name="bkk_no" required="true" placeholder="Enter No. BKK">
                        </div>
                      </div>
                      <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-3 m-form__group-sub">
                      <div class="m-form__group">
                        <div class="m-form__label">
                          <label class="m-label m-label--single">Keterangan:</label>
                        </div>
                        <div class="m-form__control">
                          <input type="text" class="form-control m-input" name="remark" required="true" placeholder="Enter remark">
                        </div>
                      </div>
                      <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-3 m-form__group-sub">
                      <div class="m-form__group">
                        <div class="m-form__label">
                          <label class="m-label m-label--single">Akun:</label>
                        </div>
                        <div class="m-form__control">
                          <select class="form-control m-input selectpickers" name="pc_code" id="pc-code" data-live-search="true" required="">
                            <option value="" selected disabled>- Choose Akun -</option>
                            <?php foreach ($pc_type->result() as $value) { ?>
                            <option value="<?php echo $value->pc_code ?>"><?php echo $value->pc_name.' - '.$value->account_code; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-3 m-form__group-sub">
                      <div class="m-form__group">
                        <div class="m-form__label">
                          <label class="m-label m-label--single">Amount:</label>
                        </div>
                        <div class="m-form__control">
                          <input type="text" class="form-control m-input" name="ammount" required="true" placeholder="Enter amount">
                        </div>
                      </div>
                      <div class="d-md-none m--margin-bottom-10"></div>
                    </div>
                    <div class="col-md-1">
                      <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
                        <span>
                          <i class="la la-trash-o"></i>
                          <span>Delete</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-lg-1 col-form-label"></label>
                <div class="col-lg-1">
                  <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide btn-m-repeater">
                    <span>
                      <i class="la la-plus"></i>
                      <span>Add</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
          <!-- <div class="m-form__actions m-form__actions--solid">
            <div class="row">
              <div class="col-lg-5"></div>
              <div class="col-lg-7">
                <button type="reset" class="btn btn-brand">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!--end::Portlet-->
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>

<script>
  var details = <?php echo json_encode($pc_details) ?>
</script>