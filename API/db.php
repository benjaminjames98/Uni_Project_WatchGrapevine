<?php

function get_db() {
    $db = mysqli_connect('localhost', 'root', 'root', 'WatchGrapevine');

    if (!$db) die(mysqli_connect_error());
    else return $db;
}