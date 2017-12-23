<?php
    include 'includes/database.php';
    // Log in
    if ( isset($_POST['username']) ) {
        $user = $_POST['username'];
        $password = $_POST['password'];
        if ( $user != "" and $password != "" ) {
            $saved_password = $db->query('SELECT PASSWORD FROM users WHERE USERNAME="' . $user . '"');
            $saved_password = $saved_password->fetchArray()[0];
            if ( $saved_password == $password ) {
                $cookie_name = "hippo_session";
                $cookie_value = $user . "|" . $password;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                header('Location: /hippo/index.php');
            } else {
                $error_message = "Username or password not recognised, please try again";
            }
        } else {
            $error_message = "Please enter a username and password";
        }
    }

    // Logged in, go to index
	if(isset($_COOKIE["hippo_session"])) {
		header('Location: /hippo/index.php');
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
        <div class="aligner">
            <div class="login-window">
                <div class="welcome">
                    Welcome to
                </div>
                <br />
                <br />
                <br />
                <br />
                <div class="sign">
                    Hippopolis
                </div>
                <div class="login-form">
                    <form id="login_form" method="post">
                        <input type="text" name="username" placeholder="username" />
                        <input type="password" name="password" placeholder="password" />
			<div class="login-button" onclick="document.getElementById('login_form').submit();">
				Log in
			</div>
                    </form>
			<?php
				echo '<p class="red-font"><em>' . $error_message . '</em></p>';
			?>

                </div>
            </div> <!-- /login-window -->
        </div>
    </body>
</html>
