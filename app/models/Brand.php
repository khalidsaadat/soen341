<?php
class Brand extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM brand");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
		return $stmt->fetchAll();
    }

    public function findByBrand($brand_id){
        $stmt = self::$_connection->prepare("SELECT * FROM brand WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id'=>$brand_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO brand(brand_name) VALUES(:brand_name)");
        $stmt->execute(['brand_name'=>$this->brand_name]);
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