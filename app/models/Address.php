<?php
class Address extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM address");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
		return $stmt->fetchAll();
    }

    public function getBothAddresses($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$user_id]);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
		return $stmt->fetchAll();
    }

    public function getPrimaryAddress($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'1']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
		return $stmt->fetch();
    }

    public function getSecondaryAddress($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
		return $stmt->fetch();
    }

    public function find($address_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE address_id = :address_id");
        $stmt->execute(['address_id'=>$address_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
        return $stmt->fetch();
    }

    public function findPrimary($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'1']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
        return $stmt->fetch();
    }

    public function findSecondary($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'0']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
        return $stmt->fetch();
    }

    public function findByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
        return $stmt->fetch();
    }    

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO address(user_id, street, city, province, postal_code, country, status) VALUES(:user_id, :street, :city, :province, :postal_code, :country, :status)");
        $stmt->execute(['user_id'=>$this->user_id,
                        'street'=>$this->street,
                        'city'=>$this->city,
                        'province'=>$this->province,
                        'postal_code'=>$this->postal_code,
                        'country'=>$this->country,
                        'status'=>$this->status]);
        $_SESSION['updated_address_id'] = self::$_connection->lastInsertId();
    }

    public function update(){
        $stmt = self::$_connection->prepare("UPDATE address SET street = :street, city = :city, province = :province, postal_code = :postal_code, country = :country, status = :status WHERE address_id = :address_id");
        $stmt->execute(['street'=>$this->street,
                        'city'=>$this->city, 
                        'province'=>$this->province, 
                        'postal_code'=>$this->postal_code, 
                        'country'=>$this->country, 
                        'status'=>$this->status, 
                        'address_id'=>$this->address_id]);
    }

    public function updateAddress() {
        $stmt = self::$_connection->prepare("UPDATE address SET address = :address WHERE address_id = :address_id");
        $stmt->execute(['address'=>$this->address, 
                        'address_id'=>$this->address_id]);
    }

    public function makePrimary($address_id) {
        $stmt = self::$_connection->prepare("UPDATE address SET status = :status WHERE address_id = :address_id");
        $stmt->execute(['status'=>'1', 
                        'address_id'=>$address_id]);
    }

    public function makeSecondary($address_id) {
        $stmt = self::$_connection->prepare("UPDATE address SET status = :status WHERE address_id = :address_id");
        $stmt->execute(['status'=>'0', 
                        'address_id'=>$address_id]);
    }

}
?>