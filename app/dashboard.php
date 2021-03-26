<?php
session_start();
require(__DIR__."/MQPublish.inc.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

if(isset($_POST["submit"]) && isset($_POST["query"]) && !empty($_POST["query"])){
	
	
		$query = $_POST["query"];
	}

	else {
		die('Please Enter a Query.');
	}

	//calls function from MQPublish.inc.php to communicate with MQ
	$response = get_recipes($query);
?>

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
	
<div id="output"> 	
	

	<?php  if(isset($response["results"])): ?>
	<?php foreach($response["results"] as $post): ?>
		<article>
			<header>
				<h3><?php echo $post['title'];?></h3>
				<h6><?php echo $post['id'];?></h6>
				<img height="100px" width="100px" src="<?php echo $post['image'];?>"/>
			</header>
			<section>
				<h4>Likes</h4>
				<p><?php echo $post['likes'];?></p>
			</section>
			<section>
				<h4>Used Ingredient Count</h4>
				<p><?php echo $post['usedIngredientCount'];?></p>
			</sections>
			<footer>
				<section>
					<h5>Missed Ingredient Count</h5>
					<time><?php echo $post['missedIngredientCount'];?></time>
				</section>
			
			</footer>
			
		</article>
	<?php endforeach; ?>
	<?php else: ?>
		<div>No Recipes Found.</div>

	<?php endif; ?>

</div>
</body>
</html>





