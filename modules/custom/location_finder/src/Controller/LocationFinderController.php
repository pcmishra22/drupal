<?php
namespace Drupal\location_finder\Controller;
use Drupal\Core\Controller\ControllerBase;

class LocationFinderController extends ControllerBase{
  public function view() {
    $locations=$this->listLocations();
    $content=[];
    $content['name']= $locations;
    return [
      '#theme' => 'location-listing',
      '#content' => $content
    ];
  }
  public function listLocations() {
   
    $location_search_api_connector_service=\Drupal::service('location_finder.location_finder_services');
    $service = \Drupal::service('content_api.test');    
    $location_list= $location_search_api_connector_service->locationFinder();
    if(!empty($location_list->results))
    {
      return $location_list->results;
    }
    return [];
  }
}