<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<?php if (isset($siteId) && $siteId === 'sign-up') { ?>
   <script
    src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src='/js/sign-up-form.js'></script>
    <script src='/js/hideShowPassword.min.js'></script>
    <script>
        $('#inputPassword').hideShowPassword(true, true);
        $('#inputPasswordConf').hideShowPassword(true, true);
    </script>
<?php } else if (isset($siteId) && $siteId === 'profile') { ?>
    <script
    src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

    <script src='/js/change-profile-info-form.js'></script>
    <script src='/js/hideShowPassword.min.js'></script>
    <script>
        $(document).ready(() => {
            var userId = <?= $userId ?>;
            addFormValidation(userId);
        });

        $('#inputPassword').hideShowPassword(true, true);
        $('#inputPasswordConf').hideShowPassword(true, true);
    </script>
<?php } ?>
