<?php

	$host='localhost';
	$user='root';
	$password='';
	
	$db='inpulse_test';

    $connection=mysqli_connect($host, $user, $password,$db)or die("cannot select DB: ". mysqli_error());
	
?>