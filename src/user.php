<!DOCTYPE html>
<html>

<?php
include("util.php");

$saved = false;
$page_user = NULL;
if (isset($_GET['u'])) {
    $uid = filter_var(trim($_GET['u']), FILTER_SANITIZE_NUMBER_INT);
    $res = $db->query("SELECT * FROM `users` WHERE id=$uid LIMIT 1");
    if ($res->num_rows > 0) {
        $page_user = $res->fetch_assoc();
    }
    if (isset($user)) {
        $res = $db->query("SELECT * FROM (`users`, `relations`)
                       WHERE (( relations.user1 = ".$user['id']." AND relations.user2 = $uid )
                             OR ( relations.user1 = $uid AND relations.user2 = ".$user['id']." ));");
        if ($res->num_rows > 0) {
            $saved = true;
        }
        if (isset($_GET["save"]) && !$saved && $uid != $user['id']) {
            if ($db->query("INSERT INTO `relations` (`user1`, `user2`) VALUES (".$user['id'].", $uid);")) {
                $saved = true;
            }
        }
    }
} else {
    header("Location: /");
}
?>

<head>
    <title>Qards - User</title>
    <?php include('head.php') ?>
    <style><?php echo $user["css"] ?></style>
</head>

<body>
    <?php echo $header; ?>
    <div class="column centered">
      <div class="card">
        <h2 class="full-name"><?php echo $page_user["full_name"]; ?></h2>

        <h3>
            <a class="email" href="mailto:<?php echo $page_user["email"]; ?>"><?php echo $page_user["email"]; ?></a>
            <a class="phone" href="tel:<?php echo $page_user["phone"]; ?>"><?php echo $page_user["phone"]; ?></a>
        </h3>
        <?php
        $other = json_decode($page_user["other_info"], TRUE);
        if (isset($other)) {
            foreach ($other as $row) {
                $key = $row['key'];
                $value = $row['value'];
                echo "<h3 class=\"$key\"><small>$key</small> $value</h3>";
            }
        }
        ?>
      </div>

      <?php
       if (isset($user)) {
           if ($uid == $user['id']) {
               echo '<a class="btn" href="/editinfo.php">Edit Info</a>';
           }else if ($saved) {
               echo "<span>Already in Rolodex!</span>";
           } else {
               echo '<form>
                    <input name="u" type="hidden" value="'.$uid.'"/>
                    <button name="save" type="submit">Add to Rolodex</button>
                    </form>';
           }
        }
      ?>
      <h2 class="userQR">Share Qard via QR code!</h2>
      <img class="qr" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
    </div>
    <?php echo $footer; ?>
</body>
</html>
