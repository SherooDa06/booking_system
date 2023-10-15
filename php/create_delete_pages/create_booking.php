<?php 
require "../connection.php";

session_start();

function returnURL()
{
    $url = $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

global $sessionIDForNewBooking; $sessionIDForNewBooking = -1;

$getAllSessionOfferingsSQL = "SELECT sessionID FROM sessionDetails;";
$getAllSessionOfferingsQuery = $connection->query($getAllSessionOfferingsSQL);

while($retrievedSessionID = $getAllSessionOfferingsQuery->fetch_assoc())
{
    $sessionIDInURL = strval($retrievedSessionID['sessionID']);
    $selectButtonSring = "selectButton";

    if (strpos(returnURL(), $selectButtonSring .= $sessionIDInURL .= '='))
    {
        $sessionIDForNewBooking = intval($sessionIDInURL);
        break;
    } 
        
}

$getSessionOfferingSQL = "SELECT sessionDetails.subjectName, mentorDetails.firstName, mentorDetails.lastName, sessionDetails.sessionDate, sessionDetails.startingTime FROM sessionDetails, mentorDetails WHERE sessionDetails.sessionID = $sessionIDForNewBooking AND sessionDetails.mentorID = mentorDetails.mentorID;";
$getSessionOfferingQuery = $connection->query($getSessionOfferingSQL);

global $subjectName, $mentorID, $mentorFirstName, $mentorLastName, $sessionDate, $startingTime;

while ($retrievedSession = $getSessionOfferingQuery->fetch_assoc())
{
    $subjectName = $retrievedSession['subjectName'];
    $mentorFirstName = $retrievedSession['firstName'];
    $mentorLastName = $retrievedSession['lastName'];
    $sessionDate = $retrievedSession['sessionDate'];
    $startingTime = $retrievedSession['startingTime'];
}
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
                <form class="userForms" method="post" style="margin-left: 20%;">
                    <?php echo "Session ID: " . $sessionIDForNewBooking . "<br/><br/>";?>
                    <?php echo "Subject: " . $subjectName . "<br/><br/>";?>
                    <?php echo "Mentor: " . $mentorFirstName . ' ' . $mentorLastName . "<br/><br/>";?>
                    <?php echo "Date: " . $sessionDate . '<br/><br/>';?>
                    <?php echo "Time: " . $startingTime;?>
                </form>
            </div>
            <div>
                <h1 class="informationText">Create a New Booking</h1>
                <form name="createBookingForm" method="post">
                    Duration: <input type="text" value="30" placeholder="Minutes" name="durationInput"/> <br/><br/>
                    <input type="submit" class="userEntryButton" value="Create Booking" name="createBookingButton"/> </br></br>
                    <input type="submit" class="userEntryButton" value="Return to Dashboard" name="returnToDashboardButton" formaction="../dashboard.php"/>
                </form>
                <?php 
                if (isset($_POST['createBookingButton']))
                {
                    $menteeID = $_SESSION['loggedInID'];
                    $bookingDuration = $_POST['durationInput'];

                    $createBookingSQL = "INSERT INTO bookingDetails (menteeID, sessionID, duration) VALUES ($menteeID, $sessionIDForNewBooking, $bookingDuration);";
                    $updateSessionBookedSatusSQL = "UPDATE sessionDetails SET isBooked = 1 WHERE sessionID = $sessionIDForNewBooking;";
                    $createBookingQuery = $connection->query($createBookingSQL);
                    $updateSessionBookedStatusQuery = $connection->query($updateSessionBookedSatusSQL);

                    if($createBookingSQL && $updateSessionBookedStatusQuery) echo "New booking successfully created";
                    else echo "New booking creation failed";
                }
                ?>
            </div>    
        </div>

        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>