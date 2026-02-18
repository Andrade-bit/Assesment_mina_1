<?php 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "assessment_db";

$conn = mysqli_connect($host, $user,$pass,$dbname);
//conditional statement whether to verify the sql connection
//and php

if(!$conn){
    die("database connection failed: ". mysqli_connect_errno());

}





?>