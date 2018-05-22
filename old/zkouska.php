
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'database.php';

$statement = $pdo->prepare("SELECT post_id, nick FROM discussion");
var_dump($statement);
$statement->execute();

/* Fetch all of the remaini ng rows in the result set */
print("Fetch all of the remaining rows in the result set:\n");
$result = $statement->fetchAll();
print_r($result);

?>



