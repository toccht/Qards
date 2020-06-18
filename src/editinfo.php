<!DOCTYPE html>
<html>
<head>
    <title>Qards - Edit Info</title>
    <?php include('head.php') ?>
    <script src="/static/extrainfo.js"></script>
</head>

<?php
include('util.php');
if (!isset($user)) {
    header("Location: /login.php");
} elseif ($_POST) {
    $name = filter_var(trim($_POST['full_name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
    $css = filter_var(trim($_POST['css']), FILTER_SANITIZE_STRING);
    $other_info = json_encode($_POST['other_info']);
    if ($db->query("UPDATE `users`
                    SET `full_name`='$name', `email`='$email', `phone`='$phone', `css`='$css', `other_info`=$other_info
                    WHERE id=".$user['id'])) {
        header("Location: /user.php?u=".$user['id']);
    } else {
        echo $db->error;
    }
}
?>

<body>
    <?php echo $header; ?>
    <div class="column centered">
        <form method="POST" action="/editinfo.php">
            <fieldset>
                <legend>User Info</legend>
                <div>
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required />
                </div>
                <div>
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" />
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" value="<?php echo $user['phone']; ?>" />
                </div>
                <div>
                    <label for="css">Custom CSS</label>
                    <textarea name="css"><?php echo $user['css']; ?></textarea>
                </div>
                <button type="submit">Save</button>
            </fieldset>
            <fieldset>
                <noscript>This section will not work without JavaScript enabled</noscript>
                <legend>Other Info</legend>
                <div id="other-info">
                    <?php
                    $other = json_decode($user["other_info"], TRUE);
                    if (isset($other)) {
                        foreach ($other as $row) {
                            echo '<div class="other-field">
                                <input type="text" value='.$row['key'].' placeholder="Key" onchange="change(event);">
                                <input type="text" value='.$row['value'].' placeholder="Value" onchange="change(event);">
                                </div>';
                        }
                    }
                    ?>
                </div>
                <button type="button" onclick="addfield();">Add Field</button>
                <input type="hidden" id="other-info-input" name="other_info" value="{}" />
            </fieldset>
        </form>
    </div>
    <?php echo $footer; ?>
</body>
</html>
