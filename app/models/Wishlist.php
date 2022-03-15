<?php
class Wishlist extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM wishlist");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Wishlist');
		return $stmt->fetchAll();
    }

    public function getAllActiveForUserId($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM wishlist where user_id = :user_id AND status = :status");
        $stmt->execute(['user_id'=>$user_id,
                        'status'=>'1']);
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Wishlist');
		return $stmt->fetchAll();
    }

    public function find($brand_id){
        $stmt = self::$_connection->prepare("SELECT * FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$brand_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Wishlist');
        return $stmt->fetch();
    }

    public function findByProductIdUserId($product_id, $user_id)
    {
        $stmt = self::$_connection->prepare("SELECT * FROM wishlist WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute(['product_id'=>$product_id, 
                        'user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Wishlist');
        return $stmt->fetch();
    }

    public function isInWishList($product_id, $user_id)
    {
        $stmt = self::$_connection->prepare("SELECT status FROM wishlist WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute(['product_id'=>$product_id, 
                        'user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Wishlist');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO wishlist(product_id, user_id) VALUES(:product_id, :user_id)");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM wishlist WHERE product_id = :product_id AND user_id = :user_id");
        $stmt->execute(['product_id'=>$this->product_id,
                        'user_id'=>$this->user_id]);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE brand SET brand_name = :brand_name WHERE brand_id = :brand_id");
        $stmt->execute(['brand_name'=>$this->brand_name,
                        'brand_id'=>$this->brand_id]);
    }

}
?>