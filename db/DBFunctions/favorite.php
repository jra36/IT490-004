<?php
function favorite(){
	//from dbconnection.php
	$stmt = getDB()->prepare("INSERT INTO Favorites (user_id, recipe_id) VALUES (:u, :r)");
	$result = $stmt->execute();
	//TODO do proper checking, maybe user doesn't exist
	if($result){
		return array("message"=>"You've favorited a recipe!");
	}
	else{
		//must return a proper message so that the app can parse it
		//and display a user friendly message to the user
		return array("message"=>"Something went wrong...try again.");
		
	}
	
}
?>
