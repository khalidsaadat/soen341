<?php
class Order extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM my_order");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
		return $stmt->fetchAll();
    }

    public function getAllByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM my_order where user_id = :user_id ORDER BY order_date desc");
        $stmt->execute(['user_id'=>$user_id]);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
		return $stmt->fetchAll();
    }

    public function find($order_id){
        $stmt = self::$_connection->prepare("SELECT * FROM my_order WHERE order_id = :order_id");
        $stmt->execute(['order_id'=>$order_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        return $stmt->fetch();
    }

    public function findByBillingId($billing_detail_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM my_order WHERE billing_detail_id = :billing_detail_id");
        $stmt->execute(['billing_detail_id'=>$billing_detail_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
        return $stmt->fetch();
    }


    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO my_order(user_id, cart_ids, address_id, order_number, delivery_date, total,  status) VALUES(:user_id, :cart_ids, :address_id, :order_number, :delivery_date, :total, :status)");
        $stmt->execute(['cart_ids'=>$this->cart_ids,
                        'user_id'=>$this->user_id,
                        'address_id'=>$this->address_id,
                        'order_number'=>$this->order_number,
                        'total'=>$this->total,
                        'delivery_date'=>$this->delivery_date,
                        'status'=>$this->status]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id AND status = :status");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'status'=>'0']);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE my_order SET status = :status WHERE order_id = :order_id");
        $stmt->execute(['status'=>$this->status,
                        'order_id'=>$this->order_id]);
    }


}
?>  