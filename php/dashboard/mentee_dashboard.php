<?php

if (isset($_POST['availableBookings']))
{    
    $sessionOfferingQueryRequest = "SELECT sessionDetails.sessionID, sessionDetails.subjectName, mentorDetails.firstName, mentorDetails.lastName FROM sessionDetails, mentorDetails WHERE sessionDetails.mentorID = mentorDetails.mentorID AND sessionDetails.isBooked = 0;";
    $sessionOfferingQuery = $connection->query($sessionOfferingQueryRequest);
    
    echo "<h1>Available Sessions</h1>";
    while ($sessionOffering = $sessionOfferingQuery->fetch_assoc())
    {
        $sessionID = $sessionOffering['sessionID'];
        $subjectName = $sessionOffering['subjectName'];
        $mentorFirstName = $sessionOffering['firstName'];
        $mentorLastName = $sessionOffering['lastName'];

            ?>
            <form action="create_delete_pages/create_booking.php">
                <div class="sessionOffering">
                    <div id="sessionTitle"><?php echo $sessionID . ' ' . $subjectName;?></div>
                    <div id="sessionAuthor"><?php echo $mentorFirstName . ' ' . $mentorLastName;?>
                </div>
                <input type="submit" name="selectButton<?php echo $sessionID;?>" value="Select"/>
            </div>
            </form>
            <?php
    }
}
else if (isset($_POST['bookedBookings']))
{
    $loggedInID = $_SESSION['loggedInID'];
    $bookingDetailsQueryRequest = "SELECT bookingDetails.bookingID, bookingDetails.sessionID, sessionDetails.subjectName, mentorDetails.firstName, mentorDetails.lastName FROM bookingDetails, sessionDetails, mentorDetails WHERE sessionDetails.sessionID = bookingDetails.sessionID AND mentorDetails.mentorID = sessionDetails.mentorID AND bookingDetails.menteeID = $loggedInID";
    $bookingDetailsQuery = $connection->query($bookingDetailsQueryRequest);

    echo "<h1>Booked Sessions</h1>";
    while ($booking = $bookingDetailsQuery->fetch_assoc())
    {
        $bookingID = $booking['bookingID'];
        $sessionID = $booking['sessionID'];
        $subjectName = $booking['subjectName'];
        $mentorFirstName = $booking['firstName'];
        $mentorLastName = $booking['lastName'];

        ?>
        <form>
            <div class="sessionOffering">
                <div id="sessionTitle"><?php echo $sessionID . ' ' . $subjectName;?></div>
                <div id="sessionAuthor"><?php echo $mentorFirstName . ' ' . $mentorLastName;?></div>
                <input type="submit" name="editButton<?php echo $sessionID;?>" value="Edit" formaction="create_delete_pages/edit_booking.php"/>
                <input type="submit" name="deleteButton<?php echo $bookingID;?>" value="Remove" formaction="create_delete_pages/delete_booking.php"/>
            </div>
        </form>
        <?php 
    }
}