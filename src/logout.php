<?php
// set the expiration date to one hour ago
unset($_COOKIE['user']);
setcookie("user", NULL, time() - 3600);
header("Location: /index.php");
?>
