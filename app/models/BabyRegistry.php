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

    public function getAllByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM baby_registry WHERE user_id = :user_id ORDER BY delivery_date DESC");
        $stmt->execute(['user_id'=>$user_id]);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'BabyRegistry');
		return $stmt->fetchAll();
    }

    public function findByProductId($product_id, $baby_registry_id)
    {
      $stmt = self::$_connection->prepare("SELECT * FROM baby_registry WHERE product_ids COLLATE UTF8_GENERAL_CI LIKE :product_id AND baby_registry_id = :baby_registry_id");
      $stmt->execute(['product_id'=>'%' . $product_id . '%',
                      'baby_registry_id'=>$baby_registry_id]);
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
	    $stmt = self::$_connection->prepare("INSERT INTO baby_registry(user_id, product_ids, name ,delivery_date, organizer_name, address_id, description) VALUES(:user_id, :product_ids, :name, :delivery_date, :organizer_name, :address_id, :description)");
        $stmt->execute(['user_id'=>$this->user_id,
                        'product_id'=>$this->product_ids,
                        'name'=>$this->name,
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

    public function updateProductIds(){
        $stmt = self::$_connection->prepare("UPDATE baby_registry SET product_ids = :product_ids WHERE baby_registry_id = :baby_registry_id");
        $stmt->execute(['product_ids'=>$this->product_ids,
                        'baby_registry_id'=>$this->baby_registry_id]);
    }

}
?>