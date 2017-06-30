<?php

namespace Drupal\competition\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Competition Form' block.
 *
 * @Block(
 *   id = "competitionform_block",
 *   admin_label = @Translation("Competition Form block"),
 * )
 */

class CompetitionFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\competition\Form\CompetitionForm');	
		return $builtForm;
  	} 
}
