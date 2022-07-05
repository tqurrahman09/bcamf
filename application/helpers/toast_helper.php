<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('toast'))
{
	function toast($type, $message)
	{
		$toast = '';
		if ($type == 'error')
		{
			$toast .= '<script type="text/javascript">';
			$toast .= 'Command: toastr["error"]("'.$message.'");';
			$toast .= '</script>';
		}
		elseif ($type == 'warning')
		{
			$toast .= '<script type="text/javascript">';
			$toast .= 'Command: toastr["warning"]("'.$message.'");';
			$toast .= '</script>';
		}
		elseif ($type == 'info')
		{
			$toast .= '<script type="text/javascript">';
			$toast .= 'Command: toastr["info"]("'.$message.'");';
			$toast .= '</script>';
		}
		elseif ($type == 'success')
		{
			$toast .= '<script type="text/javascript">';
			$toast .= 'Command: toastr["success"]("'.$message.'");';
			$toast .= '</script>';
		}
		return $toast;
	}
}