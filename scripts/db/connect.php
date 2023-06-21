<?php
interface enviroments{
    public function __get($name);
}
abstract class connect extends credentials implements environments{
    protected $conex;
    function __construct(private $driver = "mysql",private $port = 3306){
        try {
            $this->conex = new PDO($this->driver.":host=".$this->__get('host').";port=".$this->port.";dbname".$this->__get('dbname').";user=".$this->user.";password=".$this->password);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
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
