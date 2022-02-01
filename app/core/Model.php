<?php
// FOR THIS SAMPLE PROJECT, DO NOT MODIFY
class Model{
	protected static $_connection;
	
	public function __construct()
    {	
        $server = 'localhost';
        $DBName = 'soen341';
        $user = 'root';
        $pass = '';
    
        self::$_connection = new PDO("mysql:host=$server;dbname=$DBName;charset=utf8", $user, $pass);
        self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
?>
