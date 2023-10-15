<?php 

require "connection.php";

session_start();

$_SESSION['loggedInID'] = 0;

// Custom function return url of login page
function returnURL()
{
    $url = $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

$pageURL = returnURL();

// strpos() function used to check for certain feature in url;
$isMentee = strpos($pageURL, "menteeEntry=Mentee");
$isMentor = strpos($pageURL, "mentorEntry=Mentor");
$isSupervisor = strpos($pageURL, "supervisorEntry=Supervisor");

if($isMentee) {  $_SESSION['typeOfUserID'] = 0;  }
else if ($isMentor) { $_SESSION['typeOfUserID'] = 1; }
else if ($isSupervisor) { $_SESSION['typeOfUserID'] = 2; }

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
        <form name="loginForm" method="post" action="login.php" id="loginForm">
            <br/>Enter your name:
            <input type="text" name="firstName" placeholder="First Name"/>
            <input type="text" name="lastName" placeholder="Last Name"/>
            <br/><br/>
            <input type="submit" name="loginSubmit" value="Login" class="userEntryButton"/>
            <br/><br/>
            <?php 
                if($isMentee) {  $_SESSION['typeOfUserID'] = 0;  }
                else if ($isMentor) { $_SESSION['typeOfUserID'] = 1; }
                else if ($isSupervisor) { $_SESSION['typeOfUserID'] = 2; }
            ?>
        </form>
        <?php

        $sqlRequest = "";
        function returnQuery($conn, $sql, $userType)
        {
            $queryResult = $conn->query($sql);
            
            if ($queryResult->num_rows == 0)
            {
                // Form that promts user to return to index page
                ?> 
                <br/>
                <form name="emptyQueryForm" method="post" action="_index.php" style="text-align: center">
                    Cannot find a user with that name. </br>
                    <input type="submit" name="goBack" value="Go Back" class="userEntryButton"/>
                </form>
            <?php
            } 
            else
            {
                while ($row = $queryResult->fetch_assoc())
                { ?>            
                    <form id="conformationForm" name="confirmDeny" method="post">
                        ID: <?php 
                            if ($userType == 0) { echo $row['menteeID']; $_SESSION['loggedInID'] = intval($row['menteeID']); }
                            else if ($userType == 1) { echo $row['mentorID']; $_SESSION['loggedInID'] = intval($row['mentorID']); }
                            else if ($userType == 2) { echo $row['supervisorID']; $_SESSION['loggedInID'] = intval($row['supervisorID']); }
                            ?>
                        <br/>  
                        Name: <?php echo $row['firstName']; echo ' '; echo $row['lastName']; ?>
                       <br/>
                        <?php 
                            if ($userType == 2) { ?> Date Of Birth: <?php echo $row['dateOfBirth']; }
                            else { ?> Year Level: <?php echo $row['yearLevel']; }
                        ?>
                        </br>
                        <!--formaction attribute makes different buttons lead to different pages-->
                        <input type="submit" name="confirm" value="Confirm" class="userEntryButton" formaction="dashboard.php"/>
                        <input type="submit" name="deny" value="Deny" class="userEntryButton" formaction="_index.php"/>
                    </form>
                <?php }
            }
        }

        if (isset($_POST['loginSubmit']))
        {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            
            if ($_SESSION['typeOfUserID'] == 0)
            {
                $sqlRequest = "SELECT menteeID, firstName, lastName, yearLevel FROM menteeDetails WHERE firstName = '$firstName' AND lastName = '$lastName';";
            }    
                
            
            else if ($_SESSION['typeOfUserID'] == 1)
                $sqlRequest = "SELECT mentorID, firstName, lastName, yearLevel FROM mentorDetails WHERE firstName = '$firstName' AND lastName = '$lastName';";

            else if ($_SESSION['typeOfUserID'] == 2)
                $sqlRequest = "SELECT supervisorID, firstName, lastName, dateOfBirth FROM supervisorDetails WHERE firstName = '$firstName' AND lastName = '$lastName';";

            returnQuery($connection, $sqlRequest, $_SESSION['typeOfUserID']);
        }
        ?>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>