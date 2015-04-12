function read_date( $date ) {
	$result = preg_match( '/\b(?P<day>\d\d?)\s+(?P<month>styczen|luty|marzec|kwiecien|maj|czerwiec|lipiec|sierpien|wrzesien|pazdziernik|listopad|grudzien)\s+(?P<year>\d{4})\b/', $date, $matches);
	if( !$result ) {
		return false;
	}
	//var_dump($matches);
	//array(7) { [0]=> string(13) "5 marzec 2015" ["day"]=> string(1) "5" [1]=> string(1) "5" ["month"]=> string(6) "marzec" [2]=> string(6) "marzec" ["year"]=> string(4) "2015" [3]=> string(4) "2015" } 
	
	$day = intval($matches['day']);
	if( $day < 1 || $day > 31 ) {
		return false;
	}
	/* dalsza walidacja daty */
	return $matches;
}

function check_mail( $mail ) {
	return preg_match( '/^\w+\.\w+@\w+\.\w{3}\.\w{2}$/', $mail ) != 0;
}
