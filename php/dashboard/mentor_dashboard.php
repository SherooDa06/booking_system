<?php

$loggedInID = $_SESSION['loggedInID'];

$createdSessionsSQL = "SELECT sessionID, subjectName FROM sessionDetails WHERE mentorID = $loggedInID;";
$createdSessionQuery = $connection->query($createdSessionsSQL);

while($session = $createdSessionQuery->fetch_assoc())
{
    $sessionID = $session['sessionID'];
    $subjectName = $session['subjectName'];

    ?>
    <form name="editSession<?php echo $sessionID;?>" method="get">
        <div class="sessionOffering">
            <div id="sessionTitle"><?php echo $subjectName;?></div>
            <input type="submit" name="editButton<?php echo $sessionID;?>" value="Edit"/>
        </div>
    </form>
    <?php
}