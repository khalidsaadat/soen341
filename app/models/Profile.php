<?php
class Profile extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM profile");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
		return $stmt->fetchAll();
    }

    public function find($profile_id){
        $stmt = self::$_connection->prepare("SELECT * FROM profile WHERE profile_id = :profile_id");
        $stmt->execute(['profile_id'=>$profile_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetch();
    }

    public function findByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM profile WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetch();
    }    

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO profile(user_id, full_name, email, phone_number) VALUES(:user_id, :full_name, :email, :phone_number)");
        $stmt->execute(['user_id'=>$this->user_id,
                        'full_name'=>$this->full_name,
                        'email'=>$this->email,
                        'phone_number'=>$this->phone_number]);
    }

    public function update(){
        $stmt = self::$_connection->prepare("UPDATE profile SET full_name = :full_name, email = :email, phone_number = :phone_number, address = :address WHERE profile_id = :profile_id");
        $stmt->execute(['full_name'=>$this->full_name,
                        'email'=>$this->email, 
                        'phone_number'=>$this->phone_number, 
                        'address'=>$this->address, 
                        'profile_id'=>$this->profile_id]);
    }

}
?>