<!DOCTYPE html>
<html>
<head>
    <title>Qards - Dashboard</title>
    <?php include('head.php') ?>
</head>

<?php
include('util.php');

$related_users = null;
if (isset($user)) {
    $res = $db->query("SELECT * FROM (`users`, `relations`)
                       WHERE (( relations.user1 = ".$user['id']." AND relations.user2 = users.id )
                             OR ( relations.user1 = users.id AND relations.user2 = ".$user['id']." ));");
    if ($res->num_rows > 0) {
        $related_users = $res->fetch_all(MYSQLI_ASSOC);
    }
} else {
    header("Location: /login.php");
}
?>

<body>
<?php echo $header; ?>
    <div class="column centered">
        <h1 class="dashboardHeader">Dashboard</h1>
        <a class="btn" href="/user.php?u=<?php echo $user['id'] ?>">My Card</a>
        <a class="btn" href="/editinfo.php">Edit Info</a>
        <h1 class="dashboardRolodex">Rolodex</h1>

        <ul>
        <?php
             if (isset($related_users)) {
                foreach ($related_users as $rel) {
                    echo '<li><a href="/user.php?u='.$rel["id"].'">'.$rel["username"].'</a></li>';
                }
             } else {
                 echo "No contacts added yet.";
             }
         ?>
        </ul>
    </div>
<?php echo $footer; ?>
</body>
</html>
