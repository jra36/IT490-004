<?php
require(__DIR__."/MQPublish.inc.php"); //MQPublish.inc.php would include a require for all the functions located in app/MQFunctions
require(__DIR__."/../db/DBFunctions/favorite.php");
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
		$response = send_user_recipe($query);
	

		if(isset($response)) {
		foreach($response as $post){
			$image = $post["image"];
			$imageData = base64_encode(file_get_contents($image));
			echo '<br><br><br><img src="data:image/jpeg;base64,'.$imageData.'">';
			echo "<br><br>";
			echo "ID: " . $post['id'];
			echo "<br>";
			echo "Name: " . $post['name'];
			echo "<br>";
			echo "Calories: " . $post['calories'];
			echo "<br>";
			echo "First Ingredient: " . $post['ingredient1'];
			echo "<br>";
			echo "Second Ingredient: " . $post['ingredient2'];
			echo "<br>";
			echo "Third Ingredient: " . $post['ingredient3'];
			echo "<br>";
			echo "Description: " . $post['description'];
			echo "<br><br><br><br>";
			echo '<a href="/../db/DBFunctions/favorite.php">Click to Favorite this Recipe.</a>';

		}
	}
		
	
	
	
		
		
	}
	
if($choice == "Clear")
	
	{
		$id = $_POST["id"]; 
		delete_recipe($id);
		echo "Recipe successfully deleted!";
	}
	
?>
