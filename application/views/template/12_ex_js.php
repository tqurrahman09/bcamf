<!-- begin::Page Resources -->
<?php
foreach ($this->js_sources as $value) {
	echo "<script src=".base_url('assets/malindo/app/js/'.$this->module.'/'.$value)." type=\"text/javascript\"></script>";
}
// <!-- begin::Page Resources -->