 <?php

 $arr1 = ["Juma", "Nichole"];
 $arr2 = ["wife" => "Nichole", "husband"=> "Juma"]

//To print an array
print_r($arr1);

//isset

//isset() is used to confirm if the value of a condition is true
//example

if(isset(1==1)){
	echo "condition is true";
}else{
	echo "condition is false";
}



//foreach loops
foreach($arr1 as $member){
 echo $member;

}

foreach(arr2 as $key=>$value){

	echo $key $value;

}

//for loop 
for($i=0; $i< count($arr1); $i++){

echo $arr1[$i];

}


//while loop
$i = 0;

while($i < count($arr1)){

	echo arr1[$i];

$i++;

}

//================================
//functions
//================================

$greeting = "Hello there!"

 function sum($a, $b) {
	global $greeting; // We have to specify that the variable here, $greeting is a global variable.
	
	echo $greeting;

	return $a + $b;

 }

//Array columns
$members = [
	["name"=> "Nichole", "role"=> "wife"],
	["name"=> "Juma", "role"=> "husband"],
	["name"=> "Alva", "role"=> "son"]

]

$names = array_column($members, "name"); // array_column() is a built in php function

//array_filter
$filtered = array_filter($arr, function(){});

//array_map

$newArr =  array_map(function(){}, $arr);

//example
function modifyArray($arr, $key){ //key is the key to be modified

	return array_map(function($each) use($key) { return member[$key]." good"}, $arr);
	// we used use() method to pass down the $key value to the anonymous funct
	// since it's contents is out of scope with the outer func modifyArray
	// and we cannot specify $key as global inside the anonymous func since $key is not actually global
	// and is not within the scope of the inner anonymous function.

}



modifyArray($members, "role");


//PHP INCLUDE AND PHP REQUIRE

//include() is used to import files stored inside the include/inc folder
//example
include('../../inc/header.php');

//require() method also works like include() but it will throw an error if it cannot find the specific 
//file unlike include()

//use require_once() if you want to import a function or a file just once so you can eliminate redundancies
//by importing it multiple times.


//================================
//USER INPUT AND SAVING DATA IN PHP
//================================

//GET request
//We get user get request from a query string which begins after ?
//example www.google.com/search?source=hp&q=php
//the (query parameters)/key value pairs of the query string are separated by &

//if we include productId and limit as query parameters in the query string, then we can handle that GET
//request on the php server as below
//www.domain/productId=10&limit=5

//Then on the server we will write;

$productId = $_GET["productId"]; 
$limit = $_GET["limit"];

// $_GET is a super global variable which is an array that contains
// the keys of the query parameters. We don't have to specify/define super global variable, we just use them
// in any part of the application without defining them as global.

//so we can output the productId and limit on the html like below

<div> <?= $productId; ?> </div>
// We add  = when writing php code on html


//We use filter_input() method to perform validation on user input during GET/POST request, to protect the application 
//from malicious user input.

//example
$category = filter_input(INPUT_GET, "category", FILTER_VALIDATE_INT);

// We filtered the user input on GET request for category query parameter to ensure that whatever is 
// passed to the category query parameter is an integer. If it isn't an interger, false will be returned.

//There are other types of php built in filters other than validate filters.




//PHP POST REQUESTS

//To receive POST request, we write the code below;

$_POST["email"];

//the email string is the value of the name attribute we added to input form 
//example

<form>  <input type="email" name="email" id="email" /> </form> 

//To check whether request is a GET/POST request we use a super global variable  $_SERVER like below

if($_SERVER["REQUEST_METHOD"] == "POST") {

	echo $_POST["email"];

}

// the above code implies that if the request method is POST, then we want to echo the $_POST super global.

//We could also use 
$_SERVER["REQUEST_METHOD"] == "GET" ;//to look for get requests



// Let's add the below code to filter email input from the POST request
if($_SERVER["REQUEST_METHO"] == "POST"){
	$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	
	if($email == false){ echo "Please enter a valid email address"; }

}



//================================
//PHP SESSIONS
//================================

