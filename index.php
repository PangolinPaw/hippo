<html>
    <head>
        <title>H</title>
        <link rel="stylesheet" href="styles/main.css">
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
        <div class="container">
            <div class="settings">
                <i class="demo-icon icon-cog">&#xe802;</i>
            </div>
            <div class="spacer"></div>
            <div class="animal_window">
                <!-- Animal -->
                <img src="/media/animal/hippo_000.jpg" />
            </div>
            <div class="animal_menu">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="tiles">
                <!-- Tiles -->
                <div>
                    <!-- Shop -->
                </div>
                <div>
                    <!-- Competition -->
                </div>
            </div>
        </div>
    </body>
</html>