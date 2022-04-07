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

    public function getAllForBabyRegistries() {
        $stmt = self::$_connection->prepare("SELECT * FROM cart where baby_reg_flag = :baby_reg_flag AND status = :status LIMIT 1");
        $stmt->execute(['baby_reg_flag'=>'1',
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
		return $stmt->fetch();
    }

    public function getExistingBabyRegProducts($baby_reg_id){
        $stmt = self::$_connection->prepare("SELECT * FROM cart where baby_reg_flag = :baby_reg_flag AND baby_reg_id = :baby_reg_id AND status = :status LIMIT 1");
        $stmt->execute(['baby_reg_flag'=>'1',
                        'baby_reg_id'=>$baby_reg_id,
                        'status'=>'0']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
		return $stmt->fetch();
    }


    public function find($cart_id){
        $stmt = self::$_connection->prepare("SELECT * FROM cart WHERE cart_id = :cart_id");
        $stmt->execute(['cart_id'=>$cart_id]);
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

    public function findByProductIdByUserIdByRegId($product_id, $user_id, $baby_reg_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM cart WHERE product_id = :product_id AND user_id =:user_id AND status = :status AND baby_reg_id = :baby_reg_id");
        $stmt->execute(['product_id'=>$product_id,
                        'user_id'=>$user_id,
                        'baby_reg_id'=>$baby_reg_id,
                        'status'=>'0']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO cart(product_id, color, size, quantity, price, user_id) VALUES(:product_id, :color, :size, :quantity, :price, :user_id)");
        $stmt->execute(['product_id'=>$this->product_id,
                        'color'=>$this->color,
                        'size'=>$this->size,
                        'quantity'=>$this->quantity,
                        'price'=>$this->price,
                        'user_id'=>$this->user_id]);
        $_SESSION['cart_last_id'] = self::$_connection->lastInsertId();
    }

    public function insertForBabyRegistry(){
	    $stmt = self::$_connection->prepare("INSERT INTO cart(product_id, color, size, quantity, price, user_id, baby_reg_flag, baby_reg_id) 
                                            VALUES(:product_id, :color, :size, :quantity, :price, :user_id, :baby_reg_flag, :baby_reg_id)");
        $stmt->execute(['product_id'=>$this->product_id,
                        'color'=>$this->color,
                        'size'=>$this->size,
                        'quantity'=>$this->quantity,
                        'price'=>$this->price,
                        'user_id'=>$this->user_id,
                        'baby_reg_flag'=>$this->baby_reg_flag,
                        'baby_reg_id'=>$this->baby_reg_id]);
        $_SESSION['cart_last_id'] = self::$_connection->lastInsertId();
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id AND status = :status");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'status'=>'0']);
    }

    public function deleteForBabyRegistry(){
        $stmt = self::$_connection->prepare("DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id AND status = :status AND baby_reg_id = :baby_reg_id");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'baby_reg_id'=>$this->baby_reg_id,
                        'status'=>'0']);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE cart SET status = :status WHERE cart_id = :cart_id");
        $stmt->execute(['status'=>$this->status,
                        'cart_id'=>$this->cart_id]);
    }

    public function updateQuantity() {
        $stmt = self::$_connection->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
        $stmt->execute(['quantity'=>$this->quantity,
                        'product_id'=>$this->product_id]);
    }

    public function updateCart() {
        $stmt = self::$_connection->prepare("UPDATE cart SET size = :size, color = :color, quantity = :quantity, price = :price WHERE product_id = :product_id AND user_id = :user_id AND status = :status");
        $stmt->execute(['size'=>$this->size,
                        'color'=>$this->color,
                        'quantity'=>$this->quantity,
                        'price'=>$this->price,
                        'product_id'=>$this->product_id,
                        'user_id'=>$this->user_id,
                        'status'=>'0',]);
    }

}
?>  
