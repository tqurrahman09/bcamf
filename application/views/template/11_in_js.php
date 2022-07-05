<!-- begin::Page Resources -->
<?php
foreach ($this->js_sources as $value) {
	$this->load->view($this->module.'/'.$value);
}
// <!-- begin::Page Resources -->