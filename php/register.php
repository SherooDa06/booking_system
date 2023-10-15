<?php 

require "connection.php"; 

session_start();

$userHasContinuedFormSubmission = true;

if ($userHasContinuedFormSubmission) $userHasContinuedFormSubmission = true;
else $userHasContinuedFormSubmission = false;

// Three different SQL statements for different tables depending on type of user
$_SESSION['sqlRequestMentee'] = "INSERT INTO menteeDetails (firstName, lastName, emailAddress, weakSubject, yearLevel) VALUES (";
$_SESSION['sqlRequestMentor'] = "INSERT INTO mentorDetails (firstName, lastName, emailAddress, strongSubject, yearLevel) VALUES (";
$_SESSION['sqlRequestSupervisor'] = "INSERT INTO supervisorDetails (firstName, lastName, emailAddress, dateOfBirth) VALUES (";

// Functions used to echo value in form element to keep value after submission
function keepValueInField ($elementID) { if (isset($_POST[$elementID])) echo $_POST[$elementID]; }
function keepRadioFieldChecked ($elementID, $elementValue) 
{ 
    if (isset($_POST[$elementID]) && $_POST[$elementID] == $elementValue) echo "checked";  
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="../style/style.css"/>
        <title>CSHS Booking System</title>
    </head>
    <body>
        <header>
            <a href="_index.php" id="titleLink"><h1>WELCOME TO CSHS TUTORING PROGRAM</h1></a>
        </header>
        
        <form name="registerForm" method="post" id="registerForm">
            <div class="registerContent">
                <div id="column1Item">
                    <br/>    
                    Name: <input type="text" name="firstNameInput" placeholder="First" class="nameInput" value="<?php keepValueInField('firstNameInput');?>"/> 
                    <input type="text" name="lastNameInput" placeholder="Last" class="nameInput" value="<?php keepValueInField('lastNameInput');?>"/>
                    <br/><br/>
                    Email: <input type="text" name="emailInput" placeholder="eg@mail.com" id="emailInput" value="<?php keepValueInField('emailInput');?>"/>
                    <br/><br/>
                    Type of User:
                    <br/>
                    
                    <input type="radio" name="userTypeRadio" value="mentee" id="menteeRadio" class="radioButtons" <?php keepRadioFieldChecked('userTypeRadio', "mentee");?>/>
                    <label for="menteeRadio">Mentee (Y7 - 10)</label>
                    <br/>
                    
                    <input type="radio" name="userTypeRadio" value="mentor" id="mentorRadio" class="radioButtons" <?php keepRadioFieldChecked('userTypeRadio', "mentor");?>/>
                    <label for="mentorRadio">Mentor (Y11, Y12)</label>
                    <br/>
                    
                    <input type="radio" name="userTypeRadio" value="supervisor"  id="supervisorRadio" class="radioButtons" <?php keepRadioFieldChecked('userTypeRadio', "supervisor");?>/>
                    <label for="mentorRadio">Supervisor</label>
                    <br/><br/>
                    <input type="submit" value="Continue" name="registerContinue" class="userEntryButton"/>
                    
                </div>
                <?php 

                global $firstName, $lastName, $emailAddress, $yearLevel, $weakSubject;
                $firstName = $lastName = $emailAddress = $yearLevel = $weakSubject = '';
                global $userHasContinuedFormSubmission; $userHasContinuedFormSubmission = false;
                global $doesEmailExist;

                if (isset($_POST['registerContinue'])) 
                {
                    $firstName = $_POST['firstNameInput'];
                    $lastName = $_POST['lastNameInput'];
                    $emailAddress = $_POST['emailInput'];
    
                    if (!strpos($_POST['emailInput'], '@')) echo "Invalid email address, must ontain '@'";
                    else
                    {
                        // The app queries the tables of users to determine if email is already registered; emails can only be unique to one user
                        $doesEmailExistMentee = "SELECT * FROM menteeDetails WHERE emailAddress = '$emailAddress';";
                        $doesEmailExistMentor = "SELECT * FROM mentorDetails WHERE emailAddress = '$emailAddress';";
                        $doesEmailExistSupervisor = "SELECT * FROM supervisorDetails WHERE emailAddress = '$emailAddress';";

                        $doesEmailExistQuery0 = $connection->query($doesEmailExistMentee);
                        $doesEmailExistQuery1 = $connection->query($doesEmailExistMentor);
                        $doesEmailExistQuery2 = $connection->query($doesEmailExistSupervisor);

                        $doesEmailExist = ($doesEmailExistQuery0->num_rows != 0 || $doesEmailExistQuery1->num_rows != 0 || $doesEmailExistQuery2->num_rows != 0);

                        if ($doesEmailExist) echo "A user with your email has already been registered<br/><br/>";
                        else
                        {
                            $_SESSION['firstPartOfSQLStatement'] = "'";

                            $_SESSION['firstPartOfSQLStatement'] .= $firstName .= "', '";
                            $_SESSION['firstPartOfSQLStatement'] .= $lastName .= "', '";
                            $_SESSION['firstPartOfSQLStatement'] .= $emailAddress .= "', '";
        
                            $userHasContinuedFormSubmission = true;
                        }
                    }

                }
                if (isset($_POST['registerContinue']) && !$doesEmailExist)
                {
                    if (isset($_POST['userTypeRadio']))
                    {
                        $emailForQuery = $_POST['emailInput'];

                        if ($_POST['userTypeRadio'] == "mentee")
                        {    
                            $_SESSION['typeOfUserID'] = 0;
                            $_SESSION['logInEmailQuery'] = "SELECT menteeID FROM menteeDetails WHERE emailAddress = '$emailForQuery';";                       
                        } 
                        else if ($_POST['userTypeRadio'] == "mentor") 
                        {
                            $_SESSION['typeOfUserID'] = 1;
                            $_SESSION['logInEmailQuery'] = "SELECT mentorID FROM mentorDetails WHERE emailAddress = '$emailForQuery';";
                        }
                        else if ($_POST['userTypeRadio'] == "supervisor")
                        {
                            $_SESSION['typeOfUserID'] = 2;
                            $_SESSION['logInEmailQuery'] = "SELECT supervisorID FROM supervisorDetails WHERE emailAddress = '$emailForQuery';";
                        } 
                    }
                    else echo "Must select type of user";
                }

                if ($_SESSION['typeOfUserID'] == 0) include "registration_forms/mentee_register.php";
                else if ($_SESSION['typeOfUserID'] == 1) include "registration_forms/mentor_register.php";
                else if ($_SESSION['typeOfUserID'] == 2) include "registration_forms/supervisor_register.php";
                ?>
            </div>
            </form>
        <footer>
            <h2>Clovebride State High School</h2>
        </footer>            
    </body>
</html>