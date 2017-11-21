<?php
/**
* @file
*/
namespace Drupal\entrants_daily\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class EntrantsDailyForm extends FormBase { 
	/**
   	* {@inheritdoc}
   	*/
 	public function getFormId() {
   		return 'entrants_daily_form';
  	}
    
  	/**
   	* {@inheritdoc}
   	*/
     public function buildForm(array $form, FormStateInterface $form_state) {
        $form['from_date'] = array(
            '#name' => 'from_date',		
            '#id' => 'from_date',
            '#type' => 'date',
            '#title' => t('Date from:'),  
        );
		$form['to_date'] = array(
            '#name' => 'to_date',		
            '#id' => 'to_date',
            '#type' => 'date',
            '#title' => t('Date to:'),  
        );	
		$form['human_test'] = array(
            '#name' => 'human_test',		
            '#id' => 'human_test',
            '#type' => 'hidden',				
        ); 
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
          '#type' => 'submit',
          '#value' => $this->t('DOWNLOAD'),
          '#button_type' => 'primary',
        );
        return $form;
    }
  
  	/**
   	* {@inheritdoc}
   	*/
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$From_Date = Substr(trim($form_state->getValue('from_date')),0,10);
		$To_Date = Substr(trim($form_state->getValue('to_date')),0,10);				
		$human_test = $form_state->getValue('human_test');	
		if (trim($From_Date) !== "" & trim($To_Date) !== "") {
			if (trim($From_Date) > trim($To_Date)) {
				$form_state->setErrorByName('from_date', $this->t('Make sure the "From Date" is before the "To Date"'));	
			}		
		}
		if (strlen(trim($human_test)) !== 0 ){			
        	$form_state->setErrorByName('human_test', $this->t('Failed validation test. Please refresh the page and try again.'));					
        }
	}
		
	/**
   	* {@inheritdoc}
   	*/
    public function submitForm(array &$form, FormStateInterface $form_state) { 
		$From_Date = Substr(trim($form_state->getValue('from_date')),0,10);
		$To_Date = Substr(trim($form_state->getValue('to_date')),0,10);	
		$this->download($From_Date, $To_Date);
		$redirect_path = "/entrants-admin";
		$url = url::fromUserInput($redirect_path);
		$form_state->setRedirectUrl($url);	
	}
	
	
	function download($From_Date, $To_Date) { 
		$Time1 = "00:00:00";				
		$Time2 = "24:00:00";		
		$header = "Id" . ",";			  	
		$header = $header . "Date of entry" . ",";
		$header = $header . "First name" . ",";		
		$header = $header . "Surname" . ",";
		$header = $header . "Email" . ",";
		$header = $header . "Telephone" . ",";	
		$header = $header . "House" . ",";
		$header = $header . "Address Line 1" . ",";
		$header = $header . "Address Line 2" . ",";
		$header = $header . "Postcode" . ",";
		$header = $header . "Code" . ",";
		$header = $header . "Answer" . ",";
		$header = $header . "Please send me any further offers" . ",";	
		$dataline = "";	
		$entrant_con = \Drupal\Core\Database\Database::getConnection('default','entrants_daily'); 
				
		if (trim($From_Date) == "" & trim($To_Date) == "") {
			  							
			  $entrant_query = $entrant_con->select('Entrants_Daily', 't')
        		->fields('t', ['Id', 'Date_Of_Entry', 'First_Name', 'Surname', 'Email', 'Telephone', 'House', 'Address_Line1', 'Address_Line2', 'Postcode', 'Code',  'Answer','Please_send_me_any_further_offers'])	
				->orderBy('t.Id','Desc');
		}				
		else {
			if (trim($From_Date) !== "" & trim($To_Date) == "") {			
				$The_Date_Parts = explode("-", $From_Date);				
				$From_Date = $The_Date_Parts[0] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[2];
				$From_Date = $From_Date . " " . $Time1;	
				
				$entrant_query = $entrant_con->select('Entrants_Daily', 't')
        		->fields('t', ['Id', 'Date_Of_Entry', 'First_Name', 'Surname', 'Email', 'Telephone', 'House', 'Address_Line1', 'Address_Line2', 'Postcode', 'Code', 'answer', 'Please_send_me_any_further_offers'])	
				->condition('t.Date_Of_Entry', $From_Date, '>=') 	
				->orderBy('t.Id','Desc');
			}
			else {					
				if (trim($From_Date) == "" & trim($To_Date) !== "") {											
					$The_Date_Parts = explode("-", $To_Date);
					$To_Date = $The_Date_Parts[0] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[2];
					$To_Date = $To_Date . " " . $Time2;																	
					$entrant_query = $entrant_con->select('Entrants_Daily', 't')
        			->fields('t', ['Id', 'Date_Of_Entry', 'First_Name', 'Surname', 'Email', 'Telephone', 'House', 'Address_Line1', 'Address_Line2', 'Postcode', 'Code', 'Answer', 'Please_send_me_any_further_offers'])	
					->condition('t.Date_Of_Entry', $To_Date, '<=') 
					->orderBy('t.Id','Desc');	
				}						
				if (trim($From_Date) !== "" & trim($To_Date) !== "") {				
					$The_Date_Parts = explode("-", $From_Date);
					$From_Date = $The_Date_Parts[0] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[2];
					$From_Date = $From_Date . " " . $Time1;								
					$The_Date_Parts = explode("-", $To_Date);
					$To_Date = $The_Date_Parts[0] . "-" . $The_Date_Parts[1] . "-" . $The_Date_Parts[2];	
					$To_Date = $To_Date . " " . $Time2;																
					$entrant_query = $entrant_con->select('Entrants_Daily', 't')
        			->fields('t', ['Id', 'Date_Of_Entry', 'First_Name', 'Surname', 'Email', 'Telephone', 'House', 'Address_Line1', 'Address_Line2', 'Postcode', 'Code', 'Answer', 'Please_send_me_any_further_offers'])
					->condition('t.Date_Of_Entry', $From_Date, '>=') 
					->condition('t.Date_Of_Entry', $To_Date, '<=')
					->orderBy('t.Id','Desc');	
				}
			}
		}	
		
		$result = $entrant_query->execute()->fetchAll();			
		foreach ($result as $row) {			
			$data = "";															
			$Id = trim(stripslashes($row->Id));
			$Id = str_replace('"', '""', $Id);	
			$Date_Of_Entry = trim(stripslashes($row->Date_Of_Entry));							
			$Date_Of_Entry = str_replace('"', '""', $Date_Of_Entry);			
			$Date_Parts = explode(" ", $Date_Of_Entry);
			$The_Time = $Date_Parts[1];	
			$The_Date_Parts = explode("-", $Date_Parts[0]);	
			$The_Date = $The_Date_Parts[2] . "/" . $The_Date_Parts[1] . "/" . $The_Date_Parts[0];
			$The_Date_And_Time = $The_Date . " " . $The_Time;							
			$First_Name = trim(stripslashes($row->First_Name));											 								 			$First_Name = str_replace('"', '""', $First_Name);	
			$Surname = $this->StrippedChars(trim(stripslashes($row->Surname)));	
			$Surname = str_replace('"', '""', $Surname);	
			$Email = $this->StrippedChars(trim(stripslashes($row->Email)));																					            $Email = str_replace('"', '""', $Email);						
			$Telephone = $this->StrippedChars(trim($row->Telephone));
			$Telephone = str_replace('"', '""', $Telephone);
			$House = $this->StrippedChars(trim($row->House));
			$House = str_replace('"', '""', $House);
			$Address_Line1 = $this->StrippedChars(trim($row->Address_Line1));
			$Address_Line1 = str_replace('"', '""', $Address_Line1);
			$Address_Line2 = $this->StrippedChars(trim($row->Address_Line2));
			$Address_Line2 = str_replace('"', '""', $Address_Line2);
			$Postcode = $this->StrippedChars(trim($row->Postcode));
			$Postcode = str_replace('"', '""', $Postcode);
			$Code = $this->StrippedChars(trim($row->Code));
			$Code = str_replace('"', '""', $Code);
			$Answer = $this->StrippedChars(trim($row->Answer));
			$Answer = str_replace('"', '""', $Answer);								
			$Please_send_me_any_further_offers = $this->StrippedChars(trim(stripslashes($row->Please_send_me_any_further_offers)));  
			$Please_send_me_any_further_offers = str_replace('"', '""', $Please_send_me_any_further_offers);	
			$data = $data . '"' . utf8_decode($Id)  . '",';	
			$data = $data . '"' . utf8_decode($The_Date_And_Time) . '",';														
			$data = $data . '"' . utf8_decode($First_Name) . '",';	
			$data = $data . '"' . utf8_decode($Surname) . '",';	
			$data = $data . '"' . utf8_decode($Email) . '",';
			$data = $data . '"' . utf8_decode($Telephone) . '",';
			$data = $data . '"' . utf8_decode($House) . '",';
			$data = $data . '"' . utf8_decode($Address_Line1) . '",';
			$data = $data . '"' . utf8_decode($Address_Line2) . '",';
			$data = $data . '"' . utf8_decode($Postcode) . '",';
			$data = $data . '"' . utf8_decode($Code) . '",';	
			$data = $data . '"' . utf8_decode($Answer) . '",';						
			$data = $data . '"' . utf8_decode($Please_send_me_any_further_offers) . '",';															
			$dataline .= trim($data) . "\n";
		}
		ob_end_clean();						
		header("Content-type: text/csv; charset=utf-8");
		header("Content-Encoding: utf-8");
		header("Content-Disposition: attachment; filename=anchor_entrants_daily.csv");
		header("Pragma: no-cache");
		header("Expires: 0");	
		echo $header . "\n" . $dataline; 
		exit;			
	}
	
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
}
?>
