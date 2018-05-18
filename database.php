<?php


//connect to a database
$servername = "localhost";
$username = "root";
$password = "rootroot";
$database = "main";

/**
 * connects to a database
 * 
 * uses the global variables  $servername, $username, $password
 * 
 *@param string $database - name of the database to connect to
 * 
 */

 function connect($database)

 //importconnection data defined in the global scope

 global $servername;
 global $username;
 global $password;

try {
    $pdo = new PDO("mysql:host=".$servername.";dbname=."$database".; charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//insert to a database    
    $sql = "INSERT INTO discussion (nick, text, date)
    VALUES (?, ?, NOW())";
     
    db_query($sql, [$nick, text]);



    // use exec() because no results are returned
    $pdo->exec($sql);
    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
return $pdo;
?> 