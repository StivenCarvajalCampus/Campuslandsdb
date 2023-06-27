<?php
namespace App;
class regions extends connect{
    private $queryGetAll = 'SELECT regions.*,countries.name_country FROM regions INNER JOIN countries ON regions.id_country = countries.id';
    private $queryPost = 'INSERT INTO regions (id, name_region, id_country) VALUES(:id, :nameregion, :country)';
    private $queryUpdate = 'UPDATE regions SET id_country=:country, name_region=:nameregion WHERE id=:id';
    private $queryDelete = 'DELETE FROM regions WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $name_region, public $id_country){
        parent::__construct();
    }
    public function getAllregions(){
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
        public function postRegions(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("nameregion", $this->name_region);
                $stmt->bindValue("country", $this->id_country);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateRegions(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("nameregion", $this->name_region);
            $stmt->bindValue("country", $this->id_country);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteRegions(){
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