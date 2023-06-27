<?php
namespace App;
class staff extends connect{
    private $queryGetAll = 'SELECT staff.*,areas.name_area, cities.name_city FROM staff INNER JOIN areas ON staff.id_area=areas.id INNER JOIN cities ON staff.id_city=cities.id';
    private $queryPost = 'INSERT INTO staff (id,doc, first_name, second_name,first_surname,second_surname, eps, id_area, id_city) VALUES(:id, :doc, :firstname, :secondname, :firstsurname, :secondsurname, :eps, :idarea, :idcity)';
    private $queryUpdate = 'UPDATE staff SET first_name=:firstname, second_name=:secondname, first_surname=firstsurname, second_surname=secondsurname, eps=:eps, id_area=:idarea, id_city=:idcity WHERE id=:id';
    private $queryDelete = 'DELETE FROM staff WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id,public $doc, public $first_name, public $second_name,public $first_surname, public $second_surname, public $eps, public $id_area, public $id_city){
        parent::__construct();
    }
    public function getAllStaff(){
        try {
            $stmt = $this->conex->prepare($this->queryGetAll);
            $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>$stmt->fetchAll(\PDO::FETCH_ASSOC)];
        }catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function postStaff(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("doc", $this->doc);
                $stmt->bindValue("firstname", $this->first_name);
                $stmt->bindValue("secondname", $this->second_name);
                $stmt->bindValue("firstsurname", $this->first_surname);
                $stmt->bindValue("secondsurname", $this->second_surname);
                $stmt->bindValue("eps", $this->eps);
                $stmt->bindValue("idarea",$this->id_area);
                $stmt->bindValue("idcity",$this->id_city);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateStaff(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("firstname", $this->first_name);
            $stmt->bindValue("secondname", $this->second_name);
            $stmt->bindValue("firstsurname", $this->first_surname);
            $stmt->bindValue("secondsurname", $this->second_surname);
            $stmt->bindValue("eps", $this->eps);
            $stmt->bindValue("idarea",$this->id_area);
            $stmt->bindValue("idcity",$this->id_city);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteStaff(){
                try {
                    $stmt = $this->conex->prepare($this->queryDelete);
                    $stmt->bindValue('id',$this->id);
                    $stmt->execute(); $this->message = ["Code"=> 200, "Message"=> "delete data "];
        
                } catch (\PDOException $e) {
                    $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }

            }

        }
    

?>