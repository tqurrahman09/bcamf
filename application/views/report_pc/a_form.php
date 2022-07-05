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
    <?php echo form_open(site_url('petty-chash/add-submit'), array('id' => 'a-form')); ?>
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
            <a href="<?php echo site_url('monthly-expense') ?>" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
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
            <button type="submit" value="post" name="action" class="btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
            <span>
              <i class="la la-check-square-o"></i>
              <span>Post</span>
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
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">No PC</label>
                <input type="text" class="form-control m-input" name="pc_no" id="pc-no" placeholder="No PC" readonly="true" value="<?php echo $pc_no ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-4 m-form__group-sub">
                <label class="col-form-label m-form__group-sub">Periode</label>
                <input type="text" class="form-control m-input" name="periode" id="periode" readonly="true">
                <span class="m-form__help">Please choose a periode</span>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Name</label>
                <input type="text" class="form-control m-input" name="name" id="name" placeholder="Name" readonly="true" value="<?php echo $user->username; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Rek.</label>
                <input type="text" class="form-control m-input" name="rek" id="rek" placeholder="Rek." readonly="true" value="<?php echo $user->rek_no; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Department:</label>
                <input type="text" class="form-control m-input" name="department" id="department" placeholder="Department" readonly="true" value="<?php echo $user->dept_name; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Area:</label>
                <input type="text" class="form-control m-input" name="area" id="area" placeholder="Area" readonly="true" value="<?php echo $user->area_name; ?>">
                <span class="m-form__help">Generate automatically</span>
              </div>
            </div>
            <div class="form-group m-form__group row">
              <!-- <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">PC Unpaid:</label>
                <select class="form-control m-input selectpickers" name="pc_unpaid" id="pc-unpaid" data-live-search="true">
                  <option value="" selected>- PC Unpaid -</option>
                  <?php foreach ($pc_unpaid->result() as $value) { ?>
                  <option value="<?php echo $value->pc_no ?>"><?php echo $value->pc_no; ?></option>
                  <?php } ?>
                </select>
              </div> -->
              <!-- by ronix : 10-10-2019 -->
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Unpaid Amount:</label>
                <input type="text" class="form-control m-input unpaid_amt" name="unpaid_amt" id="unpaid_amt" placeholder="Unpaid Amount" style="text-align: right;">
                <span class="m-form__help">Please enter Unpaid amount</span>
              </div>
              <!-- end by ronix -->
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Pending Document:</label>
                <input type="text" class="form-control m-input pending_amt" name="pending_amt" id="pending_amt" placeholder="Pending Document" style="text-align: right;">
                <span class="m-form__help">Please enter Pending Document amount</span>
              </div>
              <div class="col-lg-3 m-form__group-sub">
                <label class="col-form-label">Prepared By</label>
                <input type="text" class="form-control m-input prepared_by" name="prepared_by" id="prepared_by" placeholder="Prepared By" style="text-align: right;">
                <span class="m-form__help">Please enter Prepared By</span>
              </div>
            </div>
          </div>
          <div class="m-form__section m-form__section--first">
            <div class="m-form__heading">
              <h3 class="m-form__heading-title">Detail</h3>
            </div>
            <table class="table table-bordered" id="a-repeater">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>No. BKK</th>
                  <th>Keterangan</th>
                  <th>Akun</th>
                  <th>Amount</th>
                  <th>
                    <!-- <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide btn-m-repeater">
                      <span>
                        <i class="la la-plus"></i>
                        <span>Add</span>
                      </span>
                    </div> -->
                  </th>
                </tr>
              </thead>
              <tbody id="m_repeater_1" data-repeater-list="details">
                <tr data-repeater-item>
                  <td>
                    <div class="form-group m-form__group" style="padding: 0px 0px 0px 0px;">
                      <input type="text" class="form-control m-input trans-date" name="trans_date" required="true" placeholder="Choose Trans Date" readonly="true">
                    </div>
                  </td>
                  <td>
                    <div class="form-group m-form__group" style="padding: 0px 0px 0px 0px;">
                      <input type="text" class="form-control m-input" name="bkk_no" required="true" placeholder="Enter No. BKK">
                    </div>
                  </td>
                  <td>
                    <div class="form-group m-form__group" style="padding: 0px 0px 0px 0px;">
                      <input type="text" class="form-control m-input" name="remark" autocomplete="on" placeholder="Enter remark">
                    </div>
                  </td>
                  <td style="min-width: 200px">
                    <div class="form-group m-form__group" style="padding: 0px 0px 0px 0px;">
                      <select class="form-control m-input selectpickers" name="pc_code" id="pc-code" data-live-search="true" required="">
                        <option value="" selected disabled>- Choose Akun -</option>
                        <?php foreach ($pc_type->result() as $value) { ?>
                        <option value="<?php echo $value->pc_code ?>"><?php echo $value->pc_name.' - '.$value->account_code; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </td>
                  <!-- begin atan -->
                  <td>
                    <div class="form-group m-form__group" style="padding: 0px 0px 0px 0px;">
                      <input type="text" id="ammount" class="form-control m-input amount" name="ammount" required="true" autocomplete="off" placeholder="Enter amount" style="text-align: right;">
                    </div>
                  </td>
                  <!-- end atan -->
                  <td>
                    <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
                      <span>
                        <i class="la la-trash-o"></i>
                        <span>Delete</span>
                      </span>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>Date</th>
                  <th>No. BKK</th>
                  <th>Keterangan</th>
                  <th>Akun</th>
                  <th>Amount</th>
                  <th>
                    <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide btn-m-repeater">
                      <span>
                        <i class="la la-plus"></i>
                        <span>Add</span>
                      </span>
                    </div>
                  </th>
                </tr>
              </tfoot>
            </table>
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
<script type="text/javascript">
  
          var cleave2 = new Cleave($(".unpaid_amt").last(), {
              numeral: true,
              numeralThousandsGroupStyle: 'thousand'
          });
          jQuery(document).ready(function() {
      AddJs.init()
        /* --- begin atan --- */
      var cleave = new Cleave($(".amount").last(), {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
        /* --- end atan --- */
  }
  );
</script>