<?php

session_start();

$_SESSION = [];

session_destory();

header("location: login.php");
exit;