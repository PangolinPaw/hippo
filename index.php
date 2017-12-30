<?php
    include 'includes/database.php';
    
    function log_out() {
        setcookie("hippo_session", "", time()-3600, "/");
        unset($_COOKIE["hippo_session"]);
        header('Location: /hippo/login.php');
    }

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

    if ( isset($_POST["log_out"]) ) {
        log_out();
    }
    // CONTINUE HERE
    $primary = $db->query('SELECT population.NAME, genetics.NAME, HEAD_1, BODY_1, EYE_1, TUSK_1, TAIL_1, COAT_1, HAPPY_1, INTELLIGENT_1 FROM genetics INNER JOIN population ON population.GENOTYPE=genetics.GENOTYPE WHERE population.OWNER="' . $user . '" AND STATUS="primary"');
    $primary = $primary->fetchArray();

    $hippo_name = $primary[0];
    $genotype_name = $primary[1];
    $image = sprintf('%02d', $primary[2]) . sprintf('%02d', $primary[3]) . sprintf('%02d', $primary[4]) . sprintf('%02d', $primary[5]) . sprintf('%02d', $primary[6]) . sprintf('%02d', $primary[7]) . '.png';
    error_log('>>> $image = ' .  $image);
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
            <div class="settings blue_bright" onclick="document.getElementById('log_out').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
            <form id="log_out" method="post">
                <input type="hidden" name="log_out" value="1" />
            </form>
            <div class="spacer"></div>
            <div class="animal_window">
                <!-- Animal -->
                <div class="primary" style="background-image: url(/hippo/media/animal/<?php echo $image; ?>)">
                </div>
                <div class="name">
                    <?php echo $hippo_name . ' <span>(' . $genotype_name . ')</span>'; ?>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="animal_menu">
                <table>
                    <tr>
                        <th><i class="fa fa-smile-o yellow-font" aria-hidden="true"></i></th>
                        <td>
                            <div class="bar">
                                <div class="fill yellow">&nbsp;</div>
                                <div class="fill yellow">&nbsp;</div>
                            </div>
                        </td>
                        <th><i class="fa fa-puzzle-piece blue-font" aria-hidden="true"></i></th>
                        <td>
                            <div class="bar">
                                <div class="fill blue">&nbsp;</div>
                            </div>
                        </td>
                        <th><i class="fa fa-heartbeat red-font" aria-hidden="true"></i></th>
                        <td>
                            <div class="bar">
                                <div class="fill red">&nbsp;</div>
                                <div class="fill red">&nbsp;</div>
                                <div class="fill red">&nbsp;</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="tiles">
                <!-- Tiles -->
                <a href="shop.php"><div class="shop"></div></a>
                <a href="contest.php"><div class="contest"></div></a>
                <a href="family.php"><div class="family"></div></a>
                <a href="park.php"><div class="park"></div></a>
            </div>
        </div>
    </body>
</html>

