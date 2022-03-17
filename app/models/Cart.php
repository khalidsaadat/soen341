<?php
class Cart extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM cart");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
		return $stmt->fetchAll();
    }

    public function getAllByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM cart where user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
		return $stmt->fetchAll();
    }

    public function getAllIdsByUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT cart_id FROM cart where user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
		return $stmt->fetchAll();
    }


    public function find($brand_id){
        $stmt = self::$_connection->prepare("SELECT * FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$brand_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        return $stmt->fetch();
    }

    public function findByProductId($product_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM cart WHERE product_id = :product_id");
        $stmt->execute(['product_id'=>$product_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        return $stmt->fetch();
    }

    public function findByProductIdByUserId($product_id, $user_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM cart WHERE product_id = :product_id AND user_id =:user_id AND status = :status");
        $stmt->execute(['product_id'=>$product_id,
                        'user_id'=>$user_id,
                        'status'=>'0']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO cart(product_id, color, size, quantity, user_id) VALUES(:product_id, :color, :size, :quantity, :user_id)");
        $stmt->execute(['product_id'=>$this->product_id,
                        'color'=>$this->color,
                        'size'=>$this->size,
                        'quantity'=>$this->quantity,
                        'user_id'=>$this->user_id]);
        $_SESSION['cart_last_id'] = self::$_connection->lastInsertId();
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
