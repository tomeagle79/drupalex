<?php

namespace Drupal\entrants\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides an 'Entrants Download Form' block.
 *
 * @Block(
 *   id = "Entrantsform_block",
 *   admin_label = @Translation("Entrants Download Form block"),
 * )
 */

class EntrantsFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\entrants\Form\EntrantsForm');	
		return $builtForm;
  	} 
}
