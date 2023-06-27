<?php
namespace App;
class work_reference extends connect{
    private $queryGetAll = 'SELECT * FROM work_reference';
    private $queryPost = 'INSERT INTO work_reference (id, full_name, cel_number,position,company) VALUES(:id, :name, :telefono, :position, :company)';
    private $queryUpdate = 'UPDATE work_reference SET full_name=:name, cel_number=:telefono, position=:position, company=:company WHERE id=:id';
    private $queryDelete = 'DELETE FROM work_reference WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $full_name, public $cel_number, public $position, public $company){
        parent::__construct();
    }
    public function getAllworkreference(){
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
        public function postWorkreference(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("name", $this->full_name);
                $stmt->bindValue("telefono", $this->cel_number);
                $stmt->bindValue("position", $this->position);
                $stmt->bindValue("company",$this->company);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateWorkreference(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("name", $this->full_name);
            $stmt->bindValue("telefono", $this->cel_number);
            $stmt->bindValue("position", $this->position);
            $stmt->bindValue("company",$this->company);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteWorkreference(){
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