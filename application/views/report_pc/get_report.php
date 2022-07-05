<div class="m-grid__item m-grid__item--fluid m-wrapper">
  <!-- BEGIN: Subheader -->
  <div class="m-subheader">
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
    <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
            <?php echo ucfirst($this->table_title); ?>
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
          <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item"></li>
            
              
            <li class="m-portlet__nav-item"></li>
          </ul>
        </div>
      </div>
      <form>
      <div class="col-md-4 m-form__group-sub">
          <label class="col-form-label m-form__group-sub">Periode <?php $data['report']->date_from ?></label>
            <input type="text" class="form-control m-input" name="periode" id="periode" readonly="true">
      </div>
      </form>
      <div class="m-portlet__body" id="div_table1">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="mal-table-2">
          <thead>
            <tr>
              <th id="no">No. Petty Cash</th>
              <th id="name">Name</th>
              <th id="dept">Department</th>
              <th id="area">Area</th>
              <th id="date">Date From</th>
              <th id="date">Date To</th>
              <th id="bkk">No. BKK</th>
              <th id="acc">Account Code</th>
              <th id="acm">Account Name</th>
              <th id="amm">Ammount</th>
              <th id="desc">Descriptions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['report'] as $key => $value): ?>
            <tr>
              <td><?= $value->pc_no ?></td>
              <td><?= $value->username ?></td>
              <td><?= $value->pc_name ?></td>
              <td><?= $value->area_name ?></td>
              <td><?= $value->date_from ?></td>
              <td><?= $value->date_to ?></td>
              <td><?= $value->bkk_no ?></td>
              <td><?= $value->account_code ?></td>
              <td><?= $value->pc_name ?></td>
              <td><?= $value->amount ?></td>
              <td><?= $value->remark ?></td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>