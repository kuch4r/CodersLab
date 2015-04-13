<?php

define('DEBUG',true);

function error_handler($errno, $errstr, $errfile, $errline) {
	$message  = 'Error: '.$errno.' ('.$errstr.')'."\n";
	$message .='File: '.$errfile.' ('.$errline.')'."\n";
	if( defined('DEBUG') && constant('DEBUG')) {
		 echo $message;
		 echo '<pre>';
		 debug_print_backtrace();
		 echo '</pre>';
	}
	$fp = fopen('log.txt','a');
	fwrite( $fp, 'Error at '.date('Y-m-d H:i:s')."\n");
	fwrite( $fp, $message );
	fclose($fp);
	
	//header('Redirect: error.html');
	
	if( $errno == E_USER_ERROR &&  !defined('DEBUG') || constant('DEBUG')) {
		echo file_get_contents('error.html');
	}
}

set_error_handler('error_handler');

function savefile( $name ) {
	if( $_SERVER['REQUEST_METHOD'] != 'POST'){
		trigger_error('wrong request mehtod', E_USER_WARNING);
		return false;
	}
	if( !isset($_FILES[$name]) ) {
		trigger_error('file not uploaded', E_USER_WARNING);
		return false;
	}

	if( $_FILES[$name]['error'] != 0 ) {
		trigger_error('file upload error', E_USER_ERROR);
	}

	if( !in_array( $_FILES[$name]['type'], array('image/gif','image/png'))) {
		trigger_error('wrong mime type', E_USER_WARNING);
	}
	// <input type="file" name="userfile"/>
	// <input type="file" name="avatar"/>

	$uploadfile = basename($_FILES[$name]['name']);
	//$uploadfile = date('dmY').'_'.$id.substr($_FILES['userfile']['name'],-4);
	$hash = md5($uploadfile);

	$uploaddir .= '/'.date('Ymd');
	if( !file_exists($uploaddir) ) {
		mkdir($uploaddir);
	}
	$uploaddir .= '/'.substr( $hash, 0 ,2 );
	if( !file_exists($uploaddir) ) {
		mkdir($uploaddir);
	}
	$uploaddir .= '/'.substr( $hash, -2 );
	if( !file_exists($uploaddir) ) {
		mkdir($uploaddir);
	}

	$uploadfile = $uploaddir .'/'.$uploadfile;
	// /var/www/uploads/20150408/af/8e/obrazek.png

	if( !move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile) ) {
		trigger_error('file upload error', E_USER_ERROR);
	}
	return $uploadfile;
}



$file = savefile( 'userfile');

