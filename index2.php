<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "root";
$password = "rootroot";
$database = "main";

$db = new PDO("mysql:host=".$servername.";dbname=main; charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

function getData($db) {
    $stmt = $db->query("SELECT * FROM discussion ORDER BY `post_id` ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($stmt);
 }
  
 //then much later
 try {
    getData($db);
 } catch(PDOException $e) {
    //handle me.
}
getData($db);
echo'<hr />';

$stmt = $db->query('SELECT * FROM discussion');
$row_count = $stmt->rowCount();
echo $row_count.' rows selected';

echo'<hr />';

$stmt = $db->query('SELECT * FROM discussion ORDER BY `post_id` ASC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//use $results
var_dump($results);
echo'<hr />';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>Hi and wellcome to our discussion...</h3>
<p>Have any comments?</p> 
<h2>Let us know!</h2> 
<form method="post" action="form_hndlr.php">  
<label for="name">Name</label><br />
<input name="name" type="text" placeholder="Your name"><br />
<label for="text">Message</label><br />
<textarea name="text" rows="10" cols="30"placeholder="Your comment commes here..."></textarea><br />
<input type="submit" value="Send">
</form>
<ul>
<?php foreach($results as $result) : ?>
    <li>
        <?php echo $result['nick'] .' - ' . $result['text']; ?>
    </li>
<?php endforeach; ?>
</ul>  
</body>
</html>