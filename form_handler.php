<?php
require 'database.php';

//gather data from POST
$nick = isset($_POST['name']) ?  $_POST['name'] : '';
$text = isset($_POST['text']) ?  $_POST['text'] : '';
// $date = date('Y-m-d H:i:s');


//this is a command for a database   
$query = "INSERT INTO `discussion` (`nick`, `text`)VALUES (?, ?)";
 
//function query from database
query($query, [
    $nick,
    $text
]);



//redirects back to where it came
header("Location: index1.php");
exit();


?>