$email = 'imie.nazwisko@firma.com.pl';

list( $name, $domain ) = explode('@',$email,2);
list( $imie, $nazwisko ) = explode( '.', $name, 2 );

$company = strstr( $domain, '.', true );

echo ucfirst( $imie).' '.ucfirst($nazwisko);
echo strtoupper($company).' '.ucfirst($imie[0]).'. '.ucfirst($nazwisko);
echo ucfirst($imie[0]).'. '.ucfirst($nazwisko[0]).'.';