<?php
namespace App;
class thematic_units extends connect{
    private $queryGetAll = 'SELECT thematic_units.*,routes.name_route FROM thematic_units INNER JOIN routes ON thematic_units.id_route = routes.id ';
    private $queryPost = 'INSERT INTO thematic_units (id, id_route, name_thematics_units,start_date,end_date,description, duration_days) VALUES(:id, :route, :thematics, :startdate, :enddate, :description, :durationdays)';
    private $queryUpdate = 'UPDATE thematic_units  SET id_route=:route, name_thematics_units=:thematics, start_date=:startdate, end_date=:enddate,description=:description,duration_days=:durationdays, WHERE id=:id';
    private $queryDelete = 'DELETE FROM thematic_units WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $id_route, public $name_thematics_units, public $start_date, public $end_date, public $description, public $duration_days){
        parent::__construct();
    }
    public function getAllThematic_units(){
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
        public function postThematic_units(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("route", $this->id_route);
                $stmt->bindValue("thematics", $this->name_thematics_units);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateThematic_units(){
            try {
                $stmt=$this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("route", $this->id_route);
                $stmt->bindValue("thematics", $this->name_thematics_units);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteThematic_units(){
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