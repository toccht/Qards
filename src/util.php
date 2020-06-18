<?php
// Errors, comment out in "prod"
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new mysqli("127.0.0.1", "qards", "awkward-joke-lost-fish", "qards", 3306);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

$user = NULL;
if (isset($_COOKIE["user"])) {
    $res = $db->query("SELECT * FROM `users` WHERE id=".$_COOKIE["user"]." LIMIT 1");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
    }
}

$header = null;
if (isset($user)) {
    $header =  '<header>
      <a href="/"><img src="/static/logo.png"></a>
      <span class="right">
      <a class="btn" href="/user.php?u='.$user["id"].'">My Card</a>
      <a class="btn" href="/dashboard.php">Dashboard</a>
      <a class="btn" href="/logout.php">Log Out</a>
      </span>
      </header>';
} else {
    $header =  '<header>
      <a href="/"><img src="/static/logo.png"></a>
      <span class="right">
      <a class="btn" href="/login.php">Log In</a>
      </span>
      </header>';
}

$footer = '<footer>
<p>Company © Qards. All rights reserved.</p>
</footer>';
?>
