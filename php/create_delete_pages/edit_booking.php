<?php 
require "../connection.php";

session_start();


?>
<!DOCTYPE html>
<html>
    <head>
        <title>CSHS Booking System</title>
        <link rel="stylesheet" href="../../style/style.css"/>
        <meta charset="utf-8"/>
    </head>
    <body>
        <header>
            <a href="../_index.php" id="titleLink"><h1>WELCOME TO CSHS TUTORING PROGRAM</h1></a>
        </header>
        <div class="indexContent">
            <div>
                <form method="post" id="editBookingForm">
                    New Duration: <input name="newDurationInput" placeholder="Minutes"/>
                </form>
            </div>
            <div>
                <h1 class="informationText">Edit A Booking</h1>
            </div>
        </div>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>