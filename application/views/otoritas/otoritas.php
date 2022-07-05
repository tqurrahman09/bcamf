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
  <!-- begin::content -->
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
              User Group
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
          <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
              <a href="javascript:;" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" id="btn-form">
                <span>
                  <i class="la la-plus"></i>
                  <span>New Group</span>
                </span>
              </a>
            </li>
            <li class="m-portlet__nav-item"></li>
          </ul>
        </div>
      </div>
      <div class="m-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="table-group">
          <thead>
            <tr>
              <th></th>
              <th>Group</th>
              <th></th>
            </tr>
          </thead>
        </table>
        <!-- end::Datatables -->
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
    <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
            Otoritas/User Role
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="table">
          <thead>
            <tr>
              <th>Group</th>
              <th>Module</th>
              <th>Insert</th>
              <th>Update</th>
              <th>Delete</th>
              <th>View</th>
              <th>View Detail</th>
              <th>Export Excel</th>
              <th>Print</th>
              <th>Post</th>
              <th>Cancel</th>
              <th>Attachment</th>
              <th></th>
            </tr>
          </thead>
        </table>
        <!-- end::Datatables -->
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
  <!-- end:content -->
</div>