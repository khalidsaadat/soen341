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
        $stmt = self::$_connection->prepare("SELECT * FROM cart where user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
		return $stmt->fetchAll();
    }

    public function find($brand_id){
        $stmt = self::$_connection->prepare("SELECT * FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$brand_id]);
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
	    $stmt = self::$_connection->prepare("INSERT INTO my_order(cart_ids, billing_detail_id, order_number, status) VALUES(:cart_ids, :billing_detail_id, :order_number, :status)");
        $stmt->execute(['cart_ids'=>$this->cart_ids,
                        'billing_detail_id'=>$this->billing_detail_id,
                        'order_number'=>$this->order_number,
                        'status'=>$this->status]);
        $_SESSION['last_order'] = self::$_connection->lastInsertId();
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id AND status = :status");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'status'=>'0']);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE brand SET brand_name = :brand_name WHERE brand_id = :brand_id");
        $stmt->execute(['brand_name'=>$this->brand_name,
                        'brand_id'=>$this->brand_id]);
    }

    public function updateQuantity() {
        $stmt = self::$_connection->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
        $stmt->execute(['quantity'=>$this->quantity,
                        'product_id'=>$this->product_id]);
    }

    public function updateCart() {
        $stmt = self::$_connection->prepare("UPDATE cart SET size = :size, color = :color, quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id AND status = :status");
        $stmt->execute(['size'=>$this->size,
                        'color'=>$this->color,
                        'quantity'=>$this->quantity,
                        'product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'status'=>'0',]);
    }

}
?>  