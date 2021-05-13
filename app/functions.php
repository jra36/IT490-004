<?php
require(__DIR__."/MQPublish.inc.php"); //MQPublish.inc.php would include a require for all the functions located in app/MQFunctions
echo '<br><br><a href="admindashboard.php">Click here to go back to the list of services!</a><br><br>'; 

$choice = $_POST["choice"];

if($choice == "Create")
	{
		$name = $_POST["name"];
		$id = $_POST["id"];
		$calories = $_POST["calories"];
		$ingredient1 = $_POST["ingredient1"];
		$ingredient2 = $_POST["ingredient2"];
		$ingredient3 = $_POST["ingredient3"];
		$image = $_POST["image"];
		$description = $_POST["description"];
		create_recipe($name, $id, $calories, $ingredient1, $ingredient2, $ingredient3, $image, $description);
	}
if($choice == "Search")
	
	{
		$query = $_POST["query"];
		$response = get_recipes($query);
	
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
		
		
		
		
	}
	
if($choice == "Clear")
	
	{
		$id = $_POST["id"]; 
		delete_recipe($id);
		echo "Recipe successfully deleted!";
	}
	
?>
