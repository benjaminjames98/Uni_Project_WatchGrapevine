<?php
require_once 'db.php';
$db = get_db();

$query = "UPDATE WatchPost SET likes = likes + 1 WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $_POST['id']);
$stmt->execute();

if ($stmt->affected_rows != 1)
    echo json_encode(false);
else echo json_encode(true);
die();