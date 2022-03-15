<?php
class BillingDetails extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM billing_detail");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'BillingDetails');
		return $stmt->fetchAll();
    }

    public function find($brand_id){
        $stmt = self::$_connection->prepare("SELECT * FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$brand_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BillingDetails');
        return $stmt->fetch();
    }

    public function findByCartId($cart_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM billing_detail WHERE cart_id = :cart_id");
        $stmt->execute(['cart_id'=>$cart_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BillingDetails');
        return $stmt->fetch();
    }


    public function findByCartIdByUserId($cart_id, $user_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM billing_detail WHERE cart_id = :cart_id AND user_id =:user_id");
        $stmt->execute(['cart_id'=>$cart_id,
                        'user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'BillingDetails');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO billing_detail(order_id, first_name, last_name, address, city, province, postal_code, country, phone, email, user_id) VALUES(:order_id, :first_name, :last_name, :address, :city, :province, :postal_code, :country, :phone, :email, :user_id)");
        $stmt->execute(['order_id'=>$this->order_id,
                        'first_name'=>$this->first_name,
                        'last_name'=>$this->last_name,
                        'address'=>$this->address,
                        'city'=>$this->city,
                        'province'=>$this->province,
                        'postal_code'=>$this->postal_code,
                        'country'=>$this->country,
                        'phone'=>$this->phone,
                        'email'=>$this->email,
                        'user_id'=>$this->user_id]);
        $_SESSION['billing_detail_id'] = self::$_connection->lastInsertId();
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$this->brand_id]);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE brand SET brand_name = :brand_name WHERE brand_id = :brand_id");
        $stmt->execute(['brand_name'=>$this->brand_name,
                        'brand_id'=>$this->brand_id]);
    }

}
?>