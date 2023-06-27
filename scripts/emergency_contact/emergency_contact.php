<?php
namespace App;
class emergency_contact extends connect{
    private $queryGetAll = 'SELECT emergency_contact.*,staff.doc FROM emergency_contact INNER JOIN staff ON emergency_contact.id_staff=staff.id ';
    private $queryPost = 'INSERT INTO emergency_contact (id,id_staff, cel_number, relationship,full_name, email) VALUES(:id, :staff, :celnumber, :relationship, :fullname, :email)';
    private $queryUpdate = 'UPDATE emergency_contact SET id_staff=:staff, cel_number=:celnumber, relationship=:relationship, full_name=fullname, email=email WHERE id=:id';
    private $queryDelete = 'DELETE FROM emergency_contact WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id,public $id_staff, public $cel_number, public $relationship,public $full_name, public $email, ){
        parent::__construct();
    }
    public function getAllEmergencycontact(){
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
        public function postEmergencycontact(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("staff", $this->id_staff);
                $stmt->bindValue("celnumber", $this->cel_number);
                $stmt->bindValue("relationship", $this->relationship);
                $stmt->bindValue("fullname", $this->full_name);
                $stmt->bindValue("email", $this->email);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateEmergencycontact(){
            try {
                 
            $stmt= $this->conex->prepare($this->queryUpdate);
            $stmt->bindValue("id", $this->id);
            $stmt->bindValue("staff", $this->id_staff);
            $stmt->bindValue("celnumber", $this->cel_number);
            $stmt->bindValue("relationship", $this->relationship);
            $stmt->bindValue("fullname", $this->full_name);
            $stmt->bindValue("email", $this->email);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteEmergencycontact(){
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