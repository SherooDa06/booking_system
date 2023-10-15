<?php 
require "connection.php";

session_start();

// The type of user ID is assigned to -1 because it often imli
$_SESSION['typeOfUserID'] = -1;
$_SESSION['loggedInID'] = -1;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>CSHS Booking System</title>
        <link rel="stylesheet" href="../style/style.css"/>
        <meta charset="utf-8"/>
    </head>
    <body>
        <header>
            <a href="_index.php" id="titleLink"><h1>WELCOME TO CSHS TUTORING PROGRAM</h1></a>
        </header>
        <!--Get action used to show usertype in URL-->
        <div class="indexContent">
            <form name="lobbyForm" method="get" action="login.php" id="indexForm">
                <br/>   
                I log in as a... <br/><br/>
                <input type="submit" value="Mentee" name="menteeEntry" class="userEntryButton"/>
                <br/><br/>
                <input type="submit" value="Mentor" name="mentorEntry" class="userEntryButton"/>
                <br/><br/>
                <input type="submit" value="Supervisor" name="supervisorEntry" class="userEntryButton"/>
                <br/><br/>
            </form>
            <form name="unrigisteredEntry" method="post" id="unregisteredForm" action="register.php">
                <br/>
                Not registered?
                <br/><br/>
                <input type="submit" value="Register Now!" class="userEntryButton" id="registerButton"/>
            </form>
        </div>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>