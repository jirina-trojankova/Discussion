<?php
require 'database.php';

var_dump($_POST);

//gather data from POST
$nick = isset($_POST['name']) ?  $_POST['name'] : '';
$text = isset($_POST['text']) ?  $_POST['text'] : '';
// $date = date('Y-m-d H:i:s');


//insert to a database    
$query = "
INSERT INTO `discussion` (`nick`, `text`)
VALUES (?, ?)
";
var_dump($query);

 
 //function query from database

query($query, [
    $nick,
    $text
]);

//redirect back to where it camo
header("Location: index.php");
exit();


?>