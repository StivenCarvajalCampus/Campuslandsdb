<?php
namespace App;
class position extends connect{
    private $queryGetAll = 'SELECT * FROM position';
    private $queryPost = 'INSERT INTO position (id, name_position, arl) VALUES(:id, :nameposition, :arl)';
    private $queryUpdate = 'UPDATE position SET name_position=:nameposition, arl=:arl WHERE id=:id';
    private $queryDelete = 'DELETE FROM position WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_position, public $arl){
        parent::__construct();
    }
    public function getAllPosition(){
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
        public function postPosition(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("nameposition", $this->name_position);
                $stmt->bindValue("arl", $this->arl);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updatPosition(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("nameposition", $this->name_position);
                $stmt->bindValue("arl", $this->arl);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deletePosition(){
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