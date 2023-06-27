<?php
namespace App;
class levels extends connect{
    private $queryGetAll = 'SELECT * FROM levels';
    private $queryPost = 'INSERT INTO levels (id, name_level, group_level) VALUES(:id, :namelevel, :grouplevel)';
    private $queryUpdate = 'UPDATE levels SET name_level=:namelevel, group_level=:grouplevel WHERE id=:id';
    private $queryDelete = 'DELETE FROM levels WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_level, public $group_level){
        parent::__construct();
    }
    public function getAllLevels(){
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
        public function postLevels(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("namelevel", $this->name_level);
                $stmt->bindValue("grouplevel", $this->group_level);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateLevels(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("namelevel", $this->name_level);
            $stmt->bindValue("grouplevel", $this->group_level);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteLevels(){
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