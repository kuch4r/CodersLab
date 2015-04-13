<?php
 
 $url = 'https://dl.dropboxusercontent.com/u/19244701/coderlab_z13.json';
 
 $data = file_get_contents($url);
 $objs = json_decode($data, true);
 
 $tags = array();
 
 foreach( $objs as $obj ) {
	 foreach( $obj['tags'] as $tag ) {
		 if( !isset($tags[$tag])) {
			 $tags[$tag] = 1;
		 } else {
			 $tags[$tag]++;
		 }
	 }
 }
 
 echo '<pre>'.json_encode($tags,JSON_PRETTY_PRINT).'</pre>';
