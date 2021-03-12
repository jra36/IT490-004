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
	
	if(!empty($_POST["username"]) && !empty($_POST["password"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	}
	else {
		die('Please Fill In All Fields.');
	}

	//calls function from MQPublish.inc.php to communicate with MQ
	$response = login($username, $password);
	if($response["status"] == 200){
		$_SESSION["user"] = $response["data"];
		var_export($_SESSION, true);
		header ("Location: dashboard.php");
		exit();
	}
	else{
		var_export($response);
	}

}
?>
