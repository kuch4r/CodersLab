class Matrix {
	protected $vals = array();
	
	public function add( $x, $y, $val ) {
		if( $this->hasPoint($x,$y) ) {
			return false;
		}
		if( !isset($this->vals[$x])) {
			$this->vals[$x] = array();
		}
		/* zapisujemy wartość */
		$this->vals[$x][$y] = $val;
		return true;
	}
	
	public function count() {
		$cnt = 0;
		forech( $this->vals as $valsx ) {
			foreach( $valsx as $val ) {
				$cnt++;
			}
		}
		return $cnt;
	}
	
	public function count2() {
		$cnt = 0;
		forech( $this->vals as $valsx ) {
			$cnt += count($valsx);
		}
		return $cnt;
	}
	
	public function hasPoint( $x, $y ) {
		if( !isset($this->vals[$x] ) ) {
			return false;
		}
		if( !isset($this->vals[$x][$y[ ) ) {
			return false;
		}
	}
}