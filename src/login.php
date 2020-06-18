<!DOCTYPE html>
<html>
<head>
    <title>Qards - Log In</title>
    <?php include('head.php') ?>
</head>

<?php
include('util.php');
if (isset($user)) {
    header('Location: /index.php');
} elseif (isset($_POST["username"]) && isset($_POST["password"])) {
    $hash = hash('sha512', trim($_POST["password"]));
    $res = $db->query("SELECT * FROM `users`
                       WHERE `username`='".strtolower(filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING))."' LIMIT 1");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($row["password"] == $hash) {
            setcookie("user", $row["id"], time() + (86400 * 30), "/");
            header('Location: /dashboard.php');
        }
    }
}
?>

<body>
    <?php echo $header; ?>
    <form class="column centered" method="POST" action="/login.php">
        <fieldset>
            <legend>Log In</legend>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" required autofocus/>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" required />
            </div>
            <button type="submit">Submit</button>
        </fieldset>
    </form>
    <?php echo $footer; ?>
</body>
</html>
