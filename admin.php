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
                // draw the table heading
                echo "<table>";
                    
                    echo "<tr>";
                        echo "<th>ROOM ID</th>";
                        echo "<th>BOOKING ID</th>";
                        echo "<th>CHECK IN DATE</th>";
                        echo "<th>CHECK OUT DATE</th>";
                        echo "<th>BOOKING</th>";
                    echo "</tr>";

                        $rooms_query = "select room_id from rooms";
                        $rooms_result = mysqli_query($connection, $rooms_query);
                        
                        while($rooms_readable = mysqli_fetch_array($rooms_result))
                        {
                            $booking_query = "select * from booking_info where room_id='" .
                                $rooms_readable["room_id"] . "'";

                            $booking_result = mysqli_query($connection, $booking_query);

                            while($booking_readable = mysqli_fetch_array($booking_result))
                            {
                                $show_flag = 1;

                                if($_POST["search_type"] == "booked" && $booking_readable["confirmed"] == False)
                                {
                                    $show_flag = 0;
                                }
                                elseif($_POST["search_type"] == "requested" && $booking_readable["confirmed"] == True)
                                {
                                    $show_flag = 0;
                                }

                                if($show_flag)
                                {
                                    echo "<tr>";
                                        echo "<td>" . $rooms_readable["room_id"] . "</th>";
                                        echo "<td>" . $booking_readable["booking_id"] ."</th>";
                                        echo "<td>" . $booking_readable["check_in_date"] . "</th>";
                                        echo "<td>" . $booking_readable["check_out_date"] ."</th>";
                                        
                                        echo "<td>";
                                        echo "<form class='button_form' method='POST' action='edit_booking.php'>";
                                            echo "<input type='hidden' name='room_id' value='" . $rooms_readable["room_id"] . "'>";
                                            
                                            if($booking_readable["confirmed"] == True)
                                            {
                                                echo "<input type='hidden' name='purpose' value='revoke'>";
                                                echo "<input type='submit' value='Revoke'>";
                                            }
                                            else
                                            {
                                                echo "<input type='hidden' name='purpose' value='confirm'>";
                                                echo "<input type='submit' value='Confirm'>";
                                            }
                                        echo "</form>";
                                        echo "</td>";

                                    echo "</tr>";
                                }
                            }
                            
                            // show rooms not booked anyday if admin chooses all search
                            if($_POST["search_type"] == "all")
                            {
                                if(mysqli_num_rows($booking_result) == 0)
                                {
                                    echo "<tr>";
                                        echo "<td>" . $rooms_readable["room_id"] . "</th>";
                                        echo "<td>NA</th>";
                                        echo "<td>NA</th>";
                                        echo "<td>NA</th>";
                                        echo "<td>NA</th>";
                                    echo "</tr>";
                                }
                            }
                        }
                    
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

        <form class="logout_form" method = "POST" action="home.php">
            <input type="submit" value="Logout">
        </form>

    </body>
</html>