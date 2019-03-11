<?php
    $isUserLoggedIn = isset($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>

    <h1>Home</h1>
    <?php if ($isUserLoggedIn) { ?>
        <a href="/log-in/log-out-user-route">Log out</a><br>
        <a href="/profile/view">view your profile page</a>
    <?php } else { ?>
        <a href="/login">Login Page</a>
        <a href="/signup">Signup Page</a>
    <?php } ?>

    <?php if ($currUser) { ?>
        <div><?= var_dump($currUser) ?></div>
    <?php } ?>
    
    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>