
<?php
require(__DIR__."/MQPublish.inc.php");
session_start();
?>
<form method="POST">
<input type="text" name="username"/> Enter UserName
<input type="password" name="password"/> Enter Password
 <input type="password" name="confirm"/> Reenter Same Password
<input type="submit" name="submit" value="Login"/>
</form>

<?php
if(isset($_POST["submit"])){
  
	$data = $_POST;
  
	if(empty($data["username"]) || !empty($data["password"]) || !empty($data["confirm"])) {
    
	    die('Please fill in all fields');
	}
  
	else if {
    $data["password"] != $data["confirm"];
    die ("Passwords do not match, please enter again.");
  }
    
   else {
      	
    $username = $_POST["username"];
	  $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    }
      
	//calls function from MQPublish.inc.php to communicate with MQ
	$response = login($username, $password);
	if($response["status"] == 200){
		$_SESSION["user"] = $response["data"];
		var_export($_SESSION, true);
		header ("refresh:5; url=login.php")
	}
	else{
		var_export($response);
	}

}
?>
