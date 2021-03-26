<?php
function register($username, $password, $roleid){
	//from dbconnection.php
	$stmt = getDB()->prepare("INSERT INTO Users (email, password, roleid) VALUES (:e, :p, :r");
	$hash = password_hash($password, PASSWORD_BCRYPT);
	$result = $stmt->execute([":e"=>$username, ":p"=>$hash, ":r"=>$roleid]);
	//TODO do proper checking, maybe user doesn't exist
	if($result){
		return array("status"=>200, "message"=>"You've registered, greetings");
	}
	else{
		//must return a proper message so that the app can parse it
		//and display a user friendly message to the user
		return array("status"=>400, "message"=>"User already exists, please choose different credentials.");
	}
}
?>
