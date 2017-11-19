<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva - User home</title>

        <?php
        // do the essentials
        session_start();
        include("database.php");

        $booking_info_query = "select room_id, confirmed from booking_info where user_id='" . $_SESSION["user_id"] . "'";
        $booking_info_result = mysqli_query($connection, $room_id_query);
        $booking_info_readable = mysqli_fetch_array($booking_info_result);

        if($booking_info_readable["confirmed"] == True)
        {
            echo "Room: " . $booking_info_readable["room_id"] ."Confirmed!";
        }
        else
        {
            echo "You are in waiting list :(";
        }
        ?>
        
    </head>
</html>