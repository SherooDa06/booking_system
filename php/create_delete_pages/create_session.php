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
        <!--Get action used to show usertype in URL-->
        <div class="registerContent">
            <div id="userCreateForm">
                <form name="createSessionForm" method="post" class="userForms">
                    Subject:
                    <select name="subjectInput">
                        <option value="English">English</option>
                        <option value="Maths">Maths</option>
                        <option value="Science">Science</option>
                        <option value="Social Science">Social Science</option>
                    </select>
                    <br/><br/>
                    Date: <input type="text" name="dateInput" placeholder="YYYY-MM-DD"/>
                    <br/><br/>
                    Starting Time: <input type="text" name="timeInput" placeholder="HH:MM (24H)"/>
                    <br/><br/>
                    <input type="submit" value="Create" class="userEntryButton" name="sessionCreateButton"/>
                    <?php
                    if (isset($_POST['sessionCreateButton']))
                    {
                        $subjectName = $_POST['subjectInput'];
                        $mentorID = $_SESSION['loggedInID'];
                        $sessionDate = $_POST['dateInput'];
                        $startingTime = $_POST['timeInput'];

                        $createSessionRequest = "INSERT INTO sessionDetails (subjectName, mentorID, sessionDate, startingTime)  VALUES ('$subjectName', $mentorID, '$sessionDate', '$startingTime');";
                        $createSessionQuery = $connection->query($createSessionRequest);
                        if(!$createSessionQuery) echo "Query Succeeded";
                    }
                    ?>
                </form>
            </div>
            <div class="informationAboutForm">
                <h1 class="informationText">Create a New Session Offering</h1>
                <form name="continueForm" method="post" action="dashboard.php">
                    <input type="submit" value="Return to Dashboard" class="userEntryButton"/>
                </form>
            </div>
        </div>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>