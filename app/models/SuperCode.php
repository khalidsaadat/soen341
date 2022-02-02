<?php
class SuperCode extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM super_code");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'SuperCode');
		return $stmt->fetchAll();
    }

    public function findBySuperCode($super_code){
        $stmt = self::$_connection->prepare("SELECT * FROM super_code WHERE super_code = :super_code");
        $stmt->execute(['super_code'=>$super_code]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'SuperCode');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO super_code(super_code, user_id, status) VALUES(:super_code, :user_id, :status)");
        $stmt->execute(['super_code'=>$this->super_code,
                        'user_id'=>$this->user_id,
                        'status'=>$this->status]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM super_code WHERE super_code_id = :super_code_id");
        $stmt->execute(['super_code_id'=>$this->super_code_id]);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE super_code SET status = :status WHERE super_code = :super_code");
        $stmt->execute(['status'=>$this->status,
                        'super_code'=>$this->super_code]);
    }

    public function updateUserId(){
        $stmt = self::$_connection->prepare("UPDATE super_code SET user_id = :user_id WHERE super_code = :super_code");
        $stmt->execute(['user_id'=>$this->user_id,
                        'super_code'=>$this->super_code]);
    }

}
?>