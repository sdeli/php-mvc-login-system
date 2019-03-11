<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
<?php include '../App/views/partials/flash-notification.php'; ?>

<h1>Request password reset</h1>

<form method="post" action='/password/request-pwd-reset'>

    <div>
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" name="email" placeholder="Email address" value="<?=$usersEmail?>" autofocus required />
    </div>

    <button type="submit">Send password reset</button>
</form>

<?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>
