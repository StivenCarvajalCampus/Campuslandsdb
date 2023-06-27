<?php
namespace App;
class themes extends connect{
    private $queryGetAll = 'SELECT themes.*,chapters.name_chapter FROM themes INNER JOIN chapters ON themes.id_chapter = chapters.id ';
    private $queryPost = 'INSERT INTO themes (id, id_chapter, name_theme,start_date,end_date,description, duration_days) VALUES(:id, :chapter, :theme, :startdate, :enddate, :description, :durationdays)';
    private $queryUpdate = 'UPDATE themes  SET id_chapter=:chapter, name_theme=:theme, start_date=:startdate, end_date=:enddate,description=:description,duration_days=:durationdays, WHERE id=:id';
    private $queryDelete = 'DELETE FROM themes WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $id_chapter, public $name_theme, public $start_date, public $end_date, public $description, public $duration_days){
        parent::__construct();
    }
    public function getAllThemes(){
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
        public function postThemes(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("chapter", $this->id_chapter);
                $stmt->bindValue("theme", $this->name_theme);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateThemes(){
            try {
                $stmt=$this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("chapter", $this->id_chapter);
                $stmt->bindValue("theme", $this->name_theme);
                $stmt->bindValue("startdate", $this->start_date);
                $stmt->bindValue("enddate",$this->end_date);
                $stmt->bindValue("description",$this->description);
                $stmt->bindValue("durationdays",$this->duration_days);;
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteThemes(){
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