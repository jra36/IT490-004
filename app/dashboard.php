<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<style>
h1 {text-align: center;}
p.dashed {
	border-style: dashed;
    
	background-color: offwhite;
 
}
body {
  background-image: url('https://mommyshomecooking.com/wp-content/uploads/2019/05/Easy-Strawberry-Sauce-Recipe-Photo-15.jpg');
  background-size: 700px 800px;
  
 
}
h1 {
  color: black;
  font-family: Cursive;
  font-size: 300%;
}
</style>
<title>Page Title</title>
</head>
<body>
<b><h1 style="font-size:50px;"><p class="dashed">All About Strawberry Recipes</h1></b></p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<b><h1 style="font-size:30px;"> </h></b>
<form method="POST">
	<label for="query">Find recipes here:</label><br>
  	<input type="text" name="query" size = "40" >
  	<button type="submit" name="submit">Search</button>
</form> 
	
<?php
require(__DIR__."/MQPublish.inc.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

if(isset($_POST["submit"])){
	
	if(isset($_POST["query"])) {
	
		if(!empty($_POST["query"])) {
		$query = $_POST["query"];
	}
   }
	else {
		die('Please Enter a Query.');
	}

	//calls function from MQPublish.inc.php to communicate with MQ
	$response = get_recipes($query);
	$output = array("data"=>json_decode($response,true));
	
	if(isset($output['data'])) {
	     foreach ($output as $post) {
             echo '<h3>' . $post['title'] . '</h3>';
         }
	}
	//if($response){
	//	var_export($response->status, true);
	//}
	//else{
		//var_export($response);
	//}
      
 }
?>
</body>
</html>





