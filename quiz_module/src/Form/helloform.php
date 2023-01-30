<?php 

namespace Drupal\quiz_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class helloform extends FormBase {

 public function getFormID(){
    return'drupalup_simple_form';
 }
 public function buildForm(array $form, FormStateInterface $form_state){
    global $temp;
    global $a;
    global $b;
    global $d;
    $d=0;
    $a=1;
    $b=2;
    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');    
    $ids = $nodeStorage->getQuery()  
    ->condition('status', 1)  
    ->condition('type', 'quiz_question')
    ->execute();
    $articles = $nodeStorage->loadMultiple($ids);
  
  $c=key($articles);
   for($i=0;$i<count($articles);$i++)
   {
    $option =[];
    for ($j=0;$j<count($articles[$c]->field_answer);$j++)
    {
        $option[$j] = $articles[$c]->field_answer[$j]->value;
        
    }

    if($d==0){
        $form['select_fieldset_container'. $a] = [
            '#type' => 'fieldset',
           '#collapsible' => true,
            '#attributes' => ['id' => ['select_fieldset_container' . $a]],
           // '#title' => t($articles[$c]->field_question->value),
        ];
        $d=$d+1;
     $form['select_fieldset_container'. $a ] [$b] = [
        '#type' => 'radios',
        '#options' => $option,
        '#title' => t($articles[$c]->field_question->value),
        '#ajax' => [
            'callback' => '::instrumentDropdownCallback',
            'wrapper'  =>  ['select_fieldset_container' . $a],
            'event' => 'change',
        ],
    ];
}
else{
    $form['select_fieldset_container'. $a] = [
        '#type' => 'fieldset',
        '#collapsible' => true,
        '#attributes' => ['id' => ['select_fieldset_container' . $a]],
        '#states' => [
            'visible' => [ // action to take.
                ':input[name="'. ($b-1).'"]' => ['checked' => true],
        ],
    ],
       // '#title' => t($articles[$c]->field_question->value),
    ];
    $d=$d+1;
    $form['select_fieldset_container'. $a] [$b] = [
        '#type' => 'radios',
        '#options' => $option,
        '#title' => t($articles[$c]->field_question->value),
        '#states' => [
            'visible' => [ // action to take.
                ':input[name="'. ($b-1).'"]' => ['checked' => true],
        ],
        ],
        '#ajax' => [
            'callback' => '::instrumentDropdownCallback',
            'wrapper'  =>  ['select_fieldset_container' . $a],
            'event' => 'change',
        ],
    ];
}
    $a++;
    $b++;
  $c=next($articles)->nid->value;

}
$temp=$b;


    $form['submit']=[
        '#type' => 'submit',
        '#value' => $this->t('Submit the answer'),
       ];
       return $form;
 }

 public function instrumentDropdownCallback(array $form, FormStateInterface $form_state) {
    return $form['select_fieldset_container' . $a];
  }

 public function submitform(array &$form, FormStateInterface $form_state){

    global $temp;
    $new_option=[];
    $new;
    for($i=2;$i<=$temp-1;$i++)
    {
   $new_option[$i]=$form_state->getValue($i);
   
    }
    $new = \Drupal::service('quiz_module.hello_form_2')->helloformtt($new_option);

 }
}
