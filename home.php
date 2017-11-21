<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva - Home</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                session_destroy();
            }
        ?>

    </head>

    <body>

        <div class="home_page_buttons">
            <input type="button" value="Book room" onclick="window.location.href='book_room.php'">
            <input type="button" value="Login" onclick="window.location.href='login.php'">
        </div>

    </body>
</html>