<?php
    session_start();    
    date_default_timezone_set('Europe/London');
    $Msg = "";  
        
    function SQLEnc($value) {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Quote if not a number or a numeric string
        if (!is_numeric($value)) {
           $value = addslashes($value);
        }
        $tmpText = str_replace('\r\n',Chr(13), $value); 
        $tmpText = addslashes($tmpText);    
        return $tmpText;
    }   
    
    function StrippedChars($strWords) {

        $badChars = array('/select /i', '/drop/i', '/;/i', '/--/i', '/insert /i', '/delete /i', '/xp_/i','/SELECT /i', '/DROP /i', '/INSERT /i', '/DELETE /i', '/XP_/i', '/Xp_/i', '/xP_/i','/sELECT /i', '/dROP /i', '/iNSERT /i', '/dELETE /i','/seLECT /i', '/drOP /i', '/inSERT /i', '/deLETE /i','/selECT /i', '/droP /i', '/insERT /i', '/delETE /i','/seleCT/i','/inseRT /i', '/deleTE /i','/selecT /i','/inserT /i', '/deletE /i', '/DRop /i', '/DroP/i', '/DrOp /i', '/dRoP /i', '/DROp /i', '/DRoP /i','/Insert /i','/iNsert /i','/inSert/i','/insErt /i','/inseRt /i','/inserT /i', '/deletE /i', '/dROp /i', '/DroP /i', '/DrOp /i', '/dRoP /i'); 

        $replaceChars = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');      

        $newChars = $strWords;
        if (trim($newChars) !== "") {
            $newChars = preg_replace($badChars,$replaceChars,$strWords);
        }

        return $newChars; 

    }
        
    Function valid_content($inputbox) {         

        $teststring = trim($inputbox);

        if (empty($teststring)) 

            return False;

        if (Is_a_Number($teststring))

            return False;

        if (strlen($teststring) < 2)

            return False;           

        return True;

    }   
    
    function Is_a_Letter_or_Space($inputbox) {  
        $teststring = trim($inputbox);
        if ($teststring == "") {
            return False;       

        }       

        $i = 0;
        while ($i <= strlen($teststring) - 1) {
            $c = strtolower(substr($teststring,$i,1));  

            if ($c <> "a" & $c <> "b" & $c <> "c" & $c <> "d" & $c <> "e" & $c <> "f" & $c <> "g" & $c <> "h" & $c <> "i" & $c <> "j" & $c <> "k" & $c <> "l" & $c <> "m" & $c <> "n" & $c <> "o" & $c <> "p" & $c <> "q" & $c <> "r" & $c <> "s" & $c <> "t" & $c <> "u" & $c <> "v" & $c <> "w" & $c <> "x" & $c <> "y" & $c <> "z" & $c <> " ") {    
                return False;
            }
            $i = $i + 1;
        } 
        return True;
    }
    
    function Is_a_Letter($inputbox) {   
        $teststring = trim($inputbox);
        if ($teststring == "") {
            return False;       

        }       

        $i = 0;
        while ($i <= strlen($teststring) - 1) {
            $c = strtolower(substr($teststring,$i,1));  

            if ($c <> "a" & $c <> "b" & $c <> "c" & $c <> "d" & $c <> "e" & $c <> "f" & $c <> "g" & $c <> "h" & $c <> "i" & $c <> "j" & $c <> "k" & $c <> "l" & $c <> "m" & $c <> "n" & $c <> "o" & $c <> "p" & $c <> "q" & $c <> "r" & $c <> "s" & $c <> "t" & $c <> "u" & $c <> "v" & $c <> "w" & $c <> "x" & $c <> "y" & $c <> "z") {    
                return False;
            }
            $i = $i + 1;
        } 
        return True;
    }
    
    
    function Is_a_Number($inputbox) {       

        $teststring = Trim($inputbox);  

        if ($teststring == "") {

            return False;           

        }       

        $i = 0;
        while ($i <= strlen($teststring) - 1) {

            $c = substr($teststring,$i,1);  

            if ($c <> "0" & $c <> "1" & $c <> "2" & $c <> "3" & $c <> "4" & $c <> "5" & $c <> "6" & $c <> "7" & $c <> "8" & $c <> "9") {                

                return False;

            }

            $i = $i + 1;

        } 
        return True;
    }
    
    Function valid_email_contents($inputbox) {          

        $teststring = trim($inputbox);  

        if (empty($teststring)) {
            return False;
        }       

        if (strlen($teststring) <= 6) {
            return False;
        }               

        $illegalchrs = array('*','£','$','!');  

        $counter = 0;

        While ($counter < 4) {              

            if (strpos($teststring, $illegalchrs[$counter]) != "") {    
                return False;   
            }

            $counter++;

        }           

        $atpositionback = strrpos($teststring, "@");        

        $dotpositionback = strrpos($teststring, ".");       

        $atpositionfront = strpos($teststring, "@");

        if ($atpositionback == 0) {
            return FALSE;
        }

        if ($dotpositionback == 0) {
            return False;
        }

        if ($atpositionfront != $atpositionback) {
            return False;
        }

        if ($atpositionback > $dotpositionback) {
            return False;
        }       
        
        if ($dotpositionback == $atpositionback + 1) {  
            return False;
        }   
        return True;
    }

   
    $Full_Name = "";
    $Over_16;     
    $Email = "";
    $Agree_To_Terms;
    $Please_Contact_Me_With_Offers = "";
    $Agree_To_Term = "";
    $Over_16 = "";
    $Valid_Code = "Yes";
    $Code = "";
    
    if ($_POST['Submit'] == "Submit") {             
        include_once("db_connect.php"); 
        
        if (empty($Msg)) {          
            $Full_Name = StrippedChars(substr(trim($_POST['Full_Name']),0,80));    
            $Email = StrippedChars(substr(trim($_POST['The_Email']),0,50));
            $Code = StrippedChars(trim($_POST['Code']));
            $Over_16 = StrippedChars(substr(trim($_POST['Over_16']),0,3));
            $Agree_To_Terms = StrippedChars(substr(trim($_POST['Agree_To_Terms']),0,3));    
            if ($Valid_Code == "Yes") {
                $sql = "SELECT Id FROM Codes where Code = '" . SQLEnc($Code) . "'";                      
                $result = mysqli_query($connection, $sql);
                if (!($result = $result = mysqli_query($connection, $sql))) {   
                        $Msg = "An error has occured when selecting the information from the Database";                             
                        mysqli_close($connection);  
                }
                else {
                    if (Is_a_Letter_or_Space($Full_Name)) {
                        if (valid_email_contents($Email)) {  
                            if (mysqli_num_rows($result) > 0) {
                                if (trim($Over_16) == "Yes") {                                   
                                $The_Date = date("Y-m-d");  
                                $sql = "SELECT Id FROM Entrants where Email = '" . SQLEnc($Email) . "' and Date_Of_Entry like '" . $The_Date . "%'";                         
                                $result = mysqli_query($connection, $sql);
                                if (!($result = $result = mysqli_query($connection, $sql))) {   
                                    $Msg = "An error has occured when selecting the information from the Database";                             
                                    mysqli_close($connection);  
                                }
                                else {
                                    if (mysqli_num_rows($result) > 2) {
                                        $Msg = "You’ve already entered 3 times today. Don't forget to enter again tomorrow for another chance to win!";
                                    }                                   
                                    else{                                                                                               
                                        $SQLStat = "INSERT into Entrants (Date_Of_Entry, Full_Name, Email, Code) VALUES ('" . SQLEnc(date('Y-m-d G:i:s')) . "','" . SQLEnc($Full_Name) . "','" . SQLEnc($Email) . "','" . SQLEnc($Code)  . "')";                  
                                        if (!($result = mysqli_query($connection, $SQLStat))) { 
                                            $Msg = "An error has occured when recording the information in the Database";                               
                                            mysqli_close($connection);  
                                        }
                                        if ($Msg == "") {
                                            $strMail = $strMail . '<!DOCTYPE html>';
                                            $strMail = $strMail . '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
                                            $strMail = $strMail . '<tr>';
                                            $strMail = $strMail . '<td align="center">';
                                            $strMail = $strMail . 'Thank you';                                       
                                            $strMail = $strMail . '</td>';
                                            $strMail = $strMail . '</tr>';
                                            $strMail = $strMail . '</table>';
                                            $Subject = "Thank you"; 
                                            $To_Email = $Email; 
                                            $headers = "MIME-Version: 1.0" . "\r\n";
                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                            $headers .= 'From: Thank you<thankyou@test.co.uk>' . "\r\n";            
                                            if (!mail(trim($To_Email), $Subject,  $strMail,  $headers)) {                   
                                                $Msg = "There has been a problem sending the errors Email";
                                                echo $Msg;                  
                                            }
                                            else {
                                                mysqli_close($connection);                                          
                                                header('Location: thank-you');  
                                            }
                                        }                                   
                                    }
                                }
                                }
                                else {                      
                                    $Msg = "Please confirm that you agree to the terms and are over 16.";
                                }
                            }
                            else {
                                $Msg = "Please enter a valid code, being sure to enter the 4 digits carefully.";                     
                            }
                        }
                        else {
                            $Msg = "Please enter a valid email address.";                      
                        } 
                    }
                    else {
                        $Msg = "Please enter your full name.";                      
                    }      
                } 
            }
        }
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Test form</title>        
        <meta name="description" content="Test form.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="dist/js/vet.js"></script>
    </head>
    <body>
<?php
        if (trim($Msg) !== "") {
?>
            <div class="notification">
                <span class="error_close">x</span>
                <span><?php echo $Msg;?></span>
            </div>
<?php
        }
?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <main>
            <section>
                    <form name="Entrants_Form" id="Entrants_Form" method="post" action="/index.php">
                        <div class="content">
                            <div id="Step">
                                <div id="Error_Messages_Outer" tabindex="0">
                                    <div id="Error_Messages"></div>
                                </div>
                                <div class="form-row clearfix">
                                    <label for="Full_Name">Full name*</label>
                                    <input name="Full_Name" id="Full_Name" title="First name" type="text" maxlength="50" value="<?php echo $Full_Name;?>">
                                </div>
                                <div class="form-row clearfix">
                                    <label for="The_Email">Email*</label>
                                    <input name="The_Email" id="The_Email" title="Email" type="email" maxlength="50" value="<?php echo $Email;?>">
                                </div>   
                                <div class="form-row clearfix">
                                    <label for="Code">Last 4 digits of barcode*</label>
                                    <input name="Code" id="Code" class="code" title="Code" type="text" maxlength="4" width="40" value="<?php echo $Code; ?>" >
                                    <span class="wheres-my-code">Where's my code?</span>
                                </div>
                                <div class="checkbox-section clearfix">
                                    <div class="checkbox-row">
                                        <div class="form-row custom-input checkbox clearfix">
                                            <input type="checkbox" id="Over_16" name="Over_16" value="Yes" <?php if ($Over_16 == "Yes") {echo "checked";};?> title="I confirm I am over 16">                                        
                                           <label for="Over_16">I am over 16 and agree to <a href="terms">T&amp;Cs</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row submit-row">
                                    <input type="submit" class="submit" value="Submit" name="Submit" id="Submit" onClick="JavaScript: return vet_step();" title="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
            </section>
        </main>
        <footer>
           
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="dist/js/plugins.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    </body>
</html>
