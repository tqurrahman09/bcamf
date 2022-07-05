<?php
defined('BASEPATH') OR exit('No direct script access allowed');

////////////////////////////////
// Config for log library     //
// Author: Dede Juniawan Suri //
////////////////////////////////

/**
 * If use this library must be add fields: insert_date, modify_date, insert_by, and modify_by in every table. see structure bellow
 * `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, // insert by sistem
 * `modify_date` timestamp NULL DEFAULT NULL, // insert by sistem
 * `insert_by` int(11) NOT NULL, // session data
 * `modify_by` int(11) DEFAULT NULL // session data
 */

/**
 * Log table name update data
 */
$config['log_update_name'] = '_log_update';

/**
 * Log table name delete data
 */
$config['log_delete_name'] = '_log_delete';