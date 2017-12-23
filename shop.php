<?php
    include 'includes/database.php';
    // Redirect to homepage if not logged in or if password in cookie is incorrect
    if(isset($_COOKIE["hippo_session"])) {
        $user_data = explode("|", $_COOKIE["hippo_session"]);
        $user = $user_data[0];
        $password = $user_data[1];
        $saved_password = $db->query('SELECT PASSWORD FROM users WHERE USERNAME="' . $user . '"');
        $saved_password = $saved_password->fetchArray()[0];
        if ( $saved_password != $password ) {
            setcookie("hippo_session", "", time()-3600, "/");
            unset($_COOKIE["hippo_session"]);
            header('Location: /hippo/login.php');
        }
    } else {
        header('Location: /hippo/login.php');
    }

?>
<html>
    <head>
        <?php include 'includes/head.php'; ?>
    </head>
    <body>
        <?php
        // Random background
        $bg_array = array('background_ldn.png', 'background_sf.jpg', 'background_ny.jpg');
        $bg_img = $bg_array[array_rand($bg_array)];

        echo '<style>
                body {
                    background-image: url("/hippo/media/general/' . $bg_img . '");
                }
            </style>';
        ?>
        <div class="container">
            <a href="index.php">
                <div class="settings"><i class="fa fa-home" aria-hidden="true"></i></div>
            </a>
            <div class="banner blue_bright">
                <h2 style="font-family: 'Satisfy', cursive;">The Corner Shop</h2>
            </div>
            <div class="spacer"></div>
            <div class="animal_menu">
                <p>Hello, come in!</p>
                <p>Please feel free to browse and don't forget to check out today's special offer.</p>
            </div>
            <div class="spacer"></div>
            <div class="tiles">
                <!-- Tiles -->
                <div class="blue">special offer item</div>
                <div class="blue_bright">item</div>
                <div class="blue_bright">item</div>
            </div>
        </div>
    </body>
</html>
