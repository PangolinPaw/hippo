<html>
    <head>
        <?php include 'includes/head.php'; ?>
    </head>
    <body>
        <?php
            $bg_array = array('background_falls.gif', 'background_forest.gif', 'background_spring.gif', 'background_woods.gif');
            $bg_img = $bg_array[array_rand($bg_array)];

            echo '<style>
                    body {
                        background-image: url("/media/general/' . $bg_img . '");
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
                    <form>
                        <input type="text" name="username" placeholder="username" />
                        <input type="password" name="password" placeholder="password" />
                    </form>
                </div>
            </div> <!-- /login-window -->
        </div>
    </body>
</html>