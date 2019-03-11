<?php 
    $isEmailError = isset($emailErr);
    $emailValue = (isset($email)) ? $email : '';
    $isTempPasswordError = isset($tempPasswordErr);
    $isPasswordError = isset($passwordErr);
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>
    
    <h1>Change Temp Password</h1>
    
    <form class='sign-up-form' action="/password/reset-password" method='post'>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name='email' placeholder="Your email" value="<?= $emailValue ?>" required>
            <?php if ($isEmailError) { ?>
                <span><?= $emailErr ?></span>
            <?php } ?>
        </div>

        <div>
            <label for="TempPassword">Temporary password</label>
            <input type="password" id="TempPassword" name='tempPassword' type="hidden" placeholder="Your temp password" required>
            <?php if ($isTempPasswordError) { ?>
                <span><?= $passwordErr ?></span>
            <?php } ?>
        </div>

        <div>
            <label for="Password">Password</label>
            <input type="password" id="Password" name='password' type="hidden" placeholder="Your password" required>
            <?php if ($isPasswordError) { ?>
                <span><?= $passwordErr ?></span>
            <?php } ?>
        </div>
        
        <div>
            <label for="inputPasswordConf">Confirm Your Password</label>
            <input type="password" id="inputPasswordConf" name = 'passwordConf' type="hidden" placeholder="Confirm your password" required>
        </div>

        <input type="submit" value='Submit the change of your Temp Password'>
    </form>

    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>