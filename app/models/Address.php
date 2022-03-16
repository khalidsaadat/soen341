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

    public function find($address_id){
        $stmt = self::$_connection->prepare("SELECT * FROM address WHERE address_id = :address_id");
        $stmt->execute(['address_id'=>$address_id]);
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
	    $stmt = self::$_connection->prepare("INSERT INTO address(street, city, province, postal_code, country, status) VALUES(:street, :city, :province, :postal_code, :country, :status)");
        $stmt->execute(['street'=>$this->street,
                        'city'=>$this->city,
                        'province'=>$this->province,
                        'country'=>$this->country,
                        'status'=>$this->status]);
    }

    public function update(){
        $stmt = self::$_connection->prepare("UPDATE address SET full_name = :full_name, email = :email, phone_number = :phone_number WHERE address_id = :address_id");
        $stmt->execute(['full_name'=>$this->full_name,
                        'email'=>$this->email, 
                        'phone_number'=>$this->phone_number, 
                        'address'=>$this->address, 
                        'address_id'=>$this->address_id]);
    }

    public function updateAddress() {
        $stmt = self::$_connection->prepare("UPDATE address SET address = :address WHERE address_id = :address_id");
        $stmt->execute(['address'=>$this->address, 
                        'address_id'=>$this->address_id]);
    }

}
?>