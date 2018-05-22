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
    $stmt = $db->query("SELECT * FROM messages ORDER BY `Id` DESC");
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

$stmt = $db->query('SELECT * FROM messages');
$row_count = $stmt->rowCount();
echo $row_count.' rows selected';

echo'<hr />';

$stmt = $db->query('SELECT * FROM messages ORDER BY `id` ASC');
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
<ul>
<?php foreach($results as $result) : ?>
    <li>
        <?php echo $result['id'] .' - ' . $result['text']; ?>
    </li>
<?php endforeach; ?>
</ul>  
</body>
</html>




