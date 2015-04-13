<?php

class ValidateException extends Exception {
	public $field;
	public $reason;
	
	public function __construct( $field, $reason ) {
		$this->field  = $field;
		$this->reason = $reason;
		parent::__construct();
	}
}

function checkPassword( $pass ) {
	$pass = trim($pass);
	$len  = strlen($pass);
	
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

function checkPasswordCallback( $pass) {
	try {
		checkPassword( $pass);
	} catch( Exception $e) {
		return false;
	}
	return true;
}

function signup() {
	$username = filter_input( INPUT_POST, 'username', FILTER_VALIDATE_REGEXP, array('regexp' => '/^[A-Z]/'));
	if( !$username ){
		throw new ValidateException('username', 'No capital letter');
	}
	$email = filter_intput( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	if( !$email ) {
		throw new ValidateException('email', 'Wrong email');
	}
	$passowrd = filter_intput( INPUT_POST, 'password', FILTER_CALLBACK, array('options' => 'checkPasswordCallback'));
	if( !$password ) {
		throw new ValidateException('password', 'Wrong password');
	}
	$username = filter_var( $username, FILTER_SANITIZE_STRING);
	
	//register( $username, $email, $passowrd );
}

if( $_SERVER['REQUEST_METHOD'] == 'POST') {
	try {
		signup();
	} catch( ValidateException $e ) {
		echo 'Blad w polu "'.$e->field.'" : '.$e->reason;
	}
}



