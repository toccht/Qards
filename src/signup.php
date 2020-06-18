<!DOCTYPE html>
<html>
<head>
    <title>Qards - Sign Up</title>
    <?php include('head.php') ?>
</head>

<?php
include('util.php');
if (isset($user)) {
    header('Location: /index.php');
} elseif (isset($_POST["username"]) && isset($_POST["password"])) {
    $hash = hash('sha512', trim($_POST["password"]));
    if ($db->query("INSERT INTO `users` (`username`, `password`)
                    VALUES ('".strtolower(filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING))."', '$hash')")) {
        $res = $db->query("SELECT * FROM `users`
                       WHERE `username`='".strtolower(filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING))."' LIMIT 1");
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            setcookie("user", $row["id"], time() + (86400 * 30), "/");
            header('Location: /editinfo.php');
        }
    }
}
?>

<body>
    <?php echo $header; ?>
    <form method="POST" action="/signup.php" class="column centered">
        <fieldset>
            <legend>Sign Up</legend>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" required autofocus />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" required /><br/>
            </div>
            <div>
                <label for="password-repeat">Password (repeat)</label>
                <input type="password" name="password-repeat" /><br/>
            </div>
            <button type="submit">Submit</button>
        </fieldset>
<!--
        <fieldset>
            <legend>Your Info</legend>
            <div>
                <label for="email">E-mail</label>
                <input type="email" name="email"><br/>
            </div>
        </fieldset>
-->
    </form>
    <?php echo $footer; ?>
</body>
</html>
