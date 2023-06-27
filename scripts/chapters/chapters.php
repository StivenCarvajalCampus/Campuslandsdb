<?php
namespace App;
class chapters extends connect{
    private $queryGetAll = 'SELECT chapters.*,thematic_units.name_thematics_units FROM chapters INNER JOIN thematic_units ON chapters.id_thematic_units = thematic_units.id ';
    private $queryPost = 'INSERT INTO chapters (id, id_thematic_units, name_chapter,start_date,end_date,description, duration_days) VALUES(:id, :thematics, :chapter, :startdate, :enddate, :description, :durationdays)';
    private $queryUpdate = 'UPDATE chapters  SET id_thematic_units=:thematics, name_chapter=:chapter, start_date=:startdate, end_date=:enddate,description=:description,duration_days=:durationdays, WHERE id=:id';
    private $queryDelete = 'DELETE FROM chapters WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $id_thematic_units, public $name_chapter, public $start_date, public $end_date, public $description, public $duration_days){
        parent::__construct();
    }
    public function getAllChapters(){
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
        public function postChapters(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("thematics", $this->id_thematic_units);
                $stmt->bindValue("chapter", $this->name_chapter);
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
        public function updateChapters(){
            try {
                $stmt=$this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("thematics", $this->id_thematic_units);
                $stmt->bindValue("chapter", $this->name_chapter);
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
            public function deleteChapters(){
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