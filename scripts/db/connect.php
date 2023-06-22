<?php
require_once "credentials.php";

interface enviroments{
    public function __get($name);
}
class connect extends credentials implements enviroments{
    protected $conex;
    function __construct(private $driver = "mysql",private $port = 3306){
        try {
            $this->conex = new PDO($this->driver.":host=".$this->__get('host').";port=".$this->port.";dbname=".$this->__get('dbname').";user=".$this->user.";password=".$this->password);
            $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "ok";
        } catch (\PDOException $e) {
            print_r($e->getMessage());
            $this->conex = $e->getMessage();
        }
       // print_r($this->driver.":host=".$this->__get('host').";port=".$this->port.";dbname=".$this->__get('dbname').";user=".$this->user.";password=".$this->password);
    }
    
}

$obj = new connect();
/*SELECT*FROM subjects;
INSERT INTO name_subject VALUES (StivenCarvajal);
INSERT INTO subjects VALUES(StivenCarvajal);
SELECT * FROM `subjects`
SELECT * FROM `subjects`
Expandir Editar Falló la consulta
INSERT INTO subjects (name_subject) VALUES(StivenCarvajal);
SELECT * FROM `subjects`
INSERT INTO subjects(name_subject) VALUES("StivenCarvajal");
SELECT * FROM `subjects`;
INSERT INTO subjects(name_subject) VALUES("Edgar Mantilla");
SELECT * FROM subjects;
DELETE FROM subjects WHERE name_subject=Edgar;
DELETE FROM subjects WHERE name_subject= ("Edgar");
SELECT * FROM subjects;
DELETE FROM subjects WHERE name_subject="Edgar";
SELECT * FROM subjects;
*/
?>
