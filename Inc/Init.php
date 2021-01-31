<?php

namespace Inc;

final  class Init
{


  public static function get_services()
  {
     return [
       Design\dashbord_widget::class
     ];
  }
       public static function register_services()
       {


            foreach (self::get_services() as  $class) {
              // echo  "<pre>".print_r($class)."<pre>";
              $service =  self::instantiate($class);
              if (method_exists($service , 'register')) {
                // code...
                $service->register();
              }
            }
       }

       private static function instantiate($class)
       {
          $service =  new $class();
          return  $service;
       }

}





 ?>