//In php sessions we have to start a session in order to use sessions.
//We use have to add session_start() method on top whenever we want to utilize sessions in our application.
//example

//INDEX.PHP FILE

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	$password = $_POST["password"]; //validate the password though

	//then compare email and password with the database. 
	function authenticateUser ($email, $password){
		if($email == database.email && $password == database.password){
			$_SESSION["email"] = $email;
			// We set the session to remember the email address. 
			//That's how we'll determine if the user is logged in

			header("Location: admin.php");
			// We then redirect user to admin.php. We use header() method to redirect users.
			die(); // die() means stop execution on this request.
		}else{
			echo "The provided credentials are not correct";
		}	
		
	
	}

	
	

}

//ADMIN.PHP FILE
//<?php
session_start();

function isUserAuthenticated(){
	if(!isset($_SESSION["email"])) { 
		header("Location: login.php");
	}
	//above code means if the session doesn't have an email value/(user is not logged in) redirect user to login page
}

echo $_SESSION["email"]; // email of the logged in user is printed out on the admin page.

//LOGOUT.PHP
//To log the user out, we will write the below code:

//<?php
session_start();
session_unset(); //this unsets all the variables we had set in the session
session_destroy(); // we destroy the session

header("Location: login.php"); // we then redirect the user to login page
die();


//================================
//WORKING WITH FILES 3hr 15min of Envato tuts
//================================

//To check whether a file exists or not, we use
file_exists() //method

//example
if( file_exists($variable) ){ do something }

//Let's now open, read or write files
if(file_exists()){
	//if file exists, we only want to read the file, nothing else.
	$fileHandle = fopen($fileName, "r");
	$json =fread($fileHandle, filesize(fileName)); // we store the content of the read file in json variable
	//fread() and filesize() are both buit in functions. filesize is used to calculate the size of file.
	fclose();

	//We can replace the above 3 lines of code with the one below;
	$json = file_get_contents(fileName); //this function will read and close the file given to it.
	
}else{
	$fileHandle = fopen($fileName, "w+"); //w+ means both write and read from a file
	fclose($fileHandle); // we then have to close the file we created.


	// We can replace the above 2 lines of code with a simple one that does the same whole thing.
	file_put_contents(fileName, "")
}




//PARSE AND OUTPU JSON DATA

$json = [{"color":"red"},{"color":"orange"}]

$parsedData = json_decode($json); //json_decode() is a built in function.

//ACCESSING CONTENTS ON AN OBJECT IN PHP
To access the values of an object from json, like object.key in Javascript, in php we use object->key

Aside from traditional foreach() method, we can also use a friendly foreach syntax for html, see below;

	<?php foreach($json as $jsonObject) : ?>
		<ul> <li>    <?= $jsonObject->color ?>    </li> </ul> // we are using json data from above
	<?php endforeach; ?>

We can also use a similar syntax for if statements to make them html friendly, see below
	<?php if(true): ?>
		<div> <?= $json ?> </div> //we just printed json data on a div
	<?php endif; ?>

//strpos()
To find the position of a sub string inside a string, we use strpos() method
example
strpos("Hello Juma and Nicole", "ello") // implies position of where "ello" begins in the string, in this case 
//position 1, from the index of "e" which is the first character of the "ello" substring

//Strict comparison operator === or !===
If you want to strictly compare the exact values of two things, we use === instead of ==
example 
 if(0 === false){
	echo "It worked"
 }

// nothing will be echoed because 0 is not literally equal to false, albeit both of them are falsy values.


//FILTERING POST REQUESTS
To validate post request, in this case an incoming string, we can write the code below:
$request = "user post request";

$filterd = filter_var(trim(request), FILTER_SANITIZE_STRING);

//by using built in trim() method, we remove white spaces from $request string
//filter_var() is used to filter strings. This function returns filtered string or false if the filter fails.
 so 

  if($filtered === false){return '';}else{ return $filtered;} 
  // if the filtered_var() retuns false, return empty string, else, return the filtered string

