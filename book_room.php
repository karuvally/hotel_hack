<!DOCTYPE html>
<html>

    <head>

        <title>Mandriva - Book room</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

        <?php
        // do the essentials
        session_start();
        include("database.php");

        // run this only if request method is POST
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {            
            // first search for rooms not booked for anyday
            $find_rooms_query = "select room_id from rooms where type='" . $_POST["room_type"] .
                "' and room_id not in(select room_id from booking_info)";
            $find_rooms_result = mysqli_query($connection, $find_rooms_query);

            // find the rest of the rooms if no unbooked rooms turn up
            if(mysqli_num_rows($find_rooms_result) == 0)
            {
                $find_rooms_query = "select room_id from rooms where type='" . $_POST["room_type"] . "'";
                $find_rooms_result = mysqli_query($connection, $find_rooms_query);
            }

            // allow booking only if book_flag is true
            $book_flag = True;
            
            // iterate through each resultant room
            while($find_rooms_readable = mysqli_fetch_array($find_rooms_result))
            {
                $room_id = $find_rooms_readable["room_id"];

                $booking_info_query = "select * from booking_info where room_id = '" .
                    $room_id . "'";
                
                $booking_info_result = mysqli_query($connection, $booking_info_query);
                
                // enter loop only if room is booked for anyday
                if(mysqli_num_rows($booking_info_result) != 0)
                {
                    // iterate through each entry for specific room, keep a flag
                    while($book_info_readable = mysqli_fetch_array($booking_info_result))
                    {
                        // check dates for which booking is confirmed
                        if($book_info_readable["confirmed"] == True)
                        {
                            // if check in dates clash, set book_flag as false
                            if(strtotime($_POST["check_in_date"]) > strtotime($book_info_readable["check_in_date"]) and
                                strtotime($_POST["check_in_date"]) < strtotime($book_info_readable["check_out_date"]))
                            {
                                $book_flag = False;
                                break;
                            }
                            
                            // if check out dates clash, set book_flag as false
                            elseif(strtotime($_POST["check_out_date"]) > strtotime($book_info_readable["check_in_date"]) and
                            strtotime($_POST["check_out_date"]) < strtotime($book_info_readable["check_out_date"]))
                            {
                                $book_flag = False;
                                break;
                            }
                        }
                    }
                }

                // create account for the user and place booking request if book_flag is true
                if($book_flag == True)
                {
                    $_SESSION["user_id"] = time();
                    $_SESSION["user_type"] = "user";
                    $_SESSION["target_page"] = "user.php";
                    
                    // create user account
                    $create_user_query = "insert into users values('" . $_SESSION["user_id"] .
                        "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "', 'user')";
                    
                    mysqli_query($connection, $create_user_query);
        
                    // insert guest information
                    $insert_guest_info_query = "insert into guests_info values('" . $_SESSION["user_id"] .
                        "', '" . $_POST["name"] . "', '" . $_POST["email"] . "', '" . $_POST["address"] .
                            "', '" . $_POST["phone"] . "')";
                    
                    mysqli_query($connection, $insert_guest_info_query);

                    // enter booking information
                    $insert_booking_info = "insert into booking_info values('', '" . $room_id . "', '" .
                        $_SESSION["user_id"] . "', '" . $_POST["check_in_date"] . "', '" .
                            $_POST["check_out_date"] . "', 'False')";
                    
                    mysqli_query($connection, $insert_booking_info);

                    // inform users of their username and password
                    echo "<form class='credentials_alert' method='GET' action='" . $_SESSION["target_page"] . "'>";
                        echo "Username: " . $_POST["email"] . "<br>";
                        echo "Password: " . $_POST["phone"] . "<br>";
                        echo "<input type='submit' value='Okay'>";
                    echo "</form>";
                    
                    // exit from the loop
                    break;
                }
            }

            // prompt user if no rooms are available
            if($book_flag == False)
            {
                header("location: fail_page.php");
            }
        }
        ?>
        
    </head>

    <body>

        <form class="booking_form" method="POST" action="#">
            <label for="name">Name</label>
            <input type="text" name="name"> <br>

            <label for="email">E-Mail</label>
            <input type="text" name="email"> <br>

            <label for="address">Address</label>
            <input type="text" name="address"> <br>

            <label for="phone">Phone</label>
            <input type="text" name="phone"> <br>

            <label for="arrival_date">Check In Date</label>
            <input type="date" name="check_in_date"> <br>

            <label for="departure_date">Check out Date</label>
            <input type="date" name="check_out_date"> <br>

            <select name="room_type">
                <option value="single">Single</option>
                <option value="double">Double</option>
            </select> <br>

            <input type="submit" value="Request room">
        </form>

    </body>

</html>