<!-- begin::Page Loader -->
<script>
	$(".m_selectpicker").selectpicker();
	$(window).on('load', function() {
		$('body').removeClass('m-page--loading');
	});
</script>
<!-- end::Page Loader -->

<?php
  $info = $this->session->userdata('info');
  if(!empty($info)){
    echo $info;
  }     
?>

</body>
<!-- end::Body -->
</html>