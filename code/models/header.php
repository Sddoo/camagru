<?php


session_start();


?>

<header>
    <div id="header_content_wrap">
        <div id="header_logo"><a href="/index.php">SUPPA DUPPA PUPPA INSTAGRAM</a></div>
        <div id="user_features_wrap">
        <?php
            if ($_SESSION['logged_on_user']) {
                echo ("<a href='/php/settings.php'> <img class='user_features_wrap_images' src='/site_images/settings.svg' alt='settings'> </a> 
                    <a href='/php/logout.php'> <img class='user_features_wrap_images' src='/site_images/logout.svg' alt='logout'> </a> 
                    <a href='/php/account_page.php'> <img class='user_features_wrap_images' src='/site_images/account.svg' alt='account'> </a> ");
            } else {
                echo("<a href='/php/logging_in.php'> <img class='user_features_wrap_images' src='/site_images/logging_in.svg' alt='logging_in'> </a> <br>
                    <a href='/php/sign_up.php'> <img class='user_features_wrap_images' src='/site_images/sign_up.svg' alt='sign_up'> </a>");
            }
        ?>
        </div>
    </div>
</header>

