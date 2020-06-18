<!DOCTYPE html>
<html>
<head>
    <title>Qards - Home</title>
    <?php include('head.php') ?>
</head>

<?php
include('util.php');
?>

<body>
    <?php echo $header; ?>
    <div class="column centered">
        <h1>Welcome to the New Standard.</h1>
        
        <h2>Minimalist business cards for the busy Professional</h2>

        <div class="card">
            <h2 class="typing">John Smith</h2>
            <h4 class="typing">Co-Founder of Qards</h4>

            <h3 class="typing">123 Simple Street</h3>
            <h3 class="typing">Troy, NY 12180</h3>

            <h3 class="typing">johnsmith@qards.pro</h3>
            <h3 class="typing">123-456-7890</h3>
        </div>

        <p class="homepageInfo">Traditional business cards can be costly and a hassle to keep all in one place. Qards has set out to change that standard by completely digitizing the process. Join now and create a simple yet elegant qard then share and save qards with others!</p>

        <a class="btn signupButton" href="/signup.php">Sign Up!</a>
    </div>
    <?php echo $footer; ?>
</body>
</html>
