<?php

namespace Drupal\entrants_daily\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides an 'Entrants Download Form' block.
 *
 * @Block(
 *   id = "EntrantsDailyform_block",
 *   admin_label = @Translation("Entrants Daily Download Form block"),
 * )
 */

class EntrantsDailyFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\entrants_daily\Form\EntrantsDailyForm');	
		return $builtForm;
  	} 
}