<?php
    include("resources/functions/dbconnection.function.php");

    session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = dbconnection("spSelectUser('$email', '$password')");

    if ($user[0] != null) {
        $_SESSION['user'] = $user[0];
        header('Location: index.php');
    }
    else {
        header('Location: login.php');
    }

	exit;
