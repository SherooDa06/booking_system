<div id="column2Item">
    <br/>
    Year Level:
    <br/>
    <input type="radio" name="yearLevelRadio" value="11" id="11Radio"    
    class="radioButtons">
    <label for="11Radio">11</label>
    <input type="radio" name="yearLevelRadio" value="12" id="12Radio"    
    class="radioButtons"/>
    <label for="12Radio">12</label>
    <br/><br/>
    Strongest Subject:
    <select name="strongSubjectInput">
        <option value="English">English</option>
        <option value="Maths">Maths</option>
        <option value="Science">Science</option>
        <option value="Social Science">Social Science</option>
    </select>
    <br/><br/>
    <input type="submit" name="menteeSubmit" class="userEntryButton"/>
</div>

<?php
if (isset($_POST['menteeSubmit']))
{                     
    $userHasContinuedFormSubmission = true;
    $yearLevel = $_POST['yearLevelRadio'];
    $strongSubject = $_POST['strongSubjectInput'];
                        
    $_SESSION['sqlRequestMentor'] .= $_SESSION['firstPartOfSQLStatement'];
    $_SESSION['sqlRequestMentor'] .= $strongSubject .=  "', ";
    $_SESSION['sqlRequestMentor'] .= $yearLevel .= ");";

    $sqlQuery = $connection->query($_SESSION['sqlRequestMentor']);
    $logInQuery = $connection->query($_SESSION['logInEmailQuery']);
    while ($row = $logInQuery->fetch_assoc())
    {
        $_SESSION['loggedInID'] = $row['mentorID'];
    }

    ?><input type="submit" name="finish" value="Complete" class="userEntryButton" formaction="dashboard.php"/><?php
}