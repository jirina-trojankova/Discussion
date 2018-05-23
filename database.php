<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

 //includes try and catch
 function connect($database) {
 //imports connection data defined in the global scope
 global $servername;
 global $username;
 global $password;

 //connects to database
try {
    $pdo_connection = new PDO("mysql:host=".$servername.";dbname=main; charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  if($pdo_connection){
    //      echo "Connected to the <strong>$database</strong> database successfully!";   
    //   }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
return $pdo_connection;
}

/**
 * run a query
 * 
 * 
 * runs a query using the predefined database
 * 
 * 
 * @param string $query - query to be run
 * @param array $values - values to be substituted for "?"
 */
function my_query($query, $values = []) {
    global $database;
    $pdo = connect($database);
    $statement = $pdo->prepare($query); 
    if(false === $statement->execute($values)) {
        echo '<h1>MySQL error:</h1>';
        var_dump($pdo->errorinfo());
        exit();
    }
}
?> 