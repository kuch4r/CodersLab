abstract class User {
	protected $username = '';
	protected $password = '';
	
	abstract protected function checkLogin( $password )
	abstract protected function setPassword( $password )
	
	public function login( $username, $password ) {
		if( $username != $this->username ) {
			return false;
		}
		return $this->checkLogin( $password);
	}
	
}

/* klasa Admin, ktora dziedziczy po abastrakcyjnej klasie User */
class Admin extends User {
	protected $ip = '127.0.0.1';
	
	protected function checkLogin( $password ) {
		// sprawdzamy czy adres logowania jest odpowiedni
		if( $_SERVER['REMOTE_ADDR'] != $this->ip ) {
			return false;
		}
		// sprawdzamy czy zgadza sie haslo
		if( $this->password != $passowrd ) {
			return false;
		}
		return true;
	}
	
	protected function setPassword( $password ) {
		if( strlen($password) < 10 ) {
			return false;
		}
		$this->password = $password;
		return true;
	}
}

/* klasa Client, ktora dziedziczy po abastrakcyjnej klasie User */
class Client extends User {
	protected $failedLoginCount = 0; 
	
	protected function checkLogin( $password ) {
		// jezeli byly wiecej niz 3 zle logowania nie pozwalamy sie logowac
		if( $this->failedLoginCount > 3 ) {
			return false;
		}
		// sprawdzamy czy zgadza sie haslo
		if( $this->password != $passowrd ) {
			$this->failedLoginCount++; // zwiekszamy licznik nieudanych logowan
			return false;
		}
		return true;
	}
	
	protected function setPassword( $password ) {
		if( strlen($password) < 8 ) {
			return false;
		}
		// wymagamy aby byla przynajmniej jedna wielka litera
		if( strtolower( $password) == $password ) { // preg_match( '/[A-Z]/,$password )
			return false;
		}
		$this->password = $password;
		return true;
	}
}