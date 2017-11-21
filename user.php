<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva - User home</title>

        <?php
        // do the essentials
        session_start();
        include("database.php");

        $booking_info_query = "select room_id, confirmed from booking_info where user_id='" . $_SESSION["user_id"] . "'";

        $booking_info_result = mysqli_query($connection, $booking_info_query);
        $booking_info_readable = mysqli_fetch_array($booking_info_result);

        if(mysqli_num_rows($booking_info_result) == 0)
        {
            echo "No rooms available at the moment :(";
        }
        
        elseif($booking_info_readable["confirmed"] == True)
        {
            echo "Room: " . $booking_info_readable["room_id"] ."Confirmed!";
        }
        
        elseif($booking_info_readable["confirmed"] == False)
        {
            echo "You are in waiting list :(";
        }

        ?>
        
    </head>

    <body>
        <form class="logout_form" method = "POST" action="home.php">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>