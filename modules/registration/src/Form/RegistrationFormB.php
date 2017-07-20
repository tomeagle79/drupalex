<?php
/**
* @file
*/
namespace Drupal\registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

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
        // $form['phone'] = array (
        //     '#name' => 'phone',		
        //     '#id' => 'phone',
        //     '#type' => 'tel',
        //     '#title' => t('PHONE'),
        //     '#required' => TRUE,
        //     '#prefix' => '<div class="label-wrap">',
        //     '#suffix' => '</div>',
        // );  
        $form['loyalty_code'] = array (
            '#name' => 'loyalty_code',		
            '#id' => 'loyalty_code',
            '#type' => 'textfield',
            '#title' => ('CODE'),
            '#required' => TRUE,
            '#prefix' => '<hr>					
                         <div class="label-wrap loyalty-code">',
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
        //$form['offers'] = array(
        //    '#name' => 'offers',		
        //    '#id' => 'offers',
        //    '#type' => 'checkbox',			
        //    '#title' => t('Please send me any further offers'),
        //    '#prefix' => '<div class="label-wrap terms-wrap">',
        //    '#suffix' => '</div>
        //                 <div style="clear:both"></div>
        //                 <hr>',
        //); 
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
        );
        return $form;
    }
  
  	/**
   	* {@inheritdoc}
   	*/
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$first_name = $form_state->getValue('first_name');
		$surname = $form_state->getValue('surname');
		//$phone = $form_state->getValue('phone');
		$email = $form_state->getValue('email');		
		$loyalty_code = $form_state->getValue('loyalty_code');
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
		
		$entrant_con = \Drupal\Core\Database\Database::getConnection('default','registrants'); 
		$entrant_query = $entrant_con->select('Entrants', 't')
        ->fields('t', ['Id'])		
		->condition('t.Code', $loyalty_code, '=');
    	$result = $entrant_query->execute()->fetchAll();		
		$count = 0;
		foreach ($result as $row) {
			$count++;
		}				
		if ($count > 0 ) {		
			$form_state->setErrorByName('loyalty_code', $this->t('Sorry, This code has already been used'));
		}				
				
		date_default_timezone_set("Europe/London"); 
		$thedate = date('Y-m-d');
		
		
		$entrant_query = $entrant_con->select('Entrants', 't')
        ->fields('t', ['Id'])
		->condition('t.Email', $email, '=')
		->condition('t.Date_Of_Entry', $thedate . '%', 'like');
    	$result = $entrant_query->execute()->fetchAll();		
		$count = 0;
		foreach ($result as $row) {
			$count++;
		}				
		if ($count >= 30 ) {		
			$form_state->setErrorByName('loyalty_code', $this->t('Sorry, you have entered too many times today. Try again tomorrow.'));				
		}
		
		if (strlen(trim($loyalty_code)) !== 12 ){			
        	$form_state->setErrorByName('loyalty_code', $this->t('The code is invalid.'));									
        }		
					
		$loyalty_code_start = substr(trim($loyalty_code), 0, 2);
		if (strtoupper(trim($loyalty_code_start)) !== "AB" & strtoupper(trim($loyalty_code_start)) !== "AN" & strtoupper(trim($loyalty_code_start)) !== "AH" & strtoupper(trim($loyalty_code_start)) !== "AF"){			
        	$form_state->setErrorByName('loyalty_code', $this->t('The code is invalid.'));									
        }				
		if (strlen(trim($human_test)) !== 0 ){			
        	$form_state->setErrorByName('human_test', $this->t('Failed validation error. Please refresh the page and start again.'));
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
	
	//Function valid_telephone_contents($inputbox) { 
//
	//	$teststring = trim($inputbox);
//
	//	if (empty($teststring)) {				
	//		return False;		
	//	}
	//	$count = 0;		
//
	//	while ($count <  strlen($teststring)) {	
	//		$c = substr($teststring, $count, 1);
	//		if (($c !== " ") & ($c !== "-") & ($c !== ".") & ($c !== "+") & ($c !== "(") & ($c !== ")") & (!$this->Is_a_Number($c))) {				
	//			return False;			
	//		}
	//		$count++;
	//	}		
//
	//	if (strlen($teststring) < 10) {		
	//		return False;
	//	}
	//	
	//	if (strlen($teststring) > 25) {		
	//		return False;	
	//	}	
	//	return True;
	//}	
	
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
		$first_name = $form_state->getValue('first_name');
		$surname = $form_state->getValue('surname');
		$email = $form_state->getValue('email');
		//$phone = $form_state->getValue('phone');				
		$loyalty_code = $form_state->getValue('loyalty_code');
		//$offers = $form_state->getValue('offers');
		//if ($offers == 0) {
		//	$offers = "No";
		//}
		//if ($offers == 1) {
		//	$offers = "Yes";
		//}
		        
    	$entrant_con = \Drupal\Core\Database\Database::getConnection('default','registrants'); 
		date_default_timezone_set("Europe/London"); 
		$thedatetime = date('Y-m-d H:i:s');
		$entrant_query = $entrant_con->insert('Entrants')
  							->fields([
  								'Date_Of_Entry' => $thedatetime,
  								'First_Name' => $first_name,
								'Surname' => $surname,
								'Email' => $email,
								//'Telephone' => $phone,
								'Code' => $loyalty_code,
								//'Please_send_me_any_further_offers' => $offers,
							])
						->execute();
		$redirect_path = "/thank-you";
		$url = url::fromUserInput($redirect_path);
		$form_state->setRedirectUrl($url);	
	}
}
?>
