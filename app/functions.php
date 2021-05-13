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
		$response = send_user_recipe($query);
	
		if(isset($response)) {
		foreach($response as $post){
			echo "<br><br>";
			echo $post['id'];
			echo "<br>";
			echo $post['name'];
			echo "<br>";
			echo $post['calories'];
			echo "<br>";
			echo $post['ingredient1'];
			echo "<br>";
			echo $post['ingredient2'];
			echo "<br>";
			echo $post['ingredient3'];
			echo "<br>";
			echo $post['image'];
			echo "<br>";
			echo $post['description'];
			echo "<br>";
			
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
