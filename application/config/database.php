<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*

*/
$active_group = 'default';
$query_builder = TRUE;
if(in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ){
	$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'pluto_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci', 
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
}else{
	$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'webprojectmockup_nylandlords',
	'password' => 'geeks&bachelors',
	'database' => 'webprojectmockup_nylandlords',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
}