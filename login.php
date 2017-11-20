<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva - Login</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

        <?php
            // do the essentials
            session_start();
            include("database.php");
    
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $post_username = $_POST["username"];
                $post_password = $_POST["password"];
                $users_query = "select user_id, type from users where username = '$post_username' and password = '$post_password'";
                $users_result = mysqli_query($connection, $users_query);
                $user_info = mysqli_fetch_array($users_result);
                $row_count = mysqli_num_rows($users_result);
                
                if($row_count == 1)
                {
                    $_SESSION['username'] = $post_username;
                    $_SESSION['user_id'] = $user_info['id'];
                    $_SESSION['user_type'] = $user_info['type'];

                    if($_SESSION['user_type'] == 'user')
                    {
                        $_SESSION['target_page'] = 'user.php';
                    }
                    elseif($_SESSION['user_type'] == 'root')
                    {
                        $_SESSION['target_page'] = 'admin.php';
                    }
                }
                else
                {
                    $_SESSION["target_page"] = "home.php";
                }
                
                header("location: ". $_SESSION["target_page"]);
            }
        ?>

        <script>
            function validateForm()
            {
                if(document.forms["login_form"]["username"].value == "")
                {
                    alert("Username must be filled!");
                    return false;
                }

                if(document.forms["login_form"]["password"].value == "")
                {
                    alert("Password must be filled!");
                    return false;
                }
            }
        </script>

    </head>

    <body>

        <form name="login_form" class="login_form" method="POST" action="#" onsubmit="return validateForm()">
            <label for="username">Username</label>
            <input type="text" name="username">
            <br>
            
            <label for="password">Password</label>
            <input type="password" name="password">
            <br>
         
            <input type="submit" value="Submit">
        </form>

    </body>
</html>