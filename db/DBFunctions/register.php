<?php
function register($username, $password){
	//from dbconnection.php
	$stmt = getDB()->prepare("INSERT INTO Users (email, password) VALUES (:e, :p)");
	$hash = password_hash($password, PASSWORD_BCRYPT);
	$result = $stmt->execute([":e"=>$username, ":p"=>$hash]);
	//TODO do proper checking, maybe user doesn't exist
	if(!empty($result)){
		return array("status"=>400, "message"=>"User already exists, choose different credentials");
	if($result){
		return array("status"=>200, "message"=>"You've registered, greetings");
	}
	else{
		//must return a proper message so that the app can parse it
		//and display a user friendly message to the user
		return array("status"=>400, "message"=>"Try again");
	}
}
?>
