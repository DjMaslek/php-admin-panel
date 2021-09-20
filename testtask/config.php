<?php
$config = array(
    'title' => 'title',
    'db' => array(
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'name' => 'test-task'
    )
);
require "db.php";

session_start();
