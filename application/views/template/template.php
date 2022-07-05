<?php
/**
 * HTML head (mandatory)
 */
$this->load->view('template/01_head');
/**
 * Begin page (mandatory)
 */
$this->load->view('template/02_begin');
/**
 * Header or top navigation (mandatory)
 */
$this->load->view('template/03_header');
/**
 * Begin content (mandatory)
 */
$this->load->view('template/041_begin_content');
/**
 * Left nav (mandatory): set authority here
 */
$this->load->view('template/042_left_nav');
/**
 * Content here (mandatory)
 */
$this->load->view($this->module.'/'.$this->content, $data);
/**
 * Form component
 */
foreach ($this->form_sources as $value) {
	$this->load->view($this->module.'/'.$value, $data);
}
/**
 * End content (mandatory)
 */
$this->load->view('template/044_end_content');
/**
 * Footer (mandatory)
 */
$this->load->view('template/05_footer');
/**
 * End page (mandatory)
 */
$this->load->view('template/06_end');
/**
 * Quick sidebar (optional): set authority here
 */
// $this->load->view('template/07_quick_sidebar');
/**
 * Scroll top (optional)
 */
$this->load->view('template/08_scroll_top');
/**
 * Quick navigation (optional): set authority here
 */
// $this->load->view('template/09_quick_nav');
/**
 * Initial js file (mandatory): fileset js file here
 */
$this->load->view('template/10_initjs');
/**
 * internal js (optional)
 */
if ($this->in_js) {
	$this->load->view('template/11_in_js');
}
/**
 * external js (optional)
 */
if ($this->ex_js) {
	$this->load->view('template/12_ex_js');
}
/**
 * HTML end (mandatory)
 */
$this->load->view('template/13_foot');