<!--begin::Modal-->
<div class="modal fade" id="e-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--begin::Form-->
      <?php echo form_open('', array('class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => 'e-form')); ?>
      <input type="hidden" name="e_id" id="e-id">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-portlet__body">
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Foto Barang</label>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="input-group">
                <input type="file" class="form-control m-input" name="e_fotoBarang" id="e-fotoBarang">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-black-tie"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Masukan Foto Barang</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Nama Barang</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control m-input" name="e_namaBarang" id="e-namaBarang">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-black-tie"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Masukan Nama Barang</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Harga Beli</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control m-input" name="e_hargaBeli" id="e-hargaBeli" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-black-tie"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Masukan Harga Beli</span>
            </div>
            <label class="col-form-label col-lg-2 col-sm-12">Harga Jual</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control m-input" name="e_hargaJual" id="e-hargaJual" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-black-tie"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Masukan Harga Jual</span>
            </div>
          </div>
          <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-2 col-sm-12">Stok</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
              <div class="input-group">
                <input type="text" class="form-control m-input" name="e_stok" id="e-stok" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="la la-black-tie"></i>
                  </span>
                </div>
              </div>
              <span class="m-form__help">Masukan Stok</span>
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