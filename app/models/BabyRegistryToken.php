<?php
class BabyRegistryToken extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry_tokens");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistryToken');
		return $stmt->fetchAll();
    }

    public function find($token_id){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry_tokens WHERE token_id = :token_id");
        $stmt->execute(['token_id'=>$token_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistryToken');
        return $stmt->fetch();
    }

    public function findByBabyRegistryId($baby_registry_id){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry_tokens WHERE baby_registry_id = :baby_registry_id");
        $stmt->execute(['baby_registry_id'=>$baby_registry_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistryToken');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO baby_registry_tokens(baby_registry_id, token, status) VALUES(:baby_registry_id, :token, :status)");
        $stmt->execute(['baby_registry_id'=>$this->baby_registry_id,
                        'token'=>$this->token,
                        'status'=>$this->status]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM baby_registry_tokens WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$this->brand_id]);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE baby_registry_tokens SET brand_name = :brand_name WHERE brand_id = :brand_id");
        $stmt->execute(['brand_name'=>$this->brand_name,
                        'brand_id'=>$this->brand_id]);
    }

}
?>