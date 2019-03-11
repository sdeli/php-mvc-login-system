<?php 
    $checked = ($isRememberLoginChecked) ? 'checked' : false;
    $isUserAlreadyLoggedIn = isset($_SESSION['userId']);

    if ($isUserAlreadyLoggedIn) {
        $homePagePath = '/';
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $homePagePath, true, 303);
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>
    
    <h1>Log In</h1>

    <?php if (isset($deniedLoginMsg)) { ?>
        <h3><?= $deniedLoginMsg ?></h3>
    <?php } ?>

    <form action="/log-in/may-log-in-user" method='post'>
        <div>
            <label for="inputEmail">Your Email</label>
            <input type="email" id='inputEmail' name='email' placeholder='Type in your email for login' autofocus value='<?= $email ?>' required>
        </div>

        <div>
            <label for="inputPassword">Your Password</label>
            <input type="password" id='inputPassword' name='password' placeholder='Type in your password please' required>
        </div>

        <div>
            <input type="checkbox" id='rememberLogin' name="rememberLogin"<?= $checked ?>>
            <label for="#rememberLogin">Remember login</label>
        </div>

        <button type='submit'>log-in</button>
        <a href="/password/forgot-page">forgot password</a>
    </form>

    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>