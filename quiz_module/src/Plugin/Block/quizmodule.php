<?php

namespace Drupal\quiz_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'Drupalup Block' Block.
 *
 * @Block(
 *   id = "zayn malik",
 *   admin_label = @Translation("new block module"),
 *   category = @Translation("Building a simple block module for drupal 9"),
 * )
 */

class quizmodule extends BlockBase {

    /**
   * {@inheritdoc}
   */

  public function build() {


    /*$node = \Drupal::routeMatch()->getParameter('node');
    if ($node->getType() === 'quiz_question') {
      $nid = $node->id();
      print_r("hello");
      \Drupal::messenger()->addMessage($nid);
      }
      */
      
    return [
      '#markup' => $this->t('Hello, World!'),
    ];
  }

}



