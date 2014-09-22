<?php
	include_once 'manipulateCVS.php';
			
	//Manipulate Excel/CVS
	ini_set("auto_detect_line_endings", TRUE); //Detect the end of the file to avoid issues in MAC OS
	$excelFile = new manipulateCVS();
	//$excelFile->readCVS("teste.cvs");
	//$excelFile->readCVSMapping("teste.cvs");
	$excelFile->readCVSMappingAndQuery("ImportFilev01.csv");
	ini_set('auto_detect_line_endings',FALSE);
	
?>