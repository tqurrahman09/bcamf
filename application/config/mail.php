<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/////////////////////////////////
// Config mail                 //
// Author: Dede Juniawan Suri  //
/////////////////////////////////

/**
 * Mail protocol
 * Const type: string
 */
$config['protocol'] = 'smtp';
/**
 * SMTP host
 * Const type: string
 */
$config['smtp_host'] = 'mail.smtp2go.com';
/**
 * SMTP port
 * Const type: integer
 */
$config['smtp_host'] = 465;
/**
 * SMTP user
 * Const type: string
 */
$config['smtp_user'] = 'noreply@malindofeedmill.co.id';
/**
 * SMTP password
 * Const type: string
 */
$config['smtp_pass'] = 'M3pqOHl5cjZyb3Yw';
/**
 * SMTP crypto
 * Const can be 'ssl' or 'tls'
 */
$config['smtp_crypto'] = 'ssl';
/**
 * Mail content type
 * Const type: string
 */
$config['mail_type'] = 'html';
/**
 * Mail timeout in seconds
 * Const type: integer
 */
$config['smtp_timeout'] = 60;
/**
 * Mail charset
 * Const type: string
 */
$config['charset'] = 'utf-8';
