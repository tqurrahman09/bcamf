<script>
    var baseUrl = "<?php echo site_url(); ?>" 
</script>
<!-- Metronic JS -->
<!--begin::Base Scripts -->
<script src="<?php echo base_url('assets/metronic/vendors/base/vendors.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/metronic/demo/default/base/scripts.bundle.js'); ?>" type="text/javascript"></script>
<!--end::Base Scripts -->
<script>
    $(".m_selectpicker").selectpicker();
</script>
<!-- For Grocery CRUD -->
<!-- Alertify -->
<script src="<?php echo base_url('assets/grocery_crud/js/alertify/alertify.min.js') ?>"></script>
<!-- GroceryCRUD JS -->
<?php if (isset($js_files)) { foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; } else { ?>
<!-- <script src="<?php //echo base_url('assets/additional/js/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>              -->
<?php } ?>       
<!--JS Plugins-->
<?php if (isset($js_plugins)): ?>
    <?php foreach ($js_plugins as $url_plugin): ?>
        <script src="<?php echo base_url($url_plugin) ?>"></script>                
    <?php endforeach ?>
<?php endif ?>

<script>
    site         = '<?php echo site_url(); ?>';
    ur_class     = '<?php echo $this->uri->segment(1); ?>';
    url_function = '<?php echo $this->uri->segment(2); ?>';
    <?php echo isset($script) ? $script : '' ?>
    function datatablesOptions() { var option = { "orderClasses": false, <?php echo isset($data['script_datatables']) ? $data['script_datatables'] : ''  ?> }; return option; }
    function afterDatatables() { <?php echo isset($data['script_grocery']) ? $data['script_grocery']: '' ?> }
</script>
<script src="<?php echo base_url('assets/additional/js/list.min.js') ?>"></script>
<?php echo isset($scriptView) ? $scriptView : ''; ?>
<!--Custom JS-->
<script src="<?php echo base_url('assets/additional/js/a-design.js') ?>"></script>
<?php if (isset($filejs)) {  ?>
<script src="<?php echo base_url('assets/additional/js/custom') . '/'. $filejs ?>"></script>
<?php } ?>

<script>
$(document).ready(function() {
    <?php if (isset($addbtn)) { foreach ($addbtn as $btn) { ?> 
    $(".tDiv2").prepend('<a href="<?php echo base_url($btn['url']); ?>" class="btn btn-danger"><i class="fa fa-list"></i> <?php echo $btn['title']; ?></a>');
    <?php } } ?>
    <?php if (isset($urlback)) {?>                
    $('.tDiv2').prepend('<a class="btn btn-warning" href="<?php echo base_url($urlback); ?>"><i class="fa fa-angle-left"></i> Back</a>');
    <?php } ?>
    <?php if (isset($righturl)) {?> 
    $(".tDiv3 .btn-group").prepend('<a href="<?php echo base_url($righturl); ?>" class="btn btn-danger" style="margin-right:5px;"><i class="fa fa-clipboard"></i> Daily Report</a>');
    <?php } ?>
});
</script>

<!-- begin::Page Loader -->
<script>
    $(window).on('load', function() {
        $('body').removeClass('m-page--loading');
    });
</script>
<!-- end::Page Loader -->
</body>
<!-- end::Body -->
</html>