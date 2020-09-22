<?php 
	$hostname="localhost";
	$username="root";
	$password= " ";
	session_start();
	$user = mysqli_connect("localhost", "root", "");
	$data = mysqli_connect("localhost", "root", "");

	if($user && $data) {
		mysqli_select_db($user,'proghub_users');
		mysqli_select_db($data,'proghub_data' );
	} else {
		die("Connection was not established!".mysqli_error());
	}
	
	// connect to database
       // coming soon...s

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/ProgHub/home.php');
?>