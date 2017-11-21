<?php
/**
* @file
*/
namespace Drupal\competition_fields\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class CompetitionFieldsForm extends FormBase { 
	/**
   	* {@inheritdoc}
   	*/
 	public function getFormId() {
   		return 'competition_fields_form';
  	}
    
  	/**
   	* {@inheritdoc}
   	*/
     public function buildForm(array $form, FormStateInterface $form_state) {        
        $form['offers'] = array(
            '#name' => 'offers',		
            '#id' => 'offers',
            '#type' => 'checkbox',			
            '#title' => t('Show "Please send me any further offers" field for competition where you can only enter once'),
            '#prefix' => '<div class="label-wrap terms-wrap">',
            '#suffix' => '</div>                         
                         <hr>',
        ); 
		 $form['daily_offers'] = array(
            '#name' => 'daily_offers',		
            '#id' => 'daily_offers',
            '#type' => 'checkbox',			
            '#title' => t('Show "Please send me any further offers" field for competition where you can enter once per day'),
            '#prefix' => '<div class="label-wrap terms-wrap">',
            '#suffix' => '</div>                         
                         <hr>',
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
    public function submitForm(array &$form, FormStateInterface $form_state) { 		
		$offers = $form_state->getValue('offers');
		if ($offers == 0) {
			$offers = "Hide";
		}
		if ($offers == 1) {
			$offers = "Show";
		}
		$offers_daily = $form_state->getValue('daily_offers');
		if ($offers_daily == 0) {
			$offers_daily = "Hide";
		}
		if ($offers_daily == 1) {
			$offers_daily = "Show";
		}
		        
    	$entrant_con = \Drupal\Core\Database\Database::getConnection('default','competition_form'); 
		date_default_timezone_set("Europe/London"); 
		$thedatetime = date('Y-m-d H:i:s');
		$entrant_query = $entrant_con->update('Form_Details')
  							->fields([
								'Offers_Field' => $offers,
  								'Daily_Offers_Field' => $offers_daily,  								
							])
							->condition('Id', 1, '='
							)
						->execute();
		$redirect_path = "/entrants-admin";
		$url = url::fromUserInput($redirect_path);
		$form_state->setRedirectUrl($url);		
	}
}
?>