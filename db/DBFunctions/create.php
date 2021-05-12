<?php
function create_recipe($name, $id, $calories, $ingredient1, $ingredient2, $ingredient3, $image, $description){
	//from dbconnection.php
	$stmt = getDB()->prepare("INSERT INTO Recipes (name, id, calories, ingredient1, ingredient2, ingredient3,
	image, description)
	VALUES (:n, :i, :c, :in1, :in2, :in3, :im, :d)");
	$result = $stmt->execute([":n"=>$name, ":i"=>$id, ":c"=>$calories, ":in1"=>$ingredient1, ":in2"=>$ingredient2,
	":in3"=>$ingredient3, ":im"=>$image, ":d"=>$description]);
	//TODO do proper checking, maybe user doesn't exist
	if($result){
		return array("message"=>"<br>You've created a recipe!");
	}
	else{
		//must return a proper message so that the app can parse it
		//and display a user friendly message to the user
		return array("message"=>"<br>Failed to create recipe");
		
	}
	
}
?>
