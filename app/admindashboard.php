<!DOCTYPE html>

<meta charset = "utf-8">

<head>
<style>
body {
  background-color: #ffcce0;
  background-image: url('https://pm1.narvii.com/6791/c7640f2c1da4ac40f889df857f9f7bc313727b9av2_hq.jpg');
  background size: 700px 800px;
}
</style>
</head>
<body>


<style> selector {property:value;}
#name, #query, #id, #calories, #ingredient1, #ingredient2, #ingredient3 {display: none;}
form{margin:auto; border:2px dashed black; padding:20px; width:300px; }
</style>


<form action = "admindashboard.php" autocomplete ="off">
<option value = '' >Please Choose an option from below: </option><br>
<input type = radio name = "choice" id = "Create" value = "Create" > Create Strawberry Recipes<br>
<input type = radio name = "choice" id = "Search" value = "Search" > Search for a Strawberry Recipe<br>
<input type = radio name = "choice" id = "Clear" value = "Clear" > Delete Recipe<br>
<input type = radio name = "choice" id = "Favorite" value = "Favorite" > Favorite Recipe<br><br>


<div id = "name" ><input type = text name= "name"  > Enter Recipe Name<br></div>
<div id = "query" ><input type = text name= "query"  > Enter Recipe To Search For<br></div>
<div id = "id" ><input type = text name= "id"  > Enter Recipe ID<br></div>
<div id = "calories"  ><input type = text name= "calories"   > Enter Calories<br></div>
<div id = "ingredient1"  ><input type = text name= "ingredient1"   > Enter Ingredient 1<br>
<div id = "ingredient2"  ><input type = text name= "ingredient2"   > Enter Ingredient 2<br>
<div id = "ingredient3"  ><input type = text name= "ingredient3"   > Enter Ingredient 3<br>
<!-- <div id = "description"  ><input type = text name= "description"   > Enter Description <br> -->
<div id = "description"  >
<textarea name =description rows="4" col="50">
Enter a description of the recipe.
	</textarea> Enter description
</div> 
<br>
<input type = submit>
</form>


<script>
var ptrCreate = document.getElementById("Create")
var ptrSearch = document.getElementById("Search")
var ptrClear = document.getElementById("Clear")
var ptrName = document.getElementById("name") 
var ptrQuery= document.getElementById("query")
var ptrID= document.getElementById("id")
var ptrCalories= document.getElementById("calories")
var ptrIngredient1 = document.getElementById("ingredient1")
var ptrIngredient2 = document.getElementById("ingredient2")
var ptrIngredient3 = document.getElementById("ingredient3")
var ptrDescription = document.getElementById("description")
ptrCreate.addEventListener("click", F)
ptrSearch.addEventListener("click", F)
ptrClear.addEventListener("click", F)
function F(){
	ptrName.style.display =  "none" 
	ptrQuery.style.display =  "none"
	ptrID.style.display =  "none"
	ptrCalories.style.display =  "none"
	ptrIngredient1.style.display =  "none"
	ptrIngredient2.style.display =  "none"
	ptrIngredient3.style.display =  "none"
    ptrDescription.style.display =  "none"
	if(this.value == "Create") {
		ptrName.style.display =  "block"
		ptrID.style.display =  "block"
		ptrCalories.style.display =  "block"
		ptrIngredient1.style.display =  "block"
		ptrIngredient2.style.display =  "block"
		ptrIngredient3.style.display =  "block"
        ptrDescription.style.display = "block"
	
	}
	if(this.value == "Search"){
		ptrQuery.style.display = "block"
		
	}
	if(this.value == "Clear") {
		ptrID.style.display = "block"
	
	}
}
	
</script>
