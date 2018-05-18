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
    $pdo_connection = new PDO("mysql:host=".$servername.";dbname=."$database".; charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//insert to a database    
    $sql = "INSERT INTO discussion (nick, text, date)
    VALUES (?, ?, NOW())";
     
    db_query($sql, [$nick, text]);



    // use exec() because no results are returned
    $pdo_connection->exec($sql);
    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
return $pdo_connection;

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
function query($query, $values = []) {
    global $database;

    $pdo = connect($database);

    $statement = $pdo->prepare($query); 
    if(false === $statement->execute($values)) {
        echo '<h1>MySQL error:</h1>'
        var_dump($pdo->errorinfo());
        exit();
    }
    $statement->setFetchMode(PDO::FETCH_ASSOC); //set the type of results
    return $statement->fetchAll(); //get all results as an array
}
?> 