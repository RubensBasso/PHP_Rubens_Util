<?php
class manipulateCVS {
	
	function readCVSMappingAndQuery($file) {
		echo "<p>Function to read a CVS and include the data in a generic table<p>";			
		$row = 1;
		$length	= 0;
		$delimiter = ',';
		$enclosure = '"';
		$table = array();
			
		//Verify if the file exists and open the file
		if(file_exists($file)) {
			echo "File ".$file." found! <br/>";
			$handle = fopen ($file,"r");
		}
		else{
			echo "File not found<br/>";
		}
			
		// Verify if was able to open the file with success
		if ($handle) {
			//Get the first row of the file and define as header
			$header = fgetcsv($handle, $length, $delimiter, $enclosure);
			//Read while find data in the row
			//while (!feof($handle))       Another option to make a loop in the file
			while (($data = fgetcsv($handle, $length, $delimiter, $enclosure)) !== FALSE) {
				$num = count ($data);
				echo "<br/> $num fields in the line $row: ";
				$row++;
				for ($c=0; $c < $num; $c++) {
					echo $data[$c] . " - ";
				}
					
				$record = array_combine($header,$data);
				$table[] = "('$record[CustomerID]','$record[CustomerName]','$record[CustomerAddress]',
				'$record[CustomerCity]','$record[CustomerState]','$record[CustomerZipCode]','$record[CustomerPhone]')";
			}
			$qry = "INSERT INTO tmpGenericTable (CustomerID,CustomerName,CustomerAddress,CustomerCity,CustomerState,
					CustomerZipCode,CustomerPhone) VALUES ".implode(", ", $table);
				
			fclose ($handle);
				
			$this->saveGenericData($qry);
		}else{
			echo "<br>Problem to open the file<p>";
		}
	}

	function saveGenericData($qry) {
		
		$conexao = new mysqli("localhost","root","root", "Rubens_Test");
		
		if ($conexao->connect_error) {
			throw new Exception('mysqli Error: '.$conexao->connect_error.' ('.$conexao->connect_errno.')');
		} else {
			echo "<br><br>Conection open";
			$conexao->query($qry);
			echo "<br>CVS reading finished & Data Saved";
		}
	}			
}
	

?>
