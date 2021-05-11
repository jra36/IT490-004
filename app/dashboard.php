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
/*body {
  background-image: url('https://mommyshomecooking.com/wp-content/uploads/2019/05/Easy-Strawberry-Sauce-Recipe-Photo-15.jpg');
  background-size: 700px 800px;
  
 
}*/
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
<form action = "functions.php" method="POST" autocomplete ="off">
	<label for="query">Find recipes here:</label><br>
  	<input type="text" name="query" size = "35" >
  	<button type="submit" name="submit">Search For Recipes</button><br>
    <input type = button name = "choice" id = "Favorite" value = "View Favorited Recipes" ><br><br>
</form>
	
<div id="output"> 	
	
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

	//question if because the results returned by the get_recipe_info function doesn't have the keyword "results", is it sufficient to just say if(isset($response)
	<?php  if(isset($response["results"])): ?>
	<?php foreach($response["results"] as $post): ?>
		<article>
			<header>
				<h3><?php echo $post['title'];?></h3>
				<img height="200px" width="200px" src="<?php echo $post['image'];?>"/>
			</header>
			<section>
				<h4><u>ID of Recipe</u></h3>
				<p><?php echo $post['id'];?></p>
			</section>
			<section>
				<h4><u>Likes</u></h4>
				<p><?php echo $post['likes'];?></p>
			</section>
			<section>
				<h4><u>Used Ingredient Count</u></h5>
				<p><?php echo $post['usedIngredientCount'];?></p>
			</section>
			<section>
				<h4><u>More Information To Follow.</u></h5>
				<p><?php echo "TBD";?></p>
			</sections>
			<hr>
			
		</article>
	<?php endforeach; ?>
	<?php else: ?>
		<div>No Recipes Found For Your Query.</div>

	<?php endif; ?>

</div>
</body>
</html>





