<?php
    $isUserLoggedIn = isset($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>

    <h4>A temporary has been sent to do the '<?= $email ?>' email address, with that you can change your current passowrd on the given link - highlighted in the email.</h4>
    
    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>