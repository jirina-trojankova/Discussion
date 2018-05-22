<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'database.php';

//gather data from POST
$nick = isset($_POST['name']) ?  $_POST['name'] : '';
$text = isset($_POST['text']) ?  $_POST['text'] : '';
// $date = date('Y-m-d H:i:s');


//insert to a database    
$query = "
INSERT INTO `discussion` (`nick`, `text`)
VALUES (?, ?)
";

 
 //function query from database
//inserts query from above and should print data
db_query($query, [
    $nick,
    $text
]);

//redirect back to where it camo
header("Location: index.php");
exit();