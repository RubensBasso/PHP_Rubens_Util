<?php
//This is an example of how you can caught things like Uncaught exception
//You should include this in every page, it will define the function that will run as last step of your php code
include_once 'errorHandler.php';


//Here I am forcing this error run the Error_Handler function
throw new Exception("Uncaught exception");

?>