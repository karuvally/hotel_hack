<!DOCTYPE html>
<html>
    <head>

        <title>Mandriva</title>

        <?php
        // do the essentials
        session_start();
        include("database.php");

        // go to the homepage of user
        if(!isset($_SESSION["target_page"]))
        {
            $_SESSION["target_page"] = "home.php";
        }
        
        header("location: " . $_SESSION["target_page"]);
        ?>
        
    </head>
</html>