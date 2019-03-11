<?php 
    $isNameError = isset($nameErr);
    $nameValue = (isset($name)) ? $name : '';
    $isEmailError = isset($emailErr);
    $emailValue = (isset($email)) ? $email : '';
    $isPasswordError = isset($passwordErr);
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../App/views/partials/header.php'; ?>
<body>
    <?php include '../App/views/partials/flash-notification.php'; ?>
    
    <h1>Sign Up</h1>
    
    <form class='sign-up-form' action="/sign-up/create" method='post'>
        <div>
            <label for="inputName">Name</label>
            <input type="text" id="inputName" name='name' placeholder="Your choosen user name" value="<?= $nameValue ?>" required>
            <?php if ($isNameError) { ?>
                <span><?= $nameErr ?></span>
            <?php } ?>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name='email' placeholder="Your email" value="<?= $emailValue ?>" required>
            <?php if ($isEmailError) { ?>
                <span><?= $emailErr ?></span>
            <?php } ?>
        </div>
        
        <div>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name='password' type="hidden" placeholder="Your password" required>
            <?php if ($isPasswordError) { ?>
                <span><?= $passwordErr ?></span>
            <?php } ?>
        </div>
        
        <div>
            <label for="inputPasswordConf">Confirm Your Password</label>
            <input type="password" id="inputPasswordConf" name = 'passwordConf' type="hidden" placeholder="Confirm your password" required>
        </div>

        <input type="submit" value='click me'>
    </form>

    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>