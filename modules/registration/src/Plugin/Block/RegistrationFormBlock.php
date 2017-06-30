<?php

namespace Drupal\Registration\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Registration Form' block.
 *
 * @Block(
 *   id = "registrationform_block",
 *   admin_label = @Translation("Registration Form block"),
 * )
 */

class RegistrationFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\registration\Form\RegistrationForm');	
		return $builtForm;
  	} 
}
