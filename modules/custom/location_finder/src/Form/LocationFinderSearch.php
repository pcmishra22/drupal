<?php
namespace Drupal\location_finder\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class LocationFinderSearch extends FormBase
{
    const LOCATION_FINDER_FORM_DATA='location finder form data';
    public function getFormId()
    {
        return 'location_finder_search_page';
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $values=\Drupal::state()->get(key:self::LOCATION_FINDER_FORM_DATA);
        $form=[];
        $form['country']=[
            '#type'=>'textfield',
            '#title'=>$this->t(string: 'this is country'),
            '#description'=>$this->t(string: 'this is country'),
            '#required'=>TRUE,
            '#default_value'=> $values['country'],
        ];
        $form['city']=[
            '#type'=>'textfield',
            '#title'=>$this->t(string: 'this is city'),
            '#description'=>$this->t(string: 'this is city'),
            '#required'=>TRUE,
            '#default_value'=>$values['city'],
        ];
        $form['postal_code']=[
            '#type'=>'textfield',
            '#title'=>$this->t(string: 'this is postal code'),
            '#description'=>$this->t(string: 'this is postal code'),
            '#required'=>TRUE,
            '#default_value'=>$values['postal_code'],
        ];
        $form['actions']['#type']='actions';

        $form['actions']['submit']=[
            '#type'=>'submit',
            '#value'=>$this->t(string: 'Save'),
            '#button_type'=>'primary',
        ];

        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $submitted_values=$form_state->cleanValues()->getValues();
        $country= $submitted_values['country'];
        $city= $submitted_values['city'];
        $postal_code= $submitted_values['postal_code'];
        $location_service = \Drupal::service('location_finder.location_finder_services');    
        $locations= $location_service->locationFinderAPICall($country,$city,$postal_code);
        var_dump($locations);
        die($locations);
    } 
}
