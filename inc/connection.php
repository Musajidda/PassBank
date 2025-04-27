<?php

$host = "localhost";
$database = "passbank";
$username = "root";
$password = "";

//connecting to the database
$connection = mysqli_connect($host,$username,$password,$database)
or die("Database cannot connect");

 