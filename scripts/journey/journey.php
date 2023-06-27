<?php
namespace App;
class journey extends connect{
    private $queryGetAll = 'SELECT * FROM journey';
    private $queryPost = 'INSERT INTO journey (id, name_journey, check_in, check_out) VALUES(:id, :namejourney, :checkin, :checkout)';
    private $queryUpdate = 'UPDATE journey SET name_journey=:namejourney, check_in=:checkin, check_out=:checkout WHERE id=:id';
    private $queryDelete = 'DELETE FROM journey WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_journey, public $check_in, public $check_out){
        parent::__construct();
    }
    public function getAllJourney(){
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
        public function postJourney(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("namejourney", $this->name_journey);
                $stmt->bindValue("checkin", $this->check_in);
                $stmt->bindValue("checkout", $this->check_out);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateJourney(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("namejourney", $this->name_journey);
            $stmt->bindValue("checkin", $this->check_in);
            $stmt->bindValue("checkout", $this->check_out);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteJourney(){
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