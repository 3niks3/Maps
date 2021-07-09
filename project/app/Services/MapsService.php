<?php
namespace App\Services;

class MapsService
{
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

   public function getUnitList()
   {
       $service_url = 'https://mapon.com/api/v1/unit/list.json//';
       $params = [
           'key' =>  $this->key
       ];

       $url = trim($service_url,'/').'?'.http_build_query($params);

       $data = file_get_contents($url);
       return json_decode($data, true);
   }

   public function getRoutes($parameters)
   {
       $service_url = 'https://mapon.com/api/v1/route/list.json//';
       $params = [
           'key' =>  $this->key
       ];

       $params = array_merge($params, $parameters);
       $url = trim($service_url,'/').'?'.http_build_query($params);

       $data = file_get_contents($url);
       return json_decode($data, true);
   }

   public function formatData($data)
   {
       $markers_data = [];
       $pollylines_data = [];

       foreach($data as $route)
       {
           switch(true) {
               case($route['type'] == 'stop'):
                   $markers_data[] = ['lat' => $route['start']['lat'], 'lng' => $route['start']['lng']];
                   break;
               case($route['type'] == 'route'):
                   $pollylines_data[] = ['lat' => $route['start']['lat'], 'lng' => $route['start']['lng']];
                   $pollylines_data[] = ['lat' => $route['end']['lat'], 'lng' => $route['end']['lng']];
                   break;
           }
       }

       return ['markers' => $markers_data, 'pollylines' => $pollylines_data];
   }
}