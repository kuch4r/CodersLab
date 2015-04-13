<?php

class WrongPasswordException extends Exception {}
class LengthPasswordException extends WrongPasswordException {}
class UpperCasePasswordException extends WrongPasswordException {}
class LowerCasePasswordException extends WrongPasswordException {}

function checkPassword( $pass ) {
	$pass = trim($pass);
	$len  = strlen($pass);
	if( $len < 0 ) {
		throw new Exception('strlen < 0');
	}
	if( $len < 10 || $len > 15) {
		throw new LengthPasswordException();
		//throw new WrongPasswordException('Password too short or too long: '.$pass, 1001);
	}
	if( !preg_match('/[A-Z]/', $pass)) {
		throw new UpperCasePasswordException();
	}
	if( !preg_match('/[a-z]/', $pass)) {
		throw new LowerCasePasswordException();
	}
}


try {
	checkPassword( 'ala');
	echo "password is ok";
} catch( WrongPasswordException $e ) {
	echo "wrong password";
	if( is_a($e, 'LengthPasswordException') ) {
		echo "Password too short or too long";
	}
}


