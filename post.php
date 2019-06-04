<?php

include("resources/functions/dbconnection.function.php");

$email = $_POST["email"];
$dnam = $_POST["dnam"];
$pwd = $_POST["pwd"];
$confirm = $_POST['confirm'];

if($pwd == $confirm){

	dbconnection("spNewUser('$email', '$dnam', '$pwd')");
	header('Location: login.php');
	exit;
		
}
else{
	header('location: register.php?error=1');
	exit;

}
	

?>
