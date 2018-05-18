<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";

try {
    $conn = new PDO("mysql:host=$servername;dbname=main", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO discussion (nick, text, datetime)
    VALUES ('John', 'ahoj', NOW())";
    // use exec() because no results are returned
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
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
<form method="post" action="">  
<label for="text">Name</label><br />
<input name="name" type="text" placeholder="Your name"><br />
<label for="message">Message</label><br />
<textarea name="message" rows="10" cols="30"placeholder="Your comment commes here..."></textarea><br />
<input type="submit" value="Send">

<?php
//vytahne data a vypise je tady
?>

</form>
</body>
</html>