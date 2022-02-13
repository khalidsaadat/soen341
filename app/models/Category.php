<?php
class Category extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM category");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
		return $stmt->fetchAll();
    }

    public function findByCategory($category_id){
        $stmt = self::$_connection->prepare("SELECT * FROM category WHERE category_id = :category_id");
        $stmt->execute(['category_id'=>$category_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO category(category_name) VALUES(:category_name)");
        $stmt->execute(['category_name'=>$this->category_name]);
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM category WHERE category_id = :category_id");
        $stmt->execute(['category_id'=>$this->category_id]);
    }

    public function updateStatus(){
        $stmt = self::$_connection->prepare("UPDATE category SET category_name = :category_name WHERE category_id = :category_id");
        $stmt->execute(['category_name'=>$this->category_name,
                        'category_id'=>$this->category_id]);
    }

}
?>