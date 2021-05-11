<?php
function create_recipe($name, $id, $calories, $ingredient1, $ingredient2, $ingredient3, $image, $description){
	try{
		require_once(__DIR__.'/../../lib/path.inc');
		require_once(__DIR__.'/../../lib/get_host_info.inc');
		require_once(__DIR__.'/../../lib/rabbitMQLib.inc');

		$client = new RabbitMQClient(__DIR__.'/../../lib/testRabbitMQ.ini', 'testServer');
		$msg = array("name"=>$name,"id"=>$id, "calories"=>$calories,"ingredient1"=>$ingredient1,"ingredient2"=>$ingredient2,
		"ingredient3"=>$ingredient3,"image"=>$image,"description"=>$description,"type"=>"create");
		$response = $client->send_request($msg);
		return $response;
	}
	catch(Exception $e){
		return $e->getMessage();
	}
}
?>