<div class='flash-notifs'>

    <?php foreach ($flasNotifications as $currNotfification) { ?>
        <div class="flash-notifs__notif flash-notifs__notif--<?= $currNotfification['type'] ?>" >
            <p class='flash-notifs__notif__p'><?= $currNotfification['body'] ?></p>
        </div>
    <?php } ?>
    
</div>