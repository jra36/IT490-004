<?php

require_once(__DIR__.'/../lib/path.inc');
require_once(__DIR__.'/../lib/get_host_info.inc');
require_once(__DIR__.'/../lib/rabbitMQLib.inc');
require(__DIR__."/dbconnection.php");

//separate files for DB calls so it's easier to divide work
require(__DIR__."/DBFunctions/login.php");
require(__DIR__."/DBFunctions/register.php");
require(__DIR__."/DBFunctions/create.php");
require(__DIR__."/DBFunctions/delete.php");
require(__DIR__."/../api/MQFunctions/get_recipe_id.php");
require(__DIR__."/../api/MQFunctions/get_recipe_info.php");
//TODO add more as they're developed

function request_processor($req){
	echo "Received Request".PHP_EOL;
	echo "<pre>" . var_dump($req) . "</pre>";
	if(!isset($req['type'])){
		return "Error: unsupported message type";
	}
	//Handle message type
	$type = $req['type'];
	switch($type){
		case "login":
			return login($req["username"], $req["password"]);
		case "register":
			return register($req["username"], $req["password"], $req["roleid"]);
		case "validate_session":
			return validate($req['session_id']);
		case "echo":
			return array("return_code"=>'0', "message"=>"Echo: " .$req["message"]);
		case "query":
			
			/*
			$db = getDB();
			$stmt = $db->prepare("SELECT * FROM Recipes WHERE name like :query");
			$query = $req['query'];
			$result = $stmt->execute([":query"=>"%$query%"]);
			
			if ($result) {
				$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
				
		        //Fetch API	
			if(!results || count($results) === 0) {
			
			$response = get_recipe_id($req['query']);
				
			if(isset($response["results"])){
			foreach($response["results"] as $post){
			$id = $post['id'];
			$response = get_recipe_info($id);
			}
		}
	//}
			
			foreach ($response as $r) {
			$q = "INSERT INTO Recipes (title) VALUES (:title)";
			
			  
			   $db = getDB();
			   $stmt = $db->prepare($q);
			    $stmt->execute([":title"=>$r['title']]);
			}

			  return $response;
			  */
			//$response = get_recipe_id($req['query']);
			//var_export($response, true);
			
			$response = get_recipe_id($req['query']);
				
			/*if(isset($response["results"])){
			foreach($response["results"] as $post){
			$id = $post['id'];
			$response = get_recipe_info($id);
			}*/
		//}
			return $response;
			
			
		case "create":
			return create_recipe($req["name"], $req["id"], $req["calories"], $req["ingredient1"], $req["ingredient2"], $req["ingredient3"], $req["image"], $req["description"]);
		case "delete":
			return delete_recipe($req["id"]);
	}
	return array("return_code" => '0',
		"message" => "Server received request and processed it");
}
//will probably need to update the testRabbitMQ.ini path here
$server = new rabbitMQServer(__DIR__.'/../lib/testRabbitMQ.ini', "sampleServer");

echo "Rabbit MQ Server Start" . PHP_EOL;
$server->process_requests('request_processor');
echo "Rabbit MQ Server Stop" . PHP_EOL;
exit();
?>
