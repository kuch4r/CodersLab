<?php

$uploaddir = '/var/www/uploads';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( !isset($_FILES['userfile']) ) {
		echo "error";
		die();
	}
	
	if( $_FILES['userfile']['error'] != 0 ) {
		echo "error";
		die();
	}
	
	if( !in_array( $_FILES['userfile']['type'], array('image/gif','image/png'))) {
		echo "not image";
		die();
	}
	// <input type="file" name="userfile"/>
	// <input type="file" name="avatar"/>
	
	$uploadfile = basename($_FILES['userfile']['name']);
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
	
	if( !move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile) ) {
	  echo "ERROR";
	} else { 
	  echo "OK";
	}

}

// /display.php?date=20150408&file=obrazek.png

$date = $_GET['date'];
$file = $_GET['file'];

if( !preg_match( '/^\d+$/', $date) ) {
	echo 'ERROR';
	die();
}
$file = basename($file);
$hash = md5($file);

$filename = $uploaddir.'/'.$date.'/'.substr($hash,0,2).'/'.substr($hash,-2).'/'.$file;
if( !file_exists($filename)) {
	echo 'ERROR';
	die();
}

header('Content-type: image/gif');

$fp = fopen($filename,'r');
//fpassthru($fp);

while( !feof($fp) ) {
	$data = fread( $fp, 1024);
	echo $data;
}
fclose($fp);
////
$file = file_get_contents($filename);
echo $file;






