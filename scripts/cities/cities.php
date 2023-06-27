<?php
namespace App;
class cities extends connect{
    private $queryGetAll = 'SELECT cities.*,regions.name_region FROM cities INNER JOIN regions ON cities.id_region = regions.id';
    private $queryPost = 'INSERT INTO cities (id, name_city, id_region) VALUES(:id, :namecity, :region)';
    private $queryUpdate = 'UPDATE cities SET id_region=:region, name_city=:namecity WHERE id=:id';
    private $queryDelete = 'DELETE FROM regions WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_city, public $id_region){
        parent::__construct();
    }
    public function getAllCities(){
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
        public function postCities(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("namecity", $this->name_city);
                $stmt->bindValue("region", $this->id_region);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateCities(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("namecity", $this->name_city);
            $stmt->bindValue("region", $this->id_region);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteCities(){
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