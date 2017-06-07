<?php
	session_start();	 			
	if  (!(isset($_SESSION['Username'])) | !(isset($_SESSION['Password']) | trim($_SESSION['Username']) == "" | trim($_SESSION['Password']) == "")) {			
    	header('Location: index.php');
		exit;
	}
	$Msg = "";	
	include_once("db_connect.php");	
	
	function StrippedChars($strWords) {
		
		$badChars = array('/select/i', '/drop/i', '/;/i', '/--/i', '/insert/i', '/delete/i', '/xp_/i','/SELECT/i', '/DROP/i', '/INSERT/i', '/DELETE/i', '/XP_/i', '/Xp_/i', '/xP_/i','/sELECT/i', '/dROP/i', '/iNSERT/i', '/dELETE/i','/seLECT/i', '/drOP/i', '/inSERT/i', '/deLETE/i','/selECT/i', '/droP/i', '/insERT/i', '/delETE/i','/seleCT/i','/inseRT/i', '/deleTE/i','/selecT/i','/inserT/i', '/deletE/i', '/dOPp/i', '/DroP/i', '/DrOp/i', '/dRoP/i'); 
		$replaceChars = array('','','','','','',''); 
		
		if (trim($strWords) == "") {  
			$newChars = $strWords;
		}
		else {
			$newChars = preg_replace($badChars,$replaceChars,$strWords);
		}
		return $newChars; 

	}	
	
	Function check_date($inputbox) { 	
		$booFound = "False";
		$strSeparatorArray = Array("/");
		$strDate = $inputbox;	
		if (strlen($strDate) !== 10) {				
			return False;
		}
		$intElementNr = 0;
		while ($intElementNr < sizeof($strSeparatorArray)) {
			if (substr_count($strDate, $strSeparatorArray[$intElementNr]) > 0) {
			    $strDateArray = split($strSeparatorArray[$intElementNr],$strDate);		
				if (sizeof($strDateArray) !== 3) {						
					return False;	
				}	
				$intDay = $strDateArray[0];
				$intMonth = $strDateArray[1];
				$intYear = $strDateArray[2];
				$booFound = "True";
			}
			$intElementNr = $intElementNr + 1;
		}	

		if ($booFound == "FALSE") {				
			return False;
		}

		if (strlen($intYear) !== 4) {				
			return False;
		}	

		if (ereg('[\D]+',$intYear)) {				
			return False;
		}

		if (strlen($intYear) == 2) {
			$intYear = "2000" . (int) $intYear;		
		}		

		if (ereg('[\D]+',$intDay)) {				
			return False;
		}

		if (ereg('[\D]+',$intMonth)) {				
			return False;
		}			

		if ((int) $intMonth > 12 | (int) $intMonth < 1) {			
			return False;
		}

		if (((int) $intMonth == 1 | (int) $intMonth == 3 | (int) $intMonth == 5 | (int) $intMonth == 7 | (int) $intMonth == 8 | (int) $intMonth == 10 | (int) $intMonth == 12 )& ((int) $intDay > 31 | (int) $intDay < 1)) {
			return False;
		}

		if (((int) $intMonth == 4 | (int) $intMonth == 6 | (int) $intMonth == 9 | (int) $intMonth == 11) & ((int) $intDay > 30 | (int) $intDay < 1)) {				
			return False;
		}
		if ((int) $intMonth == 2) {
			if ((int) $intDay < 1) {
				return False;
			}
			if (Leap_Year($intYear)) {
				if ((int) $intDay > 29) {
					return False;
				}
			}
			else {
				if ((int) $intDay > 28) {	
					return False;
				}
			}
		}
		return True;
	}
	
	Function Leap_Year($intYear) { 
		if ((int) $intYear % 100 == 0) {
			if ((int) $intYear % 400 == 0) {
			 	return True;
			}
			return False;
		}
		else { 
			if ((int) $intYear % 4 == 0) {
			 	return True;
			}
			return False;
		}
	}
	
	if (empty($Msg)) {			
		$Num_Rec_Per_Page = 50;		
		if (isset($_GET["Page"])) { $Page  = $_GET["Page"]; } else { $Page = 1; }; 
		$Start_From = ($Page - 1) * $Num_Rec_Per_Page;		
		if (isset($_POST["Submit"])) {	
			if (trim($_POST["Submit"]) == "Export Entrants CSV") {				
				$Time1 = "00:00:00";
				$Time2 = "24:00:00";
				$From_Date = Substr(trim($_POST['From_Date']),0,10);
				$To_Date = Substr(trim($_POST['To_Date']),0,10);
				$Saved_From_Date = $From_Date;	
				$Saved_To_Date = $To_Date;			
				$header = "Id" . ",";			  	
				$header = $header . "Submission date" . ",";
				$header = $header . "Name" . ",";		
			  	$header = $header . "Company name" . ",";											
			  	$header = $header . "Email" . ",";				
				$header = $header . "Telephone" . ",";			  	
			  	$dataline = "";	
				
				if (trim($From_Date) == "" & trim($To_Date) == "") {							
			  		$SQLStat = "SELECT * FROM Entrants ORDER BY Id DESC";
				}				
				else {
					if (trim($From_Date) !== "" & trim($To_Date) == "") {				
			  			if (check_date(trim($From_Date))) {	
							$The_Date_Parts = explode("/", $From_Date);
							$From_Date = $The_Date_Parts[2] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[0];
							$From_Date = $From_Date . " " . $Time1;							
							$SQLStat = "SELECT * FROM Entrants where Date_Of_Entry >= '" . $From_Date .  "' ORDER BY Id DESC";						
						}
						else {							
							$Msg = "The From Date is invalid - it should be in the format dd/mm/yyyy";
						}
					}
					else {
						if (trim($From_Date) == "" & trim($To_Date) !== "") {				
			  				if (check_date(trim($To_Date))) {								
								$The_Date_Parts = explode("/", $To_Date);
								$To_Date = $The_Date_Parts[2] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[0];
								$To_Date = $To_Date . " " . $Time2;								
								$SQLStat = "SELECT * FROM Entrants where Date_Of_Entry <= '" . $To_Date .  "'  ORDER BY Id DESC";
							}
							else {
								$Msg = "The To Date is invalid - it should be in the format dd/mm/yyyy";
							}
						}						
						if (trim($From_Date) !== "" & trim($To_Date) !== "") {				
			  				if (check_date(trim($From_Date))) {
								$The_Date_Parts = explode("/", $From_Date);
								$From_Date = $The_Date_Parts[2] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[0];
								$From_Date = $From_Date . " " . $Time1;
								if (check_date(trim($To_Date))) {
									$The_Date_Parts = explode("/", $To_Date);
									$To_Date = $The_Date_Parts[2] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[0];	
									$To_Date = $To_Date . " " . $Time2;																
									if ($From_Date <= $To_Date) {																				
										$SQLStat = "SELECT * FROM Entrants where Date_Of_Entry >= '" . $From_Date .  "' and Date_Of_Entry <= '" . $To_Date .  "' ORDER BY Id DESC";
									}
									else {										
										$Msg = "The To Date is earlier than the From Date";
									}								
								}
								else {
									$Msg = "The To Date is invalid - it should be in the format dd/mm/yyyy";
								}
							}
							else {
								$Msg = "The From Date is invalid - it should be in the format dd/mm/yyyy";
							}
						}
					}
				}
				if (empty($Msg)) {				
					if (!($result = mysqli_query($connection, $SQLStat))) {
						$Msg = "An error has occured when selecting the records from the Database";
										
						if (!(mysqli_close($connection))) {	
							$Msg =  "An error occured while closing the Database connection";			
						}
					}
					if (!(mysqli_close($connection))) {	
						$Msg =  "An error occured while closing the Database connection";			
					}
					if (empty($Msg)) {
						while ($row = mysqli_fetch_array($result)) {
							$data = "";									
							$Id = trim(stripslashes($row['Id']));
							$Id = str_replace('"', '""', $Id);	
							$Date_Of_Entry = trim(stripslashes($row['Date_Of_Entry']));							
							$Date_Of_Entry = str_replace('"', '""', $Date_Of_Entry);			
							$Date_Parts = explode(" ", $Date_Of_Entry);
							$The_Time = $Date_Parts[1];	
							$The_Date_Parts = explode("-", $Date_Parts[0]);	
							$The_Date = $The_Date_Parts[2] . "/" . $The_Date_Parts[1] . "/" . $The_Date_Parts[0];
							$The_Date_And_Time = $The_Date . " " . $The_Time;
							$Title = trim(stripslashes($row['Title']));
							$Title = str_replace('"', '""', $Title);							
							$Name = trim(stripslashes($row['Name']));
							$Name = str_replace('"', '""', $Name);	
							$Company_Name = StrippedChars(trim(stripslashes($row['Company_Name'])));	
							$Company_Name = str_replace('"', '""', $Company_Name);							
							$Telephone = StrippedChars(trim($row['Telephone']));
							$Telephone = str_replace('"', '""', $Telephone);
							$Email = StrippedChars(trim(stripslashes($row['Email'])));
							$Email = str_replace('"', '""', $Email);
							$Code = StrippedChars(trim(stripslashes($row['Code'])));
							$Code = str_replace('"', '""', $Code);					
							$Please_Contact_Me_With_Offers = StrippedChars(trim(stripslashes($row['Please_Contact_Me_With_Offers'])));  
							$Please_Contact_Me_With_Offers = str_replace('"', '""', $Please_Contact_Me_With_Offers);		
							$ROI_Question = StrippedChars(trim(stripslashes($row['ROI_Question'])));
							$ROI_Question = str_replace('"', '""', $ROI_Question);		
							$data = $data . '"' . utf8_decode($Id)  . '",';	
							$data = $data . '"' . utf8_decode($The_Date_And_Time) . '",';											
							$data = $data . '"' . utf8_decode($Name) . '",';	
							$data = $data . '"' . utf8_decode($Company_Name) . '",';
							$data = $data . '"' . utf8_decode($Telephone) . '",';
							$data = $data . '"' . utf8_decode($Email) . '",';																
							$dataline .= trim($data) . "\n";
						}							
						header("Content-type: text/csv; charset=utf-8");
						header("Content-Encoding: utf-8");
						header("Content-Disposition: attachment; filename=export.csv");
						header("Pragma: no-cache");
						header("Expires: 0");
						echo $header . "\n" . $dataline; 
						exit;
					}	
				}
			}			
		}
		else {			
			$SQLStat = "SELECT * FROM Entrants ORDER BY Id DESC LIMIT " . $Start_From . ", " . $Num_Rec_Per_Page;			
			if (!($result = mysqli_query($connection, $SQLStat))) {
				$Msg = "An error has occured when selecting the records from the Database";
										
				if (!(mysqli_close($connection))) {	
					$Msg =  "An error occured while closing the Database connection";			
				}
			}
			else {
				$SQLStat = "SELECT * FROM Entrants ORDER BY Id DESC"; 				
				if (!($result_total = mysqli_query($connection, $SQLStat))) {
					$Msg = "An error has occured when selecting the records from the Database";											
					if (!(mysqli_close($connection))) {	
						$Msg =  "An error occured while closing the Database connection";			
					}				
				}
				else {
					$Total_Records = mysqli_num_rows($result_total);  
					$Total_Pages = ceil($Total_Records / $Num_Rec_Per_Page); 
					
				}
			}						
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/normalize.css">    
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/class.js" type="text/javascript"></script>

</head>
<body onLoad="tab_class('<?php echo $Winner_Non_Winner; ?>');">
	<header>
		<div class="logo">
			<!-- <img src="" alt=""> -->
		</div>
	</header>

	<div class="max-width">
		<div class="sign-out-link">			
            <a href="logout.php" id="Sign_Out" title="Sign out">Sign out</a>
		</div>
		<section class="date-form-wrapper">
<?php
			if ($Msg <> "") {			
?>									
				<div align="center"><span style="color:#FF0000"><?php echo $Msg ?></span><br><br></div>
<?php
			}				
?>
			<form name="Export" action="tables.php" method="post" style="margin: 0px;">
				<div class="form-group clearfix">
					<label>From date</label>
                    <input type="text" id="From_Date" name="From_Date" size="15" value="<?php echo $Saved_From_Date; ?>" class="datepicker" title="Date from" >
			    </div>
			    <div class="form-group clearfix">
					<label class="label-more-margin">To date</label>
                    <input type="text" id="To_Date" name="To_Date" value="<?php echo $Saved_To_Date; ?>" size="15" class="datepicker" title="Date to">
				</div>
			    <div class="form-group clearfix">
                	<input type="hidden" id="Page_Winners" name="Page_Winners" value="<?php echo $Winner_Non_Winner; ?>">
                	<input name="Submit" class="button" type="submit" id="Submit" value="Export Entrants CSV" title="Export Entrants CSV">
				</div>
			</form>
		</section>

		<div id="tabs">
		  <ul>
		     	<li id="Non_Winners">
                	Entrants                
                </li>				
		  	</ul>
			<div class="table-wrapper">
            	<table width="100%" cellpadding="0" cellspacing="0" border="0" id="tabs-1">
                	<thead>
                    	<tr>
                        	<th>ID</th>                               
                            <th>Submission date</th>
                            <th>Name</th>
                            <th>Company name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                     	</tr>
              		</thead>
				<tbody>
<?php
					if (empty($Msg)) {
						while ($row = mysqli_fetch_array($result)) {													
							$Id = trim(stripslashes($row['Id']));	
							$Date_Of_Entry = trim(stripslashes($row['Date_Of_Entry']));	
							$Date_Parts = explode(" ", $Date_Of_Entry);
							$The_Time = $Date_Parts[1];	
							$The_Date_Parts = explode("-", $Date_Parts[0]);	
							$The_Date = $The_Date_Parts[2] . "/" . $The_Date_Parts[1] . "/" . $The_Date_Parts[0];
							$The_Date_And_Time = $The_Date . " " . $The_Time;	
							$Title = trim(stripslashes($row['Title']));	
							$Name = trim(stripslashes($row['Name']));	
							$Company_Name = StrippedChars(trim(stripslashes($row['Company_Name'])));								
							$Telephone = StrippedChars(trim($row['Telephone']));					
							$Email = StrippedChars(trim(stripslashes($row['Email'])));
							$Code = StrippedChars(trim(stripslashes($row['Code']))); 
							$Please_Contact_Me_With_Offers = StrippedChars(trim(stripslashes($row['Please_Contact_Me_With_Offers'])));
							$ROI_Question = StrippedChars(trim(stripslashes($row['ROI_Question']))); 							
?>
                            <tr>
                            	<td><?php echo $Id; ?></td>
                                <td><?php echo $The_Date_And_Time ; ?></td>
                                <td><?php echo $Name; ?></td>
                                <td><?php echo $Company_Name; ?></td>
                                <td><?php echo $Email; ?></td>
                                <td><?php echo $Telephone; ?></td>
                            </tr>
<?php
						}						
					}
?>			  		
			  	</tbody>
			</table>
		</div>
        <div class="pagination">
<?php
			
			if (!isset($_GET["Page_Winners"])) {								
				if ($Total_Pages > 1) {
					if ((int)$Page !== 1) {	
						echo "<a href='tables.php?Page=1'>" . "<<" . "</a> ";
					}
					else {						
						echo "<span><<</span> ";
					}
				}				
				if ($Total_Pages == 1) {
					echo "<span>1</span>"; 
				}
				
				for ($i = 1; $i <= $Total_Pages; $i++) { 					
					if (((int)$i >= (int)$Page - 2) & ((int)$i <= (int)$Page + 2)) {
						if ((int)$Page !== (int)$i) {
            				echo "<a href='tables.php?Page=" . $i . "'>" . $i . "</a> "; 
						}
						else {
							echo $i . " "; 
						}
					}					
				}
				if ($Total_Pages > 1) {
					if ((int)$Page !== (int)$Total_Pages) {
						echo "<a href='tables.php?Page=" . $Total_Pages . "'>" . ">>" . "</a>";
					}
					else {
						echo "<span>>></span>";
					}
				}
			}
?>	
</div>
		</div>	
	</div>
   <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/vendor/jquery-ui.min.js"></script>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script>
	  $(function() {
	  	$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
	  		changeMonth: true,
      		changeYear: true
	  	});
	    $( "#tabs" ).tabs();
	  });
  </script>
</body>
</html>