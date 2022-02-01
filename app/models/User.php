<?php
class User extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

	public function getAll(){
        $stmt = self::$_connection->prepare("SELECT * FROM user");
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetchAll();
    }

    public function find($user_id){
        $stmt = self::$_connection->prepare("SELECT * FROM user WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function findByUsername($username) {
        $stmt = self::$_connection->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username'=>$username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function insert(){
	    $stmt = self::$_connection->prepare("INSERT INTO user(username, password) VALUES(:username, :password)");
        $stmt->execute(['username'=>$this->username,
                        'password'=>$this->password]);
        $_SESSION['lastInsertId_UserId'] = self::$_connection->lastInsertId(); // store the new user's id in a session.
    }

    public function delete(){
        $stmt = self::$_connection->prepare("DELETE FROM user WHERE user_id = :user_id");
        $stmt->execute(['user_id'=>$this->user_id]);
    }

    public function update(){
        $stmt = self::$_connection->prepare("UPDATE user SET username = :username, password = :password WHERE user_id = :user_id");
        $stmt->execute(['username'=>$this->username,
         'password'=>$this->password, 'user_id'=>$this->user_id]);
    }

}
?>