<?php 
require "../connection.php";

session_start();

function returnURL()
{
    $url = $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

global $bookingIDForUnwantedBooking; $bookingIDForUnwantedBooking = -1;

$getAllBookedSessionIDsSQL = "SELECT bookingID FROM bookingDetails;";
$getBookedSessionIDsQuery = $connection->query($getAllBookedSessionIDsSQL);

while($retrievedBookingID = $getBookedSessionIDsQuery->fetch_assoc())
{
    $bookingIDInURL = strval($retrievedBookingID['bookingID']);
    $deleteButtonSring = "deleteButton";

    if (strpos(returnURL(), $deleteButtonSring . $bookingIDInURL . '='))
    {
        $bookingIDForUnwantedBooking = intval($bookingIDInURL);
        break;
    } 
        
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
        <!--Get action used to show usertype in URL-->
        <div>
            <h2 class="informationText" style="text-align: center; font-size: 48px;">Are You Sure You Want To Delete The Booking?</h2>
        </div>
        <div class="indexContent">
            <div style="padding-left: 20%;">
                <?php 
                $getBookedSessionDetailsSQL = "SELECT bookingDetails.sessionID, sessionDetails.subjectName, mentorDetails.firstName, mentorDetails.lastName, sessionDetails.sessionDate, sessionDetails.startingTime FROM bookingDetails, sessionDetails, mentorDetails WHERE bookingDetails.sessionID = sessionDetails.sessionID AND sessionDetails.mentorID = mentorDetails.mentorID AND bookingDetails.bookingID = $bookingIDForUnwantedBooking;";
                $getBookedSessionDetailsQuery = $connection->query($getBookedSessionDetailsSQL);
                while($bookedSession = $getBookedSessionDetailsQuery->fetch_assoc())
                {
                    $sessionID = $bookedSession['sessionID'];
                    $subjectName = $bookedSession['subjectName'];
                    $mentorName = $bookedSession['firstName'] . ' ' . $bookedSession['lastName'];
                    $sessionDate = $bookedSession['sessionDate'];
                    $startingTime = $bookedSession['startingTime'];
                    ?>
                    <form>
                        <?php echo "Session ID: " . $sessionID . "<br/>";?>
                        <?php echo "Subject: " . $subjectName . "<br/>";?>
                        <?php echo "Mentor: " . $mentorName . "<br/>";?>
                        <?php echo "Date: " . $sessionDate . "<br/>";?>
                        <?php echo "Time: " . $startingTime ;?>
                    </form>
                    <?php
                }
                ?>
            </div>
            <div>
                <form method="post">
                    <input type="submit" value="Remove Booking" name="removeBookingButton" class="userEntryButton"/><br/><br/>
                    <input type="submit" value="Return to Dashboard" name="dashboardButton" formaction="../dashboard.php" class="userEntryButton"/>
                </form>
                <?php
                if (isset($_POST['removeBookingButton']))
                {
                    $updateSessionStatusSQL = "UPDATE sessionDetails, bookingDetails SET sessionDetails.isBooked = 0 WHERE sessionDetails.sessionID = bookingDetails.sessionID AND bookingDetails.bookingID = $bookingIDForUnwantedBooking;";
                    $removeBookingSQL = "DELETE FROM bookingDetails WHERE bookingID = $bookingIDForUnwantedBooking;";

                    $updateSessionStatusQuery = $connection->query($updateSessionStatusSQL);
                    $removeBookingQuery = $connection->query($removeBookingSQL);
                    if (!($updateSessionStatusQuery && $removeBookingQuery)) echo "deletion failed";
                }
                ?>
            </div>
        </div>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>