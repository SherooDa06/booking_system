<div id="column2Item">
    <br/>
    Year Level:
    <br/>
    <input type="radio" name="yearLevelRadio" value="7" id="7Radio"    
    class="radioButtons">
    <label for="7Radio">7</label>
    <input type="radio" name="yearLevelRadio" value="8" id="8Radio"    
    class="radioButtons"/>
    <label for="8Radio">8</label>
    <input type="radio" name="yearLevelRadio" value="9" id="9Radio"    
    class="radioButtons"/>
    <label for="9Radio">9</label>
    <input type="radio" name="yearLevelRadio" value="10" id="10Radio"  
    class="radioButtons"/>
    <label for="10Radio">10</label>
    <br/><br/>
    Weakest Subject:
    <select name="weakSubjectInput">
        <option value="English">English</option>
        <option value="Maths">Maths</option>
        <option value="Science">Science</option>
        <option value="Social Science">Social Science</option>
    </select>
    <br/><br/>
    <input type="submit" name="mentorSubmit" class="userEntryButton"/>
</div>

<?php
if (isset($_POST['mentorSubmit']))
{                     
    $userHasContinuedFormSubmission = true;
    $yearLevel = $_POST['yearLevelRadio'];
    $weakSubject = $_POST['weakSubjectInput'];
                        
    $_SESSION['sqlRequestMentee'] .= $_SESSION['firstPartOfSQLStatement'];
    $_SESSION['sqlRequestMentee'] .= $weakSubject .=  "', ";
    $_SESSION['sqlRequestMentee'] .= $yearLevel .= ");";
                        
    $sqlQuery = $connection->query($_SESSION['sqlRequestMentee']);

    $logInQuery = $connection->query($_SESSION['logInEmailQuery']);
    while ($row = $logInQuery->fetch_assoc())
    {
        $_SESSION['loggedInID'] = $row['menteeID'];
    }

    ?><input type="submit" name="finish" value="Complete" class="userEntryButton" formaction="dashboard.php"/><?php
}