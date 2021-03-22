<?php
function get_recipes($q) {
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?limitLicense=false&offset=0&number=10&query=%24q&includeIngredients=strawberry&minVitaminA=500&minFiber=0&maxPotassium=1000&minSelenium=0",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
		"x-rapidapi-key: cf2218c96cmsh042b7223a0f13a6p17be8fjsna7f12d6f3964"
	],
]);

$response = json_decode(curl_exec($curl), true);
$err = curl_error($curl);

return $response; //not sure if needed
curl_close($curl);


if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
}
