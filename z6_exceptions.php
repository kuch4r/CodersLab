<?php

class NoUserFileException extends Exception { public function __toString() { return 'No user file exception'; } };
class FileUploadException extends Exception {};
class BadMimeTypeException extends Exception {};

function savefile( $name ) {
	if( !isset($_FILES[$name]) ) {
		throw new NoUserFileException('No userfile');
	}

	if( $_FILES[$name]['error'] != 0 ) {
		throw new FileUploadException('File upload error');
	}

	if( !in_array( $_FILES[$name]['type'], array('image/gif','image/png'))) {
		throw new BadMimeTypeException('Mime type error');
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
		throw new Exception();
	}
	return $uploadfile;
}

class UnableToSelectAvatarException extends Exception {
	public $filename;
};

try {
	$user = get_user();
	try {
		$file = savefile( 'userfile');
		$user->avatar = $file;
		echo "OK";
	} catch( NoUserFileException $e ) {
		$user->avatar = '/var/www/uploads/default.png';
	} catch( FileUploadException $e ) {
		error_log('File upload file error');
		throw new UnableToSelectAvatarException('',0,$e);
	} catch( BadMimeTypeException $e ) {
		error_log('Mime type error');
		throw new UnableToSelectAvatarException('',0,$e);
	}
	save_user( $user );
} catch ( UnableToSelectAvatarException $e) {
	echo "Please select avatar";
} catch ( Exception $e) {
	echo "Sorry, something went wrong.";
}



