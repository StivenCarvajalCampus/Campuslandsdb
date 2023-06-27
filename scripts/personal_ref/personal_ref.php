<?php
namespace App;
class personal_ref extends connect{
    private $queryGetAll = 'SELECT * FROM personal_ref';
    private $queryPost = 'INSERT INTO personal_ref (id, full_name, cel_number,relationship,occupation) VALUES(:id, :name, :telefono, :relationship, :ocupation)';
    private $queryUpdate = 'UPDATE personal_ref SET full_name=:name, cel_number=:telefono, relationship=:relationship, occupation=:ocupation WHERE id=:id';
    private $queryDelete = 'DELETE FROM personal_ref WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $full_name, public $cel_number, public $relationship, public $occupation){
        parent::__construct();
    }
    public function getAllpersonalreference(){
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
        public function postPersonalreference(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("name", $this->full_name);
                $stmt->bindValue("telefono", $this->cel_number);
                $stmt->bindValue("relationship", $this->relationship);
                $stmt->bindValue("ocupation",$this->occupation);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updatePersonalreference(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("name", $this->full_name);
            $stmt->bindValue("telefono", $this->cel_number);
            $stmt->bindValue("relationship", $this->relationship);
            $stmt->bindValue("ocupation",$this->occupation);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deletePersonalreference(){
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