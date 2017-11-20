<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva</title>

        <?php
        // do the essentials
        session_start();
        include("database.php");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if($_POST["purpose"] == "revoke")
            {
                $remove_booking_query = "delete from booking_info where room_id = '" .
                    $_POST["room_id"] . "' and confirmed = True";
                
                mysqli_query($connection, $remove_booking_query);

                // remove guest information
                // remove user information
            }

            if($_POST["purpose"] == "confirm")
            {
                $confirm_query = "update booking_info set confirmed = True where room_id='" .
                    $_POST["room_id"] . "'";
                
                mysqli_query($connection, $confirm_query);

                // remove unconfirmed rooms
            }

            // return to admin page
            //header("location: " . $_SESSION["target_page"]);
        }
        ?>
        
    </head>
</html>