<?php
class manipulateCVS {
	function readCVSMappingAndQuery($file) {
		echo "<p>Function to read a CVS<p>";			
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
					echo "<br/> $num campos na linha $row: ";
					$row++;
					for ($c=0; $c < $num; $c++) {
						echo $data[$c] . " - ";
					}
					
					echo "<p>";
					
					$record = array_combine($header,$data);
					//print_r($record);
					$table[] = "('$record[CustomerID]','$record[CustomerName]','$record[CustomerAddress]
					','$record[CustomerCity]','$record[CustomerState]','$record[CustomerZipCode]','$record[CustomerPhone1]
					','$record[CustomerPhone2]','$record[CustomerEmail]','$record[CustomerDateAdded]','$record[CustomerSource]
					','$record[CustomerStatus]','$record[CustomerCancelDate]','$record[CustomerCancelReason]','$record[Salesman]
					','$record[Frequency]','$record[ServiceType]','$record[Price]','$record[AutoPay]
					','$record[AgreementLength]','$record[PreferredTech]','$record[LastService]','$record[InitialService]
					','$record[NextService]','$record[Balance]','$record[CCToken]','$record[BillingAddress]
					','$record[BillingCity]','$record[BillingState]','$record[BillingZipCode]')";
					echo "<p>";
					//print_r($table);
					echo "<p>";
				}
				$qry = "INSERT INTO tmpGenericImport (CustomerID,CustomerName,CustomerAddress,CustomerCity,CustomerState,
						CustomerZipCode,CustomerPhone1,CustomerPhone2,CustomerEmail,CustomerDateAdded,CustomerSource,CustomerStatus,
						CustomerCancelDate,CustomerCancelReason,Salesman,Frequency,ServiceType,Price,AutoPay,AgreementLength,
						PreferredTech,LastService,InitialService,NextService,Balance,CCToken,BillingAddress,BillingCity,
						BillingState,BillingZipCode) VALUES ".implode(", ", $table);
				
				echo $qry;
				echo "<p>";
				fclose ($handle);
				echo "<p>CVS reading finished<p>";
			}
			else{
				echo "Problem to open the file<p>";
			}
		}
		
		
	}
?>
