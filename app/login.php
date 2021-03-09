<?php
require(__DIR__."/MQPublish.inc.php");
session_start();
?>
<form method="POST">
<input type="text" name="username"/>
<input type="password" name="password"/>
<input type="submit" name="submit" value="Login"/>
</form>

<?php
if(isset($_POST["submit"])){
	$data = $_POST;
	if(!empty($data["username"]) && !empty($data["password"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	}
	else {
		die('Please fill in all fields');
	}

	//calls function from MQPublish.inc.php to communicate with MQ
	$response = login($username, $password);
	if($response["status"] == 200){
		$_SESSION["user"] = $response["data"];
		var_export($_SESSION, true);
	}
	else{
		var_export($response);
	}

}
?>
