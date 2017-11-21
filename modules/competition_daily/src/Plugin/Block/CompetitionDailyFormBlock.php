<?php

namespace Drupal\competition_daily\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Competition Daily Form' block.
 *
 * @Block(
 *   id = "competitiondailyform_block",
 *   admin_label = @Translation("Competition Daily Form block"),
 * )
 */

class CompetitionDailyFormBlock extends BlockBase {
  
  	/**
   	* {@inheritdoc}
   	*/
	public function build() {    
		$builtForm = \Drupal::formBuilder()->getForm('Drupal\competition_daily\Form\CompetitionDailyForm');	
		return $builtForm;
  	} 
}