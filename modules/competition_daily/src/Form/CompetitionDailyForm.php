<?php
/**
* @file
*/
namespace Drupal\competition_daily\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class CompetitionDailyForm extends FormBase { 
	/**
   	* {@inheritdoc}
   	*/
 	public function getFormId() {
   		return 'competition_daily_form';
  	}
    
  	/**
   	* {@inheritdoc}
   	*/
     public function buildForm(array $form, FormStateInterface $form_state) {
	 	$con = \Drupal\Core\Database\Database::getConnection('default','competition_form'); 
	 	$query = $con->select('Form_Details', 't')
        ->fields('t', ['Daily_Offers_Field']);		
		$result = $query->execute()->fetchAll();		
		$Daily_Offers_Field = "";
		foreach ($result as $row) {			
			$Daily_Offers_Field = $row->Daily_Offers_Field;
		}
		
        $form['answer'] = array (
            '#name' => 'answer',		
            '#id' => 'answer',
            '#type' => 'textarea',
            '#title' => ('YOUR ANSWER'),
            '#required' => TRUE,
			'#maxlength' => 500,
			'#attributes' => array('maxlength' => 500),
            '#prefix' => '<div class="label-wrap loyalty-code">',
            '#suffix' => '</div><hr><br>
            <p>Please fill in your details</p><br>',
        );  
        $form['first_name'] = array(
            '#name' => 'first_name',		
            '#id' => 'first_name',
            '#type' => 'textfield',
            '#title' => t('FIRST NAME'),
            '#required' => TRUE,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
        $form['surname'] = array(
            '#name' => 'surname',		
            '#id' => 'surname',
            '#type' => 'textfield',
            '#title' => t('SURNAME'),
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
        $form['house'] = array (
            '#name' => 'house',		
            '#id' => 'house',
            '#type' => 'textfield',
            '#title' => t('HOUSE NAME / NUMBER'),
            '#required' => TRUE,
			'#maxlength' => 255,
            '#prefix' => '<br><hr><br>
            <p>If you&apos;re a lucky winner, tell us where to deliver your prize</p><br><div class="label-wrap">',
            '#suffix' => '</div>',
        );  
		$form['address_line1'] = array (
            '#name' => 'address_line1',		
            '#id' => 'address_line1',
            '#type' => 'textfield',
            '#title' => t('ADDRESS LINE 1'),
            '#required' => TRUE,
			'#maxlength' => 255,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        ); 
		$form['address_line2'] = array (
            '#name' => 'address_line2',		
            '#id' => 'address_line2',
            '#type' => 'textfield',
            '#title' => t('ADDRESS LINE 2'),
            '#required' => FALSE,
			'#maxlength' => 255,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
		$form['postcode'] = array (
            '#name' => 'postcode',		
            '#id' => 'postcode',
            '#type' => 'textfield',
            '#title' => t('POSTCODE'),
            '#required' => TRUE,
			'#maxlength' => 10,
            '#prefix' => '<div class="label-wrap">',
            '#suffix' => '</div>',
        );
        $form['terms'] = array(
            '#name' => 'terms',		
            '#id' => 'terms',
            '#type' => 'checkbox',			
            '#title' => t('I agree to the <a href="/daily-terms-and-conditions">terms and conditions</a>'),
			'#required' => TRUE,
            '#prefix' => '<div style="clear:both"></div>
                         <hr>
                         <div style="clear:both"></div>
                         <div class="label-wrap terms-wrap">',
            '#suffix' => '</div>',
        );
		if ($Daily_Offers_Field == "Hide") {
			$form['offers'] = array(
				'#name' => 'offers',		
				'#id' => 'offers',
				'#type' => 'hidden',
				'#value' => 0,	
				'#prefix' => '<div class="label-wrap terms-wrap">',
				'#suffix' => '</div>
							 <div style="clear:both"></div>
							 <hr>',
			); 
		}
		else {		
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
		}
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
		$house = $form_state->getValue('house');
		$address_line1 = $form_state->getValue('address_line1');
		$address_line2 = $form_state->getValue('address_line2');
		$postcode = $form_state->getValue('postcode');
		$email = $form_state->getValue('email');		
		$answer = $form_state->getValue('answer');
		$human_test = $form_state->getValue('human_test');
		
		if (!$this->Is_a_Letter_or_Space(trim($first_name))) {
			$form_state->setErrorByName('first_name', $this->t('The first name is invalid.'));
		}
		
		if (strlen(trim($surname)) < 2 ){			
        	$form_state->setErrorByName('surname', $this->t('The surname is invalid.'));									
        }
		
		if (!$this->Is_a_Letter_or_Space_or_Dash(trim($surname))) {
			$form_state->setErrorByName('surname', $this->t('The surname is invalid.'));
		}	
    	
		if (trim($house) == "") {
			$form_state->setErrorByName('house', $this->t('Please enter a house name or number.'));
		}
		
		if (trim($address_line1) == "") {
			$form_state->setErrorByName('address_line1', $this->t('Please enter the first address line.'));
		}
		
		if (trim($address_line2) == "") {
			if ($this->Is_a_Number(trim($address_line2))) {			
				$form_state->setErrorByName('address_line2', $this->t('Please enter a valid second address line.'));
			}
		}
		
		if (!$this->valid_postcode_contents(trim($postcode))) {
			$form_state->setErrorByName('postcode', $this->t('Please enter the postcode.'));
		}
		
		$entrant_con = \Drupal\Core\Database\Database::getConnection('default','entrants_daily'); 
		date_default_timezone_set("Europe/London"); 
		$thedate = date('Y-m-d');
		$entrant_query = $entrant_con->select('Entrants_Daily', 't')
        ->fields('t', ['Id'])
		->condition('t.Email', $email, '=')
		->condition('t.Date_Of_Entry', $thedate . '%', 'like');	
		
    	$result = $entrant_query->execute()->fetchAll();		
		$count = 0;
		foreach ($result as $row) {
			$count++;
		}	
		
						
		if ($count >= 1 ) {			
			$form_state->setErrorByName('answer', $this->t('Sorry - you have already had a go today - please try another day'));				
		}
		
		if (trim($answer) == "" ){			
				$form_state->setErrorByName('answer', $this->t('Please enter your answer.'));									
        }		
						
		if (strlen(trim($human_test)) !== 0 ){			
        	$form_state->setErrorByName('human_test', $this->t('Not Human - oops.'));									
        }
	}
	
	Function valid_postcode_contents($inputbox) { 
		$teststring = trim($inputbox);
		if (empty($teststring)) {
			return False;
		}				
		if (Is_numeric($teststring)) {
			return False;
		}
		if (strlen($teststring) < 6 | strlen($teststring) > 8) {
			return False;	
		}	
		if (is_numeric(substr($teststring,0,1))) {
			return False;	
		}
		if (!is_numeric(substr($teststring,strlen($teststring) - 3,1))) {
			return False;	
		}
		if (is_numeric(substr($teststring,strlen($teststring) - 2,1))) {
			return False;
		}
		if (is_numeric(substr($teststring,strlen($teststring) - 1,1))) {
			return False;	
		}	
		return True;		
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
	
	function Is_a_Letter_or_Space_or_Dash($inputbox) {  		

		$teststring = Trim($inputbox);
		if ($teststring == "") {		
			return False;		

		}		

		$i = 0;
		while ($i <= strlen($teststring) - 1) {
			$c = strtolower(substr($teststring,$i,1));	

			if ($c <> "a" & $c <> "b" & $c <> "c" & $c <> "d" & $c <> "e" & $c <> "f" & $c <> "g" & $c <> "h" & $c <> "i" & $c <> "j" & $c <> "k" & $c <> "l" & $c <> "m" & $c <> "n" & $c <> "o" & $c <> "p" & $c <> "q" & $c <> "r" & $c <> "s" & $c <> "t" & $c <> "u" & $c <> "v" & $c <> "w" & $c <> "x" & $c <> "y" & $c <> "z" & $c <> " " & $c <> "-") {	
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
  
	/**
   	* {@inheritdoc}
   	*/
    public function submitForm(array &$form, FormStateInterface $form_state) { 	
		$first_name = $form_state->getValue('first_name');
		$surname = $form_state->getValue('surname');
		$email = $form_state->getValue('email');
		$house = $form_state->getValue('house');	
		$address_line1 = $form_state->getValue('address_line1');
		$address_line2 = $form_state->getValue('address_line2');
		$postcode = $form_state->getValue('postcode');			
		$answer = $form_state->getValue('answer');
		$offers = $form_state->getValue('offers');
		if ($offers == 0) {
			$offers = "No";
		}
		if ($offers == 1) {
			$offers = "Yes";
		}
		        
    	$entrant_con = \Drupal\Core\Database\Database::getConnection('default','entrants_daily'); 
		date_default_timezone_set("Europe/London"); 
		$thedatetime = date('Y-m-d H:i:s');
		$entrant_query = $entrant_con->insert('Entrants_Daily')
  							->fields([
  								'Date_Of_Entry' => $thedatetime,
  								'First_Name' => $first_name,
								'Surname' => $surname,
								'Email' => $email,
								'House' => $house,
								'Address_Line1' => $address_line1,
								'Address_Line2' => $address_line2,
								'Postcode' => $postcode,
								'Answer' => $answer,
								'Please_send_me_any_further_offers' => $offers,
							])
						->execute();
		$redirect_path = "/daily-thank-you";
		$url = url::fromUserInput($redirect_path);
		$form_state->setRedirectUrl($url);	
	}
}
?>