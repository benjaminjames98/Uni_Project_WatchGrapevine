<?php
require_once 'db.php';
$db = get_db();


$query = "SELECT id, name, text, likes, DATE_FORMAT(post_date, '%d %b %Y, %h:%i %p' ), reply_to FROM WatchPost WHERE id = ? OR reply_to = ?;";
$stmt = $db->prepare($query);
$stmt->bind_param('ss', $_GET['id'], $_GET['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $name, $text, $likes, $date, $reply_to);
$data = ['posts' => [], 'replies' => []];
while ($stmt->fetch())
    if ($reply_to == $_GET['id'])
        $data['replies'][] = ['id' => $id, 'name' => $name, 'text' => $text, 'likes' => $likes, 'date' => $date, 'reply_to' => $reply_to];
    else
        $data['posts'][] = ['id' => $id, 'name' => $name, 'text' => $text, 'likes' => $likes, 'date' => $date, 'reply_to' => $reply_to];
$stmt->close();

echo json_encode($data);