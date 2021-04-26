<?php

require_once(__DIR__.'/../lib/path.inc');
require_once(__DIR__.'/../lib/get_host_info.inc');
require_once(__DIR__.'/../lib/rabbitMQLib.inc');
require(__DIR__.'/../db/dbconnection.php');

//separate files for API calls so it's easier to divide work
//require(__DIR__."/DBFunctions/login.php");
//require(__DIR__."/DBFunctions/register.php");
require(__DIR__."/MQFunctions/get_recipe_id.php");
require(__DIR__."/MQFunctions/get_recipe_info.php");
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
		//case "login":
		//	return login($req['username'], $req['password']);
		//case "register":
		//	return register($req["username"], $req["password"]);
		//case "validate_session":
		//	return validate($req['session_id']);
		//case "echo":
			//return array("return_code"=>'0', "message"=>"Echo: " .$req["message"]);
    case "query":
        $response = get_recipe_id($req['query']);
			
	/*if(isset($response["results"])){
	foreach($response["results"] as $post){
		$id = $post['id'];
		$response = get_recipe_info($id);
		//echo var_export($post, true);
		
	}*/
        var_export($response, true);
	return $response;
	}
			
	return array("return_code" => '0',
		"message" => "Server received request and processed it");
}
//will probably need to update the testRabbitMQ.ini path here
$server = new rabbitMQServer(__DIR__.'/../lib/apiMQ.ini', "secondQueue");

echo "Rabbit MQ Server Start" . PHP_EOL;
$server->process_requests('request_processor');
echo "Rabbit MQ Server Stop" . PHP_EOL;
exit();
?>
