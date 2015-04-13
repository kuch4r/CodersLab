<?php 
$error = false;
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	try {
		if( !filter_intput( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ) {
			throw new Exception( "Nieprawidlowy adres email");
		}
		$name = filter_intput( INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		if( empty($name) || strlen($name) < 6 ) {
			throw new Exception( "Nieprawidlowe imie i nazwisko");
		}
		$text = filter_intput( INPUT_POST, 'text', FILTER_SANITIZE_STRING);
		if( empty($text) || strlen($text) < 6 ) {
			throw new Exception( "Nieprawidlowe tresc");
		}
		$to = "Coders Lab Mailer <mailer@coderslab.pl>";
		$from   = 'From: '.$_POST['name'].' <'.$_POST['email'].'>';
		
		if( !mail( $to, 'Contact', $text, $from ) ) {
			throw new Exception('Nie mozna wyslac maila, napisz na adres: '.$to);
		}
	} catch( Exception $e ) {
		$error = $e->getMessage();
	}
}
?>
<html><body>
<?php if( !empty($error) ) { ?>
	<div>Wystapil blad: <?php echo $error; ?>
<?php } ?>
 
<form action="post">
	Name: <input type="text" name="name"/><br/>
	Email:<input type="text" name="email"/><br/>
<textarea name="text">
	</textarea><br/>
<input type="submit" value="Wyslij"/>
</form>
</body><html>
