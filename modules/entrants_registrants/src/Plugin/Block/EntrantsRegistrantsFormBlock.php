<?php

namespace Drupal\entrants_restrants\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides an 'Entrants Registrants Download Form' block.
 *
 * @Block(
 *   id = "EntrantsRegistrantsform_block",
 *   admin_label = @Translation("Entrants Registrants Download Form block"),
 * )
 */

class EntrantsRegistrantsFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\entrants_registrants\Form\EntrantsRegistrantsForm');	
		return $builtForm;
  	} 
}
