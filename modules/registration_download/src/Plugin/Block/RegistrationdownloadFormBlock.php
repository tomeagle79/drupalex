<?php

namespace Drupal\registration_download\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides an 'Registration Download Form' block.
 *
 * @Block(
 *   id = "Registrationdownloadform_block",
 *   admin_label = @Translation("Registration Download Form block"),
 * )
 */

class RegistrationdownloadFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\registration_download\Form\RegistrationdownloadForm');	
		return $builtForm;
  	} 
}