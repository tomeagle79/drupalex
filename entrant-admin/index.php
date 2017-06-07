<?php
	session_start();
	function StrippedChars($strWords) {

		$badChars = array('/select /i', '/drop/i', '/;/i', '/--/i', '/insert /i', '/delete /i', '/xp_/i','/SELECT /i', '/DROP /i', '/INSERT /i', '/DELETE /i', '/XP_/i', '/Xp_/i', '/xP_/i','/sELECT /i', '/dROP /i', '/iNSERT /i', '/dELETE /i','/seLECT /i', '/drOP /i', '/inSERT /i', '/deLETE /i','/selECT /i', '/droP /i', '/insERT /i', '/delETE /i','/seleCT/i','/inseRT /i', '/deleTE /i','/selecT /i','/inserT /i', '/deletE /i', '/DRop /i', '/DroP/i', '/DrOp /i', '/dRoP /i', '/DROp /i', '/DRoP /i','/Insert /i','/iNsert /i','/inSert/i','/insErt /i','/inseRt /i','/inserT /i', '/deletE /i', '/dROp /i', '/DroP /i', '/DrOp /i', '/dRoP /i'); 

		$replaceChars = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''); 		

		$newChars = $strWords;
        if (trim($newChars) !== "") {
       		$newChars = preg_replace($badChars,$replaceChars,$strWords);
		}

		return $newChars; 

	}
	
	function MakesSafeForDb($connection, $value) {	
   		// Stripslashes
   		if (get_magic_quotes_gpc()) {
       		$value = stripslashes($value);
   		}
	   // Quote if not a number or a numeric string
	   if (!is_numeric($value)) {		   
		    $value = mysqli_real_escape_string($connection, $value);
	   }
	   return $value;
	}
	
	if (isset($_POST['Submit'])) {
		$OK = "No";	
		$Msg = "";

		include_once "db_connect.php";	
			
		if (empty($Msg)) {		
			$LoginUser = strtolower(StrippedChars(Substr(trim($_POST['Username']),0,25)));		
			
			$LoginPassword = md5(strtolower(StrippedChars(Substr(trim($_POST['Password']),0,25))));
				
			if ($LoginUser != "" & $LoginPassword != "") {											
				$sqlstring = "SELECT * FROM Administrator WHERE Lower(Username) = '" . MakesSafeForDb($connection, $LoginUser) . "' AND Lower(Password) = '" . MakesSafeForDb($connection, $LoginPassword) . "'";	
										
				if (!($result = mysqli_query($connection, $sqlstring))) {
					$Msg = "An error has occured when selecting the record from the Database";
				}
				if (empty($Msg)) {	
					while ($row = mysqli_fetch_array($result)) {	
						$_SESSION['Username'] = StrippedChars(Substr(trim($row['Username']),0,25));	
						$_SESSION['Password'] = StrippedChars(Substr(trim($row['Password']),0,25));	
													
						if (!(mysqli_close($connection))) {
							$Msg = "Error in closing the Database";					
						}
						else {
								$OK = "Yes";
						}
					}	
				}									
			}
			else {
				$Msg = "Either the username or password or both are not completed.";
			}
		}
		if ($Msg == "") {			
			if ($OK == "Yes") {				
				header('Location: tables.php');
			}
			else {
				$Msg = "Either the username or password or both are invalid.";
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
    <script src="js/login_vet.js" type="text/javascript"></script>
</head>
<body>
	<header>
		<div class="logo">
			<!-- <img src="" alt=""> -->
		</div>
	</header>

	<section class="login-form-wrapper">
		<h1>Please login to manage your site</h1>
		<form name="Login_Form" action="index.php" method="post" style="margin: 0px;">
			<div class="form-group">
<?php
            	if ($Msg !== "") {
?>
            		<span style="color:#F00; font-size:14px;"><? echo $Msg;?></span>
					<br>
                	<br>
<?php
                }
?>
                <label>Username</label>			
                <input name="Username" type="username" size="25" maxlength="25" title="Username" alt="Username" id="Username">
		    </div>
		    <div class="form-group">
				<label class="more-padding-label">Password</label>				
                <input name="Password" type="password" size="25" maxlength="25" title="Password" id="Password">
			</div>
			<div class="log-in-link">				
                <input type="Submit"  name="Submit" id="Submit" value="Login"  onClick="JavaScript: return validate();"/>
			</div>
		</form>
	</section>
</body>
</html>