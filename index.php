<html>
    <head>
        <title>H</title>
        <link rel="stylesheet" href="styles/main.css">
        <script src="https://use.fontawesome.com/af584466b2.js"></script>
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
                
            </div>
            <div class="spacer"></div>
            <div class="animal_window">
                <div class="name">
                    Hippo name
                </div>
                <!-- Animal -->
                <div class="primary" style="background-image: url(/media/animal/0100010100.png)">
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
                <div class="shop"></div>
                <div class="contest"></div>
                <div class="family"></div>
                <div class="park"></div>
            </div>
        </div>
    </body>
</html>