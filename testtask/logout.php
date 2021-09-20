<?php
require "config.php";
//log out user
unset($_SESSION['signed_user']);
header('Location: /');
?>