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
    
    <h1>Profile</h1>
    
    <div> 
        <h3>Your Deatls</h3>
        
        <dl>
            <dt>Name:</dt>
            <dd><?= $name ?></dd>
            <dt>Email:</dt>
            <dd><?= $email ?></dd>
        </dl>
    </div>

    <form class='profile-details-form' action="/profile/edit" method='post'>
        <div>
            <h3>Change your details</h3>
        </div>

        <div>
            <label for="inputName">Name</label>
            <input type="text" id="inputName" name='name' placeholder="Your choosen user name" value="<?= $nameValue ?>" required>
            <?php if ($isNameError) { ?>
                <span><?= $nameErr ?></span>
            <?php } ?>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name='email' placeholder="Your email" value="<?= $emailValue ?>">
            <?php if ($isEmailError) { ?>
                <span><?= $emailErr ?></span>
            <?php } ?>
        </div>
        
        <div>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name='password' type="hidden" placeholder="Your password">
            <span>leave password field blank if you dont want to change it</span>
            <?php if ($isPasswordError) { ?>
                <span><?= $passwordErr ?></span>
            <?php } ?>
        </div>

        <div>
            <label for="inputPasswordConf">Password</label>
            <input type="password" id="inputPasswordConf" name='passwordConf' type="hidden" placeholder="Your password">
            <?php if ($isPasswordError) { ?>
                <span><?= $passwordErr ?></span>
            <?php } ?>
        </div>

        <input type="submit" value='click me'>
    </form>

    <?php include '../App/views/partials/scripts.php'; ?>
</body>
</html>