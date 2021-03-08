<?php
function getDB(){
	global $db;
	if(!isset($db)){
		//DO NOT COMMIT PRIVATE CREDENTIALS TO A REPOSITORY EVER
		require_once(__DIR__. '/../lib/config.php');
		$conn_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";//TODO should pull from config or env variables
		$db = new PDO($conn_string, $dbuser, $dbpass);
	}
	return $db;
}
?>
