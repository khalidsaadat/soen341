<?php
class BabyRegistry extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistry');
		return $stmt->fetchAll();
    }

    public function find($baby_registry_id){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry WHERE baby_registry_id = :baby_registry_id");
        $stmt->execute(['baby_registry_id'=>$baby_registry_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistry');
        return $stmt->fetch();
    }

    public function findByName($name) {
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry WHERE name = :name");
        $stmt->execute(['name'=>$name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistry');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO baby_registry(name ,delivery_date, organizer_name, address_id, description) VALUES(:name, :delivery_date, :organizer_name, :address_id, :description)");
        $stmt->execute(['name'=>$this->name,
                        'delivery_date'=>$this->delivery_date,
                        'organizer_name'=>$this->organizer_name,
                        'address_id'=>$this->address_id,
                        'description'=>$this->description]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM BabyRegistry WHERE baby_registry_id = :baby_registry_id");
        $stmt->execute(['baby_registry_id'=>$this->baby_registry_id]);
    }

    public function update(){
        $stmt = self::$_connection->prepare("UPDATE user SET username = :username, password = :password, role = :role WHERE user_id = :user_id");
        $stmt->execute(['username'=>$this->username,
                        'password'=>$this->password, 
                        'role'=>$this->role, 
                        'user_id'=>$this->user_id]);
    }

}
?>