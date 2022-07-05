<?php
/**
 * HTML head (mandatory)
 */
$this->load->view('grocery_template/01_head', $title);
/**
 * Begin page (mandatory)
 */
$this->load->view('grocery_template/02_begin');
/**
 * Header or top navigation (mandatory)
 */
$this->load->view('grocery_template/03_header');
/**
 * Begin content (mandatory)
 */
$this->load->view('grocery_template/041_begin_content');
/**
 * Left nav (mandatory): set authority here
 */
$this->load->view('grocery_template/042_left_nav', $authority_view);
/**
 * Content here (mandatory)
 */
$this->load->view('grocery/grocery', $output, $title, $breadcrumb, $info);
/**
 * End content (mandatory)
 */
$this->load->view('grocery_template/044_end_content');
/**
 * Footer (mandatory)
 */
$this->load->view('grocery_template/05_footer');
/**
 * End page (mandatory)
 */
$this->load->view('grocery_template/06_end');
/**
 * Quick sidebar (optional): set authority here
 */
// $this->load->view('grocery_template/07_quick_sidebar');
/**
 * Scroll top (optional)
 */
$this->load->view('grocery_template/08_scroll_top');
/**
 * Quick navigation (optional): set authority here
 */
// $this->load->view('grocery_template/09_quick_nav');
/**
 * HTML end (mandatory): set js file here
 */
$this->load->view('grocery_template/10_foot');