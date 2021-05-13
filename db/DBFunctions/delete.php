<?php
function delete_recipe($id){
	//from dbconnection.php
	$stmt = getDB()->prepare("DELETE FROM Recipes
	WHERE id = :i");
	$result = $stmt->execute([":i"=>$id]);
	//TODO do proper checking, maybe user doesn't exist
	if($result){
		return array("status"=>200,  "message"=>"<br>Successfully deleted recipe.");
	}
	else{
		//must return a proper message so that the app can parse it
		//and display a user friendly message to the user
		return array("status"=>400, "message"=>"<br>Failed to delete recipe.");
		
	}
	
}
?>
