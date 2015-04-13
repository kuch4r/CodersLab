 
 <?php
 
 $url = 'https://dl.dropboxusercontent.com/u/19244701/coderlab_z13.json';
 
 $data = file_get_contents($url);
 $objs = json_decode($data, true);
 
 foreach( $objs as $obj ) {
	 echo 'Imię i nazwisko: '.$obj['name']['first'].' '.$obj['name']['last'].'<br/>';
	 echo 'Przyjaciele ('.count($obj['friends']).'): <ul>';
	 foreach( $obj['friends'] as $f ) {
		 echo '<li>'.$f['name'].'</li>';
	 }
	 echo '</ul>';
 }
 
 $objs = json_decode($data, false);
 
 foreach( $objs as $obj ) {
	 echo 'Imię i nazwisko: '.$obj->name->first.' '.$obj->name->last.'<br/>';
	 echo 'Przyjaciele ('.count($obj->friends).'): <ul>';
	 foreach( $obj->friends as $f ) {
		 echo '<li>'.$f->name.'</li>';
	 }
	 echo '</ul>';
 }