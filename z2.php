include "z1.php"

class UserSet implements Itertor {
	protected $users = array();
	protected $pos   = 0;  // wskaznik położenia
	
	public function add( User $user ) {
		$this->users[] = $user;
	}
	
	/* funkcje interfejsu Itertor */
	public mixed current ( void ) {
		return $this->users[$this->pos]; 
	}
	public scalar key ( void ) {
		return $this->pos;
	}
	public void next ( void ) {
		$this->pos++;
	}
	public void rewind ( void ) {
		$this->pos = 0;
	}
	public boolean valid ( void ) {
		return isset($this->users[$this->pos]);
	}
}

function checkLogin( UserSet $set, $username, $password ) {
	$result = array();
	foreach( $set as $user ) {
		if( $user->login($username,$password) ) {
			$result[] = $user;
		}
	}
	return $result;
}