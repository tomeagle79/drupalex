<?php

namespace Drupal\competition_fields\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Competition Fields Form' block.
 *
 * @Block(
 *   id = "competitionfieldsform_block",
 *   admin_label = @Translation("Competition Fields Form block"),
 * )
 */

class CompetitionFieldsFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\competition_fields\Form\CompetitionFieldsForm');	
		return $builtForm;
  	} 
}