<?php
namespace App;
class working_info extends connect{
    private $queryGetAll = 'SELECT working_info.*,staff.first_name,staff.first_surname,work_reference.full_name,personal_ref.full_name FROM working_info INNER JOIN staff ON working_info.id_staff = staff.id INNER JOIN work_reference ON working_info.id_work_reference = work_reference.id INNER JOIN personal_ref ON working_info.id_personal_ref = personal_ref.id';
    private $queryPost = 'INSERT INTO working_info (id, id_staff, years_exp,months_exp,id_work_reference,id_personal_ref, start_contract, end_contract) VALUES(:id, :staff, :experiencia, :mesexp, :workref, :personalref, :start_contract, :end_contract)';
    private $queryUpdate = 'UPDATE working_info  SET id_staff=:staff, years_exp=:experiencia, months_exp=:mesexp, id_work_reference=:workref,id_personal_ref=:personalref,start_contract=:start_contract, end_contract=:end_contract WHERE id=:id';
    private $queryDelete = 'DELETE FROM working_info WHERE id = :id';
    private $message;
    use getInstance;
    function __construct(private $id, public $id_staff, public $years_exp, public $months_exp, public $id_work_reference, public $id_personal_ref, public $start_contract, public $end_contract){
        parent::__construct();
    }
    public function getAllworkinginfo(){
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
        public function postworkinginfo(){
            try {
                $stmt=$this->conex->prepare($this->queryPost);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("staff", $this->id_staff);
                $stmt->bindValue("experiencia", $this->years_exp);
                $stmt->bindValue("mesexp", $this->months_exp);
                $stmt->bindValue("workref",$this->id_work_reference);
                $stmt->bindValue("personalref",$this->id_personal_ref);
                $stmt->bindValue("start_contract",$this->start_contract);
                $stmt->bindValue("end_contract",$this->end_contract);
                $stmt->execute();
                $this->message = ["Code"=>200+$stmt->rowCount(),"Message"=>"insert data"];


            } catch(\PDOException $e){
                $this->message = ["Code"=>$e->getCode(),"Message"=>$stmt->errorInfo()[2]];
            }finally{
                print_r($this->message);
        
        
            }
        }
        public function updateworkinginfo(){
            try {
                $stmt=$this->conex->prepare($this->queryUpdate);
                $stmt->bindValue("id", $this->id);
                $stmt->bindValue("staff", $this->id_staff);
                $stmt->bindValue("experiencia", $this->years_exp);
                $stmt->bindValue("mesexp", $this->months_exp);
                $stmt->bindValue("workref",$this->id_work_reference);
                $stmt->bindValue("personalref",$this->id_personal_ref);
                $stmt->bindValue("start_contract",$this->start_contract);
                $stmt->bindValue("end_contract",$this->end_contract);
            $stmt= $stmt->execute();
            $this->message = ["Code"=>200, "Message"=>"update data"];
            }catch(\PDOException $e) {
                    $this->message = ["Code"=> $e->getCode(), "Message"=> $stmt->errorInfo()[2]];
                }finally{
                    print_r($this->message);
                }
            }
            public function deleteworkinginfo(){
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