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
            <?php if ($this->authority->__is_super_admin() || $this->authority_crud->print) { ?>
            <li class="m-portlet__nav-item">
              <a href="javascript:;" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" id="i-btn-print">
                <span>
                  <i class="la la-print"></i>
                  <span>Print</span>
                </span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="m-portlet__body" id="print-area">
        <!--begin::Base Styles -->
        <link href="<?php echo base_url('assets/metronic/vendors/base/vendors.bundle.css'); ?>" rel="stylesheet" type="text/css" />
        <!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php echo base_url('assets/metronic/demo/default/base/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
        <style type="text/css">
          @media print{@page {size: auto;}}
        </style>
        <div class="m-invoice-2">
          <div class="m-invoice__wrapper">
            <h4 style="text-align: center; font-size: 21"><strong>PT. MALINDO FOOD DELIGHT</strong></h4>
            <p style="text-align: center; font-size: 14px;"><strong>CLAIM PETTY CASH (PC)</strong></p>
            <p style="text-align: center; font-size: 14px;"><strong>No PC :02./<?php echo $header->dept_name ?>/2019</strong></p>
            <!-- <hr> --><br>
            <table class="table table-condensed table-borderless" style="border-style: solid; border-width: 1px 0px 1px 0px;">
              <tr>
                <td style="padding-left: 20px;">
                  <table class="table table-condensed table-borderless">
                    <tr>
                      <th>Nama</th>
                      <td>:</td>
                      <td><?php echo $header->name ?></td>
                    </tr>
                    <tr>
                      <th>Periode</td>
                      <td>:</td>
                      <td><?php echo $header->datefrom ?> - <?php echo $header->dateto ?></td>
                    </tr>
                  </table>
                </td>
                <td></td>
                <td style="padding-left: 300px;">
                  <table>
                    <tr>
                      <th>Department</th>
                      <td>:</td>
                      <td><?php echo $header->dept_name ?></td>
                    </tr>
                    <tr>
                      <th>Depo/Area</th>
                      <td>:</td>
                      <td><?php echo $header->area_name ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <!-- <hr> --> <br>
            <table class="table table-condensed table-borderless">
              <thead style="border-style: solid; border-width: 1px;">
                <tr>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">No</th>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">Tanggal</th>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">No. BKK</th>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">Keterangan</th>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">Akun</th>
                  <th style="border-style: ridge; border-width: 0px 2px 0px 0px;">jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total = 0;
                foreach ($detail as $i => $value) { 
                  $total = $total + $value->amount;
                ?>
                  <tr style="border-style: solid; border-width: 1px;">
                    <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"> <?php echo $i+1; ?></td>
                    <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"> <?php echo date('d-m-Y', strtotime($value->trans_date)); ?></td>
                    <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"> <?php echo $value->bkk_no; ?></td>
                    <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"> <?php echo $value->remark; ?></td>
                    <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"> <?php echo $value->pc_name; ?></td>
                    <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?php echo number_format($value->amount, 2, ',', '.'); ?></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Total</th>
                  <td style="text-align:"></td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?php echo number_format($total, 2, ',', '.') ?></td>
                <tr>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Limit Petty Cash</th>
                  <td style="text-align: right; "></td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?php echo number_format($pc_limit->pc_limit, 2, ',', '.') ?></td>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Claim PC saat ini</th>
                  <td style="text-align: right; "></td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?php echo number_format($total, 2, ',', '.') ?></td>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Claim PC yang belum dibayar</th>
                  <td style="text-align: center;">(-)</td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?=(!is_null($header->unpaid_amt)) ? number_format($header->unpaid_amt, 2, ',', '.'): '-'; ?></td>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Dokumen PC yang belum di Claim</th>
                  <td style="text-align: center; ">(-)</td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?=(!is_null($header->pending_amt)) ? number_format($header->pending_amt, 2, ',', '.'): '-'; ?></td>
                <tr style="border-style: solid; border-width: 1px 0px 1px 1px;">
                  <th colspan="4" style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;">Dana Cash Tersedia</th>
                  <td style="text-align: center; ">(-)</td>
                  <td style="text-align: right; border-style: ridge; border-width: 0px 2px 0px 0px;"><?php echo number_format(($pc_limit->pc_limit - $total - $header->unpaid_amt - $header->unpaid_amount ), 2, ',', '.') ?></td>
              </tfoot>
            </table>
            <p>*Note</p>
            <p>Mohon Transfer ke rekening :  <?php echo $header->rek_name ?>, Bank <?php echo $header->bank ?> dengan Nomor Rekening <?php echo $header->rek_no ?></p>
            <!-- <div class="m-invoice__footer"> -->
              <div>
              <div class="">
                <footer style="clear: both;
    position: relative;
    margin-bottom: -10px;">
                <table class="table table-condensed table-borderless">
                  <tr>
                    <th><strong>Prepared By,</strong></th>
                    <th><strong>Checked By,</strong></th>
                    <th><strong>Verified By,</strong></th>
                    <th><strong>Approved By,</strong></th>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>(&nbsp;<?php echo $header->prepared_by ?>&nbsp;)</td>
                    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                    <td>(&nbsp;Management&nbsp;)</td>
                  </tr>
                  <tr>
                    <td>Tanggal : <?php echo $header->dateto ?></td>
                    <td>Tanggal : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Tanggal : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td></td>
                  </tr>
                </table>
                <br>
                <br>
                <table class="table table-condensed table-borderless">
                  <tr >
                    <td>
                      <table style="border-style: solid; border-width: 1px;">
                        <tr>
                          <td style="width: 80px; height: 50px; border-style: ridge; border-width: 0px 0px 2px 0px;">DPP</td>
                          <td style="border-style: ridge; border-width: 0px 0px 2px 0px;">:</td>
                          <td style="width: 200px; border-style: ridge; border-width: 0px 2px 2px 0px;"></td>
                          <td style="width: 400px; text-align: center; border-style: ridge; border-width: 0px 2px 2px 0px;"><strong> Stempel Accounting</strong></td>
                          <td style="width: 400px; text-align: center;border-style: ridge; border-width: 0px 2px 2px 0px;"><strong>Stempel Kasir</strong></td>
                          <td style="width: 400px; text-align: center;border-style: ridge; border-width: 0px 2px 2px 0px;"><strong>Stempel Finance</strong></td>
                        </tr>
                        <tr>
                          <td style="border-style: ridge; height: 50px; border-width: 0px 0px 2px 0px;">Jenis PPH</td>
                          <td style="border-style: ridge; border-width: 0px 0px 2px 0px;">:</td>
                          <td style="border-style: ridge; border-width: 0px 2px 2px 0px;"><?=($header->pph > 0) ? $header->pph: '-'; ?></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                        </tr>
                        <tr>
                          <td style="border-style: ridge; height: 50px; border-width: 0px 0px 2px 0px;">Tarif</td>
                          <td style="border-style: ridge; border-width: 0px 0px 2px 0px;">:</td>
                          <td style="border-style: ridge; border-width: 0px 2px 2px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                        </tr>
                        <tr>
                          <td style="border-style: ridge; height: 50px; border-width: 0px 0px 2px 0px;">Jumlah</td>
                          <td style="border-style: ridge; border-width: 0px 0px 2px 0px;">:</td>
                          <td style="border-style: ridge; border-width: 0px 2px 2px 0px;"width="50px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                          <td style="border-style: ridge; border-width: 0px 2px 0px 0px;"></td>
                        </tr>
                      </table>
                    </td>
                    <!-- <td>
                      <p style="border-style: solid; border-width: 1px; height: 40px;"><strong> Stempel Accounting</strong></p>
                      <hr style="border-style: solid;border-width: 1px; padding-left: 200px; max-width: 40px;">
                    </td>
                    <td>
                      <p style="border-style: solid; border-width: 1px; height: 40px;"><strong>Stempel Kasir</strong></p>
                      <hr style="border-style: solid;border-width: 1px; padding-left: 200px; max-width: 40px;">
                    </td>
                    <td>
                      <p style="border-style: solid; border-width: 1px; height: 40px;"><strong>Stempel Finance</strong></p>
                      <hr style="border-style: solid;border-width: 1px; padding-left: 200px; max-width: 40px;">
                    </td> -->
                  </tr>
                </table>
              </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>