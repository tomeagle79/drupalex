<?php
/**
* @file
*/
namespace Drupal\registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Routing\TrustedRedirectResponse;
class RegistrationForm extends FormBase { 
	/**
   	* {@inheritdoc}
   	*/
 	public function getFormId() {
   		return 'registration_form';
  	}
    
  	/**
   	* {@inheritdoc}
   	*/
     public function buildForm(array $form, FormStateInterface $form_state) {
        $form['first_name'] = array(
            '#name' => 'first_name',		
            '#id' => 'first_name',
            '#type' => 'textfield',
            '#title' => t('FIRSTNAME:'),
            '#required' => TRUE,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
        $form['surname'] = array(
            '#name' => 'surname',		
            '#id' => 'surname',
            '#type' => 'textfield',
            '#title' => t('SECOND NAME:'),
            '#required' => TRUE,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
        $form['email'] = array (
            '#name' => 'email',		
            '#id' => 'email',
            '#type' => 'email',
            '#title' => t('EMAIL'),
			'#required' => TRUE,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
        $form['phone'] = array (
            '#name' => 'phone',		
            '#id' => 'phone',
            '#type' => 'text',
            '#title' => t('PHONE'),
            '#required' => FALSE,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );          
        $form['terms'] = array(
            '#name' => 'terms',		
            '#id' => 'terms',
            '#type' => 'checkbox',			
            '#title' => t('I agree to the <a href="/terms-and-conditions" target="_blank">terms and conditions</a>'),
			'#required' => TRUE,
            '#prefix' => '<div style="clear:both"></div>
                         <hr>
                         <div style="clear:both"></div>
                         <div class="label-wrap terms-wrap">',
            '#suffix' => '</div>',
        );
        $form['offers'] = array(
            '#name' => 'offers',		
            '#id' => 'offers',
            '#type' => 'checkbox',			
            '#title' => t('Please send me any further offers'),
            '#prefix' => '<div class="label-wrap terms-wrap">',
            '#suffix' => '</div>
                         <div style="clear:both"></div>
                         <hr>',
        ); 
		$form['human_test'] = array(
            '#name' => 'human_test',		
            '#id' => 'human_test',
            '#type' => 'hidden',				
        );
		 
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
          '#type' => 'submit',
          '#value' => $this->t('ENTER'),
          '#button_type' => 'primary',
		  '#attributes' => array('onclick' => 'this.form.target="_blank";return true;'),
        );
        return $form;
    }
  
  	/**
   	* {@inheritdoc}
   	*/
	public function validateForm(array &$form, FormStateInterface $form_state) {		
		$first_name = $form_state->getValue('first_name');
		$surname = $form_state->getValue('surname');
		$phone = $form_state->getValue('phone');
		$email = $form_state->getValue('email');	
		
		$human_test = $form_state->getValue('human_test');
		
		if (!$this->Is_a_Letter_or_Space(trim($first_name))) {
			$form_state->setErrorByName('first_name', $this->t('The first name is invalid.'));
		}
		
		if (strlen(trim($surname)) < 2 ){			
        	$form_state->setErrorByName('surname', $this->t('The surname is invalid.'));									
        }
		
		if (!$this->Is_a_Letter_or_Space(trim($surname))) {
			$form_state->setErrorByName('surname', $this->t('The surname is invalid.'));
		}	
    	
		//if (!$this->valid_telephone_contents(trim($phone))) {
		//	$form_state->setErrorByName('phone', $this->t('The telephone number is invalid.'));
		//}
		
		$registrants_con = \Drupal\Core\Database\Database::getConnection('default','registrants'); 
		$registrants_query = $registrants_con->select('Registrants', 't')
        ->fields('t', ['Id'])		
		->condition('t.Email', $email, '=');
    	$result = $registrants_query->execute()->fetchAll();					
		$count = 0;
		foreach ($result as $row) {
			$count++;
		}				
		if ($count > 0 ) {		
			$form_state->setErrorByName('email', $this->t('Sorry, That email address is already registered'));
		}	
	}
	
	function Is_a_Letter_or_Space($inputbox) {  		

		$teststring = Trim($inputbox);
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
	
	Function valid_telephone_contents($inputbox) { 

		$teststring = trim($inputbox);

		if (empty($teststring)) {				
			return False;		
		}
		$count = 0;		

		while ($count <  strlen($teststring)) {	
			$c = substr($teststring, $count, 1);
			if (($c !== " ") & ($c !== "-") & ($c !== ".") & ($c !== "+") & ($c !== "(") & ($c !== ")") & (!$this->Is_a_Number($c))) {				
				return False;			
			}
			$count++;
		}		

		if (strlen($teststring) < 10) {		
			return False;
		}
		
		if (strlen($teststring) > 25) {		
			return False;	
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
  
	/**
   	* {@inheritdoc}
   	*/
    public function submitForm(array &$form, FormStateInterface $form_state) { 
		$cc = "AN";
		$oc = "109808";
		$longCK = "hLOg4ty8usmIN6BvDlJwcUziPCYa3jderTxK2qSbWXkF19fQnHpREAGVZ75oM";
		$shortCK = "kynmwpzret";
		$first_name = $form_state->getValue('first_name');
		$surname = $form_state->getValue('surname');
		$email = $form_state->getValue('email');
		$phone = $form_state->getValue('phone');
		$offers = $form_state->getValue('offers');
		if ($offers == 0) {
			$offers = "No";
		}
		if ($offers == 1) {
			$offers = "Yes";
		}
		        
    	$registrants_con = \Drupal\Core\Database\Database::getConnection('default','registrants'); 		
		
		$uniquePIN = "false";
		$i = 0;
do {
    // generate 5 random letters
			srand((float) microtime() * 10000000);
			$input = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
			$rand_keys = array_rand($input, 5);
			$part1 = $input[$rand_keys[0]] . $input[$rand_keys[1]] . $input[$rand_keys[2]] . $input[$rand_keys[3]] . $input[$rand_keys[4]];
			// generate 5 random numbers
			srand((double)microtime()*1000000);
			$part2 = sprintf("%'05d", rand(0,99999));
			$randomPIN = $part1 . $part2;
			// check for duplicate pins in the database
			$registrants_pin_query = $registrants_con->select('Registrants', 't')
        	->fields('t', ['Id'])		
			->condition('t.Pin', $randomPIN, '=');
    		$result = $registrants_pin_query->execute()->fetchAll();
			$count = 0;
			foreach ($result as $row) {
				$count++;
			}				
			if ($count == 0 ) {	
				$uniquePIN = "true";
			} 
			else {
				$uniquePIN = "false";
			}
} while ($uniquePIN == "false");
		
		// CIPHER KEY ENCRYPTION
		$theurl = "http://cpt.coupons.com/au/encodecpt.aspx?p=" . $randomPIN . "&oc=" . $oc . "&sk=" . $shortCK . "&lk=" . $longCK;
		// open url to grab the cpt
		$contentCPT = "";
		if (!($fp = fopen($theurl, 'r'))) {
			$contentCPT = "";
		}
		else {
			// screen scrape
			$contentCPT .= fread($fp, 1000000);
			fclose($fp);
		}
		date_default_timezone_set("Europe/London"); 
		$thedatetime = date('Y-m-d H:i:s');
		$registrants_query = $registrants_con->insert('Registrants')
  			->fields([
  				'Date_Of_Entry' => $thedatetime,
  				'First_Name' => $first_name,
				'Surname' => $surname,
				'Email' => $email,
				//'Telephone' => $phone,
				'Pin' => $randomPIN,
				//'Please_send_me_any_further_offers' => $offers,
			])
		->execute();
		// READY TO PRINT - redirect to Quotient to print the coupon
		$locRedirect = "http://bricks.couponmicrosite.net/javabricksweb/index.aspx?o=" . $oc . "&c=" . $cc . "&p=" . $randomPIN . "&cpt=" . $contentCPT . "&ct=" . strtoupper($first_name) . "%20" . strtoupper($surname);

		$url = new TrustedRedirectResponse($locRedirect);			
		$form_state->setResponse($url);			
	}
}
?>
