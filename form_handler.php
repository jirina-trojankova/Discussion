<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'database.php';

//gather data from POST
$nick = isset($_POST['name']) ?  $_POST['name'] : '';
$text = isset($_POST['text']) ?  $_POST['text'] : '';
// $date = date('Y-m-d H:i:s');


//this is for database   
$query = "INSERT INTO `discussion` (`nick`, `text`)VALUES (?, ?)";
 
//function query from database
my_query($query, [
    $nick,
    $text
]);

//redirects back to where it came
header("Location: index.php");
exit();
?>