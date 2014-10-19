<?php
register_shutdown_function( "error_handler" );
//It defines the function that your app will go thru before finalize the php code, it will happens for every request, so be careful


function error_handler() {
	
	$error = error_get_last();

	if( $error !== NULL) {
		$errType   = $error["type"];
		$errfile = $error["file"];
		$errline = $error["line"];
		$errstr  = $error["message"];
		
		//In the array you can define which type of error you want to log, in the website below you can find the reference
		//http://php.net/manual/en/errorfunc.constants.php
		if (in_array($errType, array(1, 16))) {
			//This is just an example, you should take the message bellow and log in a table
			echo "<p>Date- ".date("Y-m-d H:i:s").
			",Fatal Error Handler: Type-".$errType.
			", Message-".$errstr.
			", File-".$errfile.
			", Line-".$errline;
		}
	}
}

?>
