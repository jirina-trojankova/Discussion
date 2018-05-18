<?php
// $my_db_handle = new PDO(
// 	'mysql:host=localhost;dbname=world', // connection string
// 	'dev', //username
// 	'' //password
// );


// $pdo_connection = new PDO(

//     'mysql:dbname=test;host=localhost;charset=utf8', // connection information

//     'root', // username

//     'rootroot' // password

// );


$servername = "localhost";
$username = "root";
$password = "rootroot";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?> 