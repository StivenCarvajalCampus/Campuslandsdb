<?php
namespace App;
    abstract class credentials{
        //credentials for DB CAMPUS
         protected $host = 'localhost';
         private $user = 'root';
         private $password = '';
         protected $dbname = 'campuslands';
        
         public function __get($name){
            return $this->{$name};
        }
    }
?> 