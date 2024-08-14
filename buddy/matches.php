<?php

// Include config file
require_once "config.php";
session_start();


// if user has not logged in
if(!isset($_SESSION["id"])){
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Matches</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
    </style>
</head>

<a href="welcome.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>
<br><br><br><br><br>

<h2 style="color:black; margin: auto; text-align: left;" >keys</h2>

<ol style="color:black; margin: auto; text-align: left;" >
  <li>Not Important</li>
  <li>Slightly important</li>
  <li>Somewhat important</li>
  <li>Very important</li>
  <li>Extremely important</li>
</ol>  
<br><br>
<?php
$userId = $_SESSION['id'];
    $matched = "SELECT * FROM matched_profile WHERE user_id = $userId LIMIT 6";

try{
  $connect = mysqli_connect("localhost", "root","", 'buddy');

    $matched_rs = mysqli_query($connect, $matched);

    if (mysqli_num_rows($matched_rs) > 0){

        while($row = mysqli_fetch_assoc($matched_rs)){
            $profileId = $row['matched_profile_id'];
            $profile_sql = "SELECT * FROM profile WHERE id =$profileId";
            $profiles = mysqli_query($connect, $profile_sql);

            while($profile = mysqli_fetch_assoc($profiles)){
                $name = $profile['name'];
                $age = $profile['age'];
                $gender = $profile['gender'];
                $budget = $profile['budget'];
                $bio = $profile['bio'];
                $phone_number = $profile['phone_number'];
                $photo = $profile['photo'];

            $survey_sql = "SELECT * FROM survey_answer WHERE user_id =$userId";
            $survey_answer_rs = mysqli_query($connect, $survey_sql);
            $survey_answer = mysqli_fetch_assoc($survey_answer_rs);

            $friendshipP = "";
            $privacyP = "";
            $cleanlinesP = "";
            $entertainmentP = "";
            $religious_beliefsP = '';
            $friendOvP = '';
            $studyMP = '';
            $sameCP = '';
            $sharingP = '';
            $sleepSP ='';

            if(mysqli_num_rows($survey_answer_rs) >0){
              $friendshipP = $survey_answer['friendship'];
            $privacyP = $survey_answer['privacy'];
            $cleanlinesP = $survey_answer['cleanliness_level'];
            $entertainmentP = $survey_answer['entertainment'];
            $religious_beliefsP = $survey_answer['religious_beliefs'];
            $friendOvP = $survey_answer['friend_over'];
            $studyMP = $survey_answer['study_mate'];
            $sameCP = $survey_answer['same_course'];
            $sharingP = $survey_answer['sharing'];
            $sleepSP = $survey_answer['sleep_schedule'];
            }

                echo '
                <div class="col" >
                <div class="card" style="width: 20rem;">
                <img id="pic-1" style="max-width:100%; max-height:200px;" src="img/'.$photo.'" class="card-img-top" alt="...">
                <div class="card-body">
                  <h3 class="card-title"><strong style="color:black;">Best Match</strong></h3>
                  <p id="name" class="card-text">Name :'.$name.'</p>
                  <p id="age" class="card-text">Age :'.$age.'</p>
                  <p id="gender" class="card-text">Gender :'.$gender.'</p>
                  <p id="budget" class="card-text">Budget (in KSH):'.$budget.'</p>
                  <p id="bio" class="card-text">Course Title :'.$bio.'</p>
                  <p id="phone_number" class="card-text">Phone Number :'.$phone_number.'</p>
                  <h3 class="survey-results-title"><Strong style="color:black;">Survey Results </strong></h3>
                  <p id="friendship" class="card-text">friendship : '.$friendshipP.'</p>
                  <p id="privacy" class="card-text">privacy :'.$privacyP.'</p>
                  <p id="cleanliness" class="card-text">cleanliness_level :'.$cleanlinesP.'</p>
                  <p id="entertainment" class="card-text">entertainment :'.$entertainmentP.'</p>
                  <p id="religious_belief" class="card-text">religious_beliefs :'.$religious_beliefsP.'</p>
                  <p id="friend_over" class="card-text">friend_over :'.$friendOvP.'</p>
                  <p id="study" class="card-text">study_mate :'.$studyMP.'</p>
                  <p id="same_course" class="card-text">same_course :'.$sameCP.'</p>
                  <p id="sharing" class="card-text">sharing :'.$sharingP.'</p>
                  <p id="sleep" class="card-text">similar sleep_schedule :'.$sleepSP.'</p>
                  <button style="padding:10px; background:#081F5C; border-radius:5px; border:none"><a href="houses.php" style="text-decoration:none; color:white; cursor:pointer;">View Houses</a></button>
                </div>
                </div>
                </div>
                <br><br>
                ';
              }
        }
        }else{
        echo '<p style="text-align:center; color:red; font-size:16px;"> Sorry there are no matches currently available for you now. Please try again later</p>';
      }
    mysqli_close($connect);
  }

catch (Exception $e) {
    echo "ERROR: Could not prepare query: $matched. " . $e->getMessage();
}
?>


<br><br>
<footer>
<div class="footer_credit">
 <div class="footer_inner_credit">
 <div id="copyright">
 <div class="footer_credit">
            <div class="footer_inner_credit">
            <p>BUDDY WEB APPLICATION</p>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
                   
                </div>
      </div>
      </div>
      </div>
        </footer>
</body>
</html>