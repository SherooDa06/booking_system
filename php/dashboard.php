<?php 
require "connection.php"; 

session_start();

$firstName = '';
$lastName = '';
$emailAddress = '';

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
        <div class="webpageContent">
            <?php 

            $logInID = intval($_SESSION['loggedInID']);
            $loggedInUserSQLRequest = "";

            if($_SESSION['typeOfUserID'] == 0) 
                $loggedInUserSQLRequest = "SELECT firstName, lastName, yearLevel, emailAddress FROM menteeDetails WHERE menteeID = $logInID;";
            else if ($_SESSION['typeOfUserID'] == 1)
                $loggedInUserSQLRequest = "SELECT firstName, lastName, yearLevel, emailAddress FROM mentorDetails WHERE mentorID = $logInID;";
            else if ($_SESSION['typeOfUserID'] == 2)
                $loggedInUserSQLRequest = "SELECT firstName, lastName, dateOfBirth, emailAddress FROM supervisorDetails WHERE supervisorID = $logInID;";

            $logInQuery = $connection->query($loggedInUserSQLRequest);
            
            global $yearLevel, $dateOfBirth;
            
            while ($row = $logInQuery->fetch_assoc())
            {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $emailAddress = $row['emailAddress'];

                if ($_SESSION['typeOfUserID'] == 1 || $_SESSION['typeOfUserID'] == 0) 
                    $yearLevel = $row['yearLevel'];
                else if ($_SESSION['typeOfUserID'] == 2) 
                    $dateOfBirth = $row['dateOfBirth'];
            }
            ?>

            <div class="userDashboard">
                <div id="accountDisplay">
                    <h2>
                        <?php echo $firstName . ' ' . $lastName;?>
                    </h2>
                    <?php 
                    if ($_SESSION['typeOfUserID'] < 2) 
                        { ?><h3>Year Level: <?php echo $yearLevel; }
                    else if ($_SESSION['typeOfUserID'] == 2) 
                        { ?>Date of Birth: <?php echo $dateOfBirth; }
                    ?>
                    <h3>Email: <?php echo $emailAddress;?></h3>
                    <?php 
                    if ($_SESSION['typeOfUserID'] == 0)
                    {
                        ?>
                        <form method="post">
                            <input type="submit" name="availableBookings" class="userEntryButton" value="Available Sessions"/><br/><br/>
                            <input type="submit" name="bookedBookings" class="userEntryButton" value="Booked Session"/>
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <div id="dasboardContent">
                    <div id="sessionOfferings">
                        <?php
                        if ($_SESSION['typeOfUserID'] == 0) include "dashboard/mentee_dashboard.php";
                        else if ($_SESSION['typeOfUserID'] == 1) include "dashboard/mentor_dashboard.php";
                        ?>
                    </div>
                    <?php 
                    if ($_SESSION['typeOfUserID'] == 1)
                    {
                        ?>
                        <form action="create_delete_pages/create_session.php">
                            <input type="submit" value="New Session" class="userEntryButton" id="createSessionButton"/>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>