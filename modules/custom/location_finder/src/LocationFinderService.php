<?php
namespace Drupal\location_finder;

class LocationFinderService{
  
    public function locationFinderAPICall($country,$city,$postal_code)
    {
        $endpoint_url = 'https://api-sandbox.dhl.com/location-finder/v1/find-by-address?countryCode='.$country.'&addressLocality='.$city.'&postalCode='.$postal_code;
        $result = \Drupal::httpClient()->get($endpoint_url, [
          'headers' => [
            'DHL-API-Key' => "demo-key",
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
          ],
        ]);
    
        if ($result->getStatusCode() == 200) {
          return $result->getBody();
       }
       else {
            return $this->HandleFailed("Check Access token");
       } 
    }
}