//empty()
empty() method is used to find out if a string is empty or has something in it
  example if(empty($request)){ echo "Is empty";}else{ echo "Has characters";}

//CONVERT ARRAY TO OBJECT
$arr = ["name"=> "Juma"];

to convert the above array into an object we write the below code;
$obj = (object) $arr;

to append this object to an array of objects, let's say 
$arrOfObj = [{"name": "Nicole"}, {"name":"Alva"}];

//we will write the below code to append our new $obj to it
$arrOfObj[] = $obj;

//The above code can also be written as 
array_push($arrOfObj, $obj);

//to delete an item from an array, we will write the code below:
unset($arrOfObj[index to be deleted]) hence unset($arrOfObj[0]);

//After using unset() method, the remaining array is converted to to an object of objects, with former array
//indexes now acting as keys. We don't want this. So we should covert the changed array to true array through: 

$new_array = array_values($arrOfObj)

The above method will take all the values of the changed array and put them into a new array that will be a true array


//================================
//INTRODUCTION TO PHP CLASSES
//================================

class Person {
	function __construct($name, $sex){
		$this->name = $name;
		$this->sex = $sex;
		
	}
	
	function walk(){
		echo $this->name . "is walking"; //we concatenate name and the string
	}

	function walkFaster(){
		$this->walk() . "faster"; //we are using walk() method inside walkFaster() method, therefore we use $this
	}

}

//We can hide walkFaster() method so it cannot be used outside the class.
 //to do that, we just need to add private keyword before the function like below
 private function walkFaster(){} 

//We could also add public keyword for the rest of the methods that can be accessed publicly outside the function.

$obj1 = new Person("Juma", 25);
$obj1->walk(); //this is the way we access the method of an object in php
echo $obj1->name; // prints 

//STATIC PROPERTIES AND METHODS
//static methods and properties are not dependent on instances of a class, they exist only in the class.
//Below is a static class

class Data {
 static private $dataStore;

 static public function initialize($database){
 	return self::$dataStore = $database; 
 }

 static public getData(){
 	return self::$dataStore->get_data(); //we assume the database has a method get_data()

 }
}

//A static class doesn't have a constructor, because there are no objects drawn from it.
//To make the Data class accessible to other parts of the application, we will write the below code:

Data::initialize($database); // we call the constructor and provide it with database data

//So now we can use the methods of the Data class like below:
Data::getData();




//INHERITANCE

//Here parent class has certain properties and methods that can be inherited by child class, and the child class
//has extra properties and methods that are specific to that child.

class Pen {
	
	function __construct($ink_color){
		$this->ink_color = $ink_color //We can replace this code with the correct one below
		$this->ink_color;
	}
	
	public function write($message){
		echo $message;
	}
}

//The above class is the parent class. Let's write the code for child class below:

class PenWithCap extends Pen{
	public function toggleCap(){
		echo "Cap toggled";
	}
	
}

$cappedPen = new PenWithCap("Blue");
$cappedPen->write("Hi there");    //write() method is drawn from parent class
$cappedPen->toggleCap();         //toggleCap() method is from the current child class.

//We can also overwrite methods inherited from the parent class and change the values it returns,
// for example we can overite the write() method from the parent class in the child by adding the code below:
	public function write($message){
		echo 'Written with a capped child pen'. $message;
	}



//HANDLING ERRORS
//we use try catch block as written below:

try{

} catch() {

}


//================================
//NAMED ARGUMENTS IN PHP
//================================

//let's consider imaginary function getData($name, $age){ return $name . $age}
//to call the function with named arguments, we would write the code below:

getData(name:"Juma", age: 25);

//Here, the arguments are preceded by the parameter names.



//To check if a string contains a certain substring we use str_contains() method and returns either true of false.
//example
str_contains($str, $substr);  // The first arg is the whole string, the second is the substring being tested

str_starts_with($str, $substring); // This method is used to check if the substring being tested begins the whole 
//string. It also returns true or false


str_ends_with($str, $substring); // checks whether the substring passed ends the string. Also returns true or false.


?>