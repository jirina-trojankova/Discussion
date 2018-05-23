<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'database.php   ';

$database = "main";
$pdo = connect($database);

$stmt = $pdo->query('SELECT * FROM discussion ORDER BY `post_id` DESC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//use $results..

$row_count = $stmt->rowCount();
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
        <form method="post" action="form_handler.php">
            <label for="name">Name</label>
            <br />
            <input name="name" type="text" placeholder="Your name">
            <br />
            <label for="text">Message</label>
            <br />
            <textarea name="text" rows="10" cols="30" placeholder="Your comment commes here..."></textarea>
            <br />
            <input type="submit" value="Submit">
        </form>
        <?php echo $row_count.' posts altogether'; ?>
        <hr />
        <ul>
            <?php foreach($results as $result) : ?>
            <li style="list-style-type: none;">
                <?php echo $result['nick'] .' - ' . $result['text']; ?>
                <hr />
            </li>
            <?php endforeach; ?>
        </ul>
    </body>

    </html>