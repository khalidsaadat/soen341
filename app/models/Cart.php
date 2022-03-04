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

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO cart(product_id, quantity, user_id) VALUES(:product_id, :quantity, :user_id)");
        $stmt->execute(['product_id'=>$this->product_id,
                        'quantity'=>$this->quantity,
                        'user_id'=>$this->user_id]);
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