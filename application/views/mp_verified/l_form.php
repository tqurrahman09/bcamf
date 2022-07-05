<style type="text/css">
  .zoom {
    -webkit-transition: all 0.35s ease-in-out;
    -moz-transition: all 0.35s ease-in-out;
    transition: all 0.35s ease-in-out;
    cursor: -webkit-zoom-in;
    cursor: -moz-zoom-in;
    cursor: zoom-in;
  }
</style>
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
            <?php if ($this->authority->__is_super_admin() || $this->authority_crud->attachment) { ?>
            <li class="m-portlet__nav-item">
              <a href="javascript:;" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" id="i-btn-attach">
                <span>
                  <i class="flaticon-attachment"></i>
                  <span>Attach File</span>
                </span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="m-portlet__body">
        <?php if ($file->num_rows() == 0) { ?>
          <div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
            <strong>No attacment!</strong> Please upload attachment in pdf format.
          </div>
        <?php } else { ?>
          <div class="row">
            <?php foreach ($file->result() as $i => $value) { ?>
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <!-- <div>
                  <a title="Foto <?php echo $i+1; ?>" href="javascript:void(0)">
                    <img class="img-fluid img-thumbnail zoom" src="<?php echo base_url($value->file); ?>" style="height: 150px; width: 300px" onclick="zoom_(<?php echo "'".base_url($value->file)."'"; ?>)">
                  </a>
                </div>style="display: flex; flex: 1" -->
                <div class="btn-group m-btn-group m-btn-group--pill" role="group" aria-label="..." >
                  <a type="button" class="m-btn btn btn-success btn-sm m-btn--icon" href="<?php echo base_url($value->file); ?>" style="flex: 1" download>
                    <span>
                      <i class="flaticon-attachment"></i>
                      <span>Download File</span>
                    </span>
                  </a>
                  <a type="button" class="m-btn btn btn-danger btn-sm m-btn--icon" href="<?php echo site_url('mp-verified/attachment-delete?q='.$this->encryption->encrypt($value->no_ref).'&r='.$this->input->get('q')); ?>" style="flex: 1">
                    <span>
                      <i class="flaticon-attachment"></i>
                      <span>Delete File</span>
                    </span>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
<!-- modal -->
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" action="<?php echo site_url('mp-verified/attachment-submit') ?>" method="post" id="form-add" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Attachment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <input type="hidden" name="id" id="id" value="<?php echo $this->input->get('q'); ?>">
            <div class="form-group">
              <label for="foto">File</label>
              <input type="file" name="attachment" class="form-control" id="attachment" required="true">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <button type="Submit" class="btn btn-primary" id="button-save">Save</button>
        </div>
      </form>
      <!-- End form -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade" id="modal-zoom">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-title">View</h4>
      </div>
      <div class="modal-body">
        <div class="modal-content">
          <img src="" alt="Image not found" id="img" style="width: auto; height: auto;" class="img-responsive">
          <div class="box-body">
            <p id="note-display"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      </div>
      <!-- End form -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->