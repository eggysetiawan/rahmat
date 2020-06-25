<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['level']);

session_destroy();

setcookie('log_id', '', time() - 3600);
setcookie('user', '', time() - 3600);

header("location:../index.php");
