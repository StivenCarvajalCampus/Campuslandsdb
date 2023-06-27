<?php
namespace App;
class countries extends connect{
    private $queryGetAll = 'SELECT * FROM countries';
    private $queryPost = 'INSERT INTO countries (id, name_country) VALUES(:id, :country)';
    private $queryUpdate = 'UPDATE countries SET name_country=:country WHERE id=:id';
    private $queryDelete = 'DELETE FROM countries WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_country){
        parent::__construct();
    }
    public function getAllCountries(){
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
        public function postCountries(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("country", $this->name_country);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateCountries(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("country", $this->name_country);
            $stmt->bindValue("id", $this->id);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteCountries(){
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