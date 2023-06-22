<?php
    abstract class credentials{
        //credentials for DB CAMPUS
         protected $host = '172.16.48.204';
         private $user = 'sputnik';
         private $password = 'Sp3tn1kC@';
         protected $dbname = 'campusland';
        
         public function __get($name){
            return $this->{$name};
        }
    }
?> 