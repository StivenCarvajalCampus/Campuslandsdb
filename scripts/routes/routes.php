<?php
namespace App;
class routes extends connect{
    private $queryGetAll = 'SELECT * FROM routes';
    private $queryPost = 'INSERT INTO routes (id, name_route, start_date, end_date, description, duration_month) VALUES(:id, :nameroute, :startdate, :enddate, :description, :durationmonth)';
    private $queryUpdate = 'UPDATE routes SET name_route=:nameroute, star_date=:startdate, end_date=:enddate, description=:description, duration_month=:durationmonth WHERE id=:id';
    private $queryDelete = 'DELETE FROM routes WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_route, public $start_date, public $end_date, public $description, public $duration_month){
        parent::__construct();
    }
    public function getAllRoutes(){
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
        public function postRoutes(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("nameroute", $this->name_route);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate", $this->end_date);
                $stmt->bindValue("description", $this->description);
                $stmt->bindValue("durationmonth", $this->duration_month);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateRoutes(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("nameroute", $this->name_route);
            $stmt->bindValue("startdate", $this->start_date);
            $stmt->bindValue("enddate", $this->end_date);
            $stmt->bindValue("description", $this->description);
            $stmt->bindValue("durationmonth", $this->duration_month);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteRoutes(){
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