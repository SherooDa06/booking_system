<div id="column2Item">
    <br/>
    Date of Birth: <input type="text" name="dateOfBirthInput" placeholder="YYYY-MM-DD"/>
    <br/><br/>
    <input type="submit" name="supervisorSubmit" class="userEntryButton" formaction="dashboard.php"/>
</div>

<?php
if (isset($_POST['supervisorSubmit']))
{                     
    $userHasContinuedFormSubmission = true;
    $dateOfBirth = $_POST['dateOfBirthInput'];
                        
    $_SESSION['sqlRequestSupervisor'] .= $_SESSION['firstPartOfSQLStatement'];
    $_SESSION['sqlRequestSupervisor'] .= $dateOfBirth .=  "');";
    
    $sqlQuery = $connection->query($_SESSION['sqlRequestSupervisor']);

    $logInUserRequest = "SELECT supervisorID FROM supervisorDetails WHERE emailAddress = '$emailAddress'";
    $logInUserQuery = $connection->query($logInUserRequest);
    
    while($row = $logInUserQuery->fetch_assoc())
    {
        $logInQuery = $connection->query($_SESSION['logInEmailQuery']);
        while ($row = $logInQuery->fetch_assoc())
        {
            $_SESSION['loggedInID'] = $row['supervisorID'];
        }
    }

    ?><input type="submit" name="finish" value="Complete" class="userEntryButton" formaction="dashboard.php"/><?php
}