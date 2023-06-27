<?php
namespace App;
class modules extends connect{
    private $queryGetAll = 'SELECT modules.*,themes.name_theme FROM modules INNER JOIN themes ON modules.id_theme = themes.id ';
    private $queryPost = 'INSERT INTO modules (id, name_module,start_date,end_date,description, duration_days, id_theme) VALUES(:id, :module, :startdate, :enddate, :description, :durationdays, :theme)';
    private $queryUpdate = 'UPDATE modules  SET  name_module=:module, start_date=:startdate, end_date=:enddate,description=:description,duration_days=:durationdays,id_theme=:theme, WHERE id=:id';
    private $queryDelete = 'DELETE FROM modules WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_module, public $start_date, public $end_date, public $description, public $duration_days, public $id_theme){
        parent::__construct();
    }
    public function getAllModules(){
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
        public function postModules(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("module", $this->name_module);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);
                $stmt->bindValue("theme", $this->id_theme);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateModules(){
            try {
                $stmt=$this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("theme", $this->name_module);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);
                $stmt->bindValue("theme", $this->id_theme);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteModules(){
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