<?php

namespace Drupal\quiz_module\Services;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\field\Entity\FieldStorageConfig;

class helloform2 {

    public function helloformtt (array $new_option)  {
        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');    
        $ids = $nodeStorage->getQuery()  
        ->condition('status', 1)  
        ->condition('type', 'quiz_logic')
        ->execute();
        $articles = $nodeStorage->loadMultiple($ids);
        $c=key($articles);
        $win=0;
        $loss=0;
        $temp_new[2]=$articles[$c]->field_answer_one->value;
        $temp_new[3]=$articles[$c]->field_answer_->value;
        $temp_new[4]=$articles[$c]->field_answer_three->value;
        $temp_new[5]=$articles[$c]->field_answer_four->value;

 
        //logic 
        for($i=2;$i<(count($new_option)+2);$i++)
        {
            if($new_option[$i]==$temp_new[$i])
            {
                $win++;
            }
            else if($new_option[$i]!=$temp_new[$i])
            {
                $loss++;
            }
        }
        \Drupal::messenger()->addMessage('correct answer is ==> '. $win);
        \Drupal::messenger()->addMessage('wrong answer is ==> ' .$loss);
      return $new_option;

    }

}
