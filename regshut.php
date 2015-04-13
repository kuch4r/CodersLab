<?php
$time = time();

function shutdown () {
	global $time;
	
	echo "Bye Bye";
	echo (time() - $time);
	
}

register_shutdown_function('shutdown');