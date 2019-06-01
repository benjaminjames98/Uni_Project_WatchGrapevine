<?php
require_once 'db.php';
$db = get_db();

$query = "INSERT INTO WatchPost (name, text, reply_to) VALUES (?,?,?)";
$stmt = $db->prepare($query);
if ($_POST['reply_to'] === 'null')
    $stmt->bind_param('sss', $_POST['name'], $_POST['text'], $t = null);
else
    $stmt->bind_param('sss', $_POST['name'], $_POST['text'], $_POST['reply_to']);
$stmt->execute();

if ($stmt->affected_rows != 1)
    echo json_encode(false);
else echo json_encode(true);
die();