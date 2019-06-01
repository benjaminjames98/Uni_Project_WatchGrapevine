<?php
require_once 'db.php';
$db = get_db();

$query = "SELECT id, name, text, likes, DATE_FORMAT(post_date, '%d %b %Y, %h:%i %p' ) FROM WatchPost WHERE reply_to IS NULL ORDER BY post_date DESC ";
if (isset($_GET['order_by'])) $query .= ' ORDER BY ' . $_GET['order_by'];
$stmt = $db->prepare($query);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $name, $text, $likes, $date);
$data = [];
while ($stmt->fetch())
    $data[] = ['id' => $id, 'name' => $name, 'text' => $text, 'likes' => $likes, 'date' => $date];
$stmt->close();

echo json_encode($data);