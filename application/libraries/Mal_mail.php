<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

////////////////////////////////
// Malindo mail               //
// Author: Dede Juniawan Suri //
////////////////////////////////

class Mal_mail{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
		$this->CI->load->config('mail', FALSE, TRUE);	
	}
	/**
	 * [send_mail description]
	 * @param  [string] $to      [description]
	 * @param  [string] $subject [description]
	 * @param  [html] $content [description]
	 * @return [boolean]          [description]
	 */
	public function send_mail($to, $subject, $content){
		$config = array(
		    'protocol'  => $this->CI->config->item('smtp'),
		    'smtp_host' => $this->CI->config->item('smtp_host'),
		    'smtp_port' => $this->CI->config->item('smtp_port'),
		    'smtp_user' => $this->CI->config->item('smtp_user'),
		    'smtp_pass' => $this->CI->config->item('smtp_pass'),
		    'smtp_crypto' => $this->CI->config->item('smtp_crypto'),
		    'mailtype'  => $this->CI->config->item('mail_type'),
		    'smtp_timeout' => $this->CI->config->item('smtp_timeout'),
		    'charset'   => $this->CI->config->item('charset'),
		    'newline' => "\r\n"
		);

		//Load email library
		$this->CI->load->library('email', $config);

		$this->CI->email->to($to);
		$this->CI->email->from($this->CI->config->item('smtp_user'), 'No-reply');
		$this->CI->email->subject($subject);
		$this->CI->email->message($content);

		if ($this->CI->email->send()) {
			return true;
		} else {
			return false;
		}
	}
}