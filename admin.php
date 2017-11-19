<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva - Home</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

        <?php
            // do the essentials
            session_start();
            include("database.php");

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                echo "<table>";
                    echo "<tr>";
                        echo "<th>ROOM ID</th>";
                        echo "<th>CHECK ID</th>";
                    echo "</tr>";
                echo "</table>";
            }
        ?>

    </head>

    <body>

        <div class="admin_menu">
            <form method="POST" action="#">
                <input type="text" name="search_term">
                <select name="search_type">
                    <option value="all">All</option>
                    <option value="booked">Booked</option>
                    <option value="requested">Requested</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>

    </body>
</html>