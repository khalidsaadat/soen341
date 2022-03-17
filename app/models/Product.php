<?php
class Product extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
      $stmt = self::$_connection->prepare("SELECT * FROM product");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function getAllActive()
    {
      $stmt = self::$_connection->prepare("SELECT * FROM product where status = :status" );
      $stmt->execute(['status'=>'1']);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function getSearchResult($query)
    {
      $stmt = self::$_connection->prepare("SELECT * FROM product WHERE name COLLATE UTF8_GENERAL_CI LIKE :query");
      $stmt->execute(['query'=>'%' . $query . '%']);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function find($product_id){
        $stmt = self::$_connection->prepare("SELECT * FROM product WHERE product_id = :product_id");
        $stmt->execute(['product_id'=>$product_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
        return $stmt->fetch();
    }


    // get all the colors of each product from the product table
    public function getAllColors() {
        $stmt = self::$_connection->prepare("SELECT colors FROM product");
        $stmt->execute();
    	  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
		  return $stmt->fetchAll();
    }

    public function getAllSizes() {
      $stmt = self::$_connection->prepare("SELECT size FROM product");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }
  
    public function getAllPromotions() {
      $stmt = self::$_connection->prepare("SELECT * FROM product where promotion = :promotion");
      $stmt->execute(['promotion'=>'1']);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }
  
    public function getAllKeywords() {
      $stmt = self::$_connection->prepare("SELECT keywords FROM product");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }
  
    public function getAllBasicInfo() {
      $stmt = self::$_connection->prepare("SELECT product_id, name, price, colors FROM product ORDER BY date DESC");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function getAllPrice() {
      $stmt = self::$_connection->prepare("SELECT price FROM product");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function getAllNewProducts() {
      $stmt = self::$_connection->prepare("SELECT * FROM product where date BETWEEN DATE_SUB(NOW(), INTERVAL 40 DAY) AND NOW()");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
      return $stmt->fetchAll();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO product(name, brand_id, categories, price, quantity_available, size, colors, keywords, reward_point, promotion, images, description) 
                                            VALUES(:name, :brand_id, :categories, :price, :quantity_available, :size, :colors, :keywords, :reward_point, :promotion, :images, :description)");
        $stmt->execute(['name'=>$this->name, 
                        'brand_id'=>$this->brand_id,
                        'categories'=>$this->categories,
                        'price'=>$this->price,
                        'quantity_available'=>$this->quantity_available,
                        'size'=>$this->size,
                        'colors'=>$this->colors,
                        'keywords'=>$this->keywords,
                        'reward_point'=>$this->reward_point,
                        'promotion'=>$this->promotion,
                        'images'=>$this->images,
                        'description'=>$this->description]);
    }


    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE product SET status = :status WHERE product_id = :product_id");
        $stmt->execute(['status'=>$this->status,
                        'product_id'=>$this->product_id]);
    }

}
?>