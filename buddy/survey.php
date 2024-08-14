<?php 
  require_once "config.php";

  session_start();

  // if user has not logged in
if(!isset($_SESSION["id"])){
  header("location: login.php");
}

$friendship = $privacy = $cleanliness_level = $entertainment = $religious_beliefs = $friend_over = $study_mate = $same_course = $sharing = $sleep_schedule = "";
$usersMatched;
$searchStmt;
$delete_survey_message;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['friendship']) ){
  $friendship = $_POST['friendship'];
  $privacy = $_POST['privacy'];
  $cleanliness_level = $_POST['cleanliness_level'];
  $entertainment = $_POST['entertainment'];
  $religious_beliefs = $_POST['religious_beliefs'];
  $friend_over = $_POST['friend_over'];
  $study_mate = $_POST['study_mate'];
  $same_course = $_POST['same_course'];
  $sharing = $_POST['sharing'];
  $sleep_schedule = $_POST['sleep_schedule'];

  $insertSql = "INSERT INTO survey_answer (friendship, privacy, cleanliness_level, entertainment, religious_beliefs, friend_over, study_mate, same_course, sharing, sleep_schedule, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $updateSQL = "UPDATE survey_answer SET  friendship = ?, privacy = ?, cleanliness_level = ?, entertainment = ?, religious_beliefs = ?, friend_over = ?, study_mate = ?, same_course = ?, sharing = ?, sleep_schedule = ? WHERE user_id = ?";

// Prepare a select statement
$checkSurveySql = "SELECT id FROM survey_answer WHERE user_id = ?";
$searchSurveySql = "SELECT * FROM survey_answer WHERE friendship >= ? AND  privacy >= ? AND  cleanliness_level >= ? AND  entertainment >= ? AND  religious_beliefs >= ? AND  friend_over >= ? AND  study_mate >= ? AND  same_course >= ? AND  sharing >= ? AND  sleep_schedule >= ? AND user_id != ". $_SESSION["id"];

$action = "";

try {

  if($checkStmt = mysqli_prepare($link, $checkSurveySql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($checkStmt, "i", $param_user_id);
    $param_user_id = $_SESSION["id"];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($checkStmt)){
        /* store result */
        mysqli_stmt_store_result($checkStmt);
        
        if(mysqli_stmt_num_rows($checkStmt) == 1){
            $action = "UPDATE";
        }else{
        $action = "INSERT";
        }
    } 
  }

  switch ($action) {
    case 'UPDATE':
    $updateStmt = mysqli_prepare($link, $updateSQL);
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($updateStmt, "iiiiiiiiiii", $param_friendship, $param_privacy, $param_cleanliness, $param_entertainment, $param_religiosB, $param_friend_over, $param_studyM, $param_sameC, $param_sharing, $param_sleepS, $param_user_id);
    $param_friendship = $friendship;
    $param_privacy = $privacy;
    $param_cleanliness = $cleanliness_level;
    $param_entertainment = $entertainment;
    $param_religiosB = $religious_beliefs;
    $param_friend_over = $friend_over;
    $param_studyM = $study_mate;
    $param_sameC = $same_course;
    $param_sharing = $sharing;
    $param_sleepS = $sleep_schedule;
    $param_user_id = $_SESSION["id"];
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);


      # code...
      break;
    case 'INSERT':
    $insertStmt = mysqli_prepare($link, $insertSql);
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($insertStmt, "iiiiiiiiiii", $param_friendship, $param_privacy, $param_cleanliness, $param_entertainment, $param_religiosB, $param_friend_over, $param_studyM, $param_sameC, $param_sharing, $param_sleepS, $param_user_id);
    $param_friendship = $friendship;
    $param_privacy = $privacy;
    $param_cleanliness = $cleanliness_level;
    $param_entertainment = $entertainment;
    $param_religiosB = $religious_beliefs;
    $param_friend_over = $friend_over;
    $param_studyM = $study_mate;
    $param_sameC = $same_course;
    $param_sharing = $sharing;
    $param_sleepS = $sleep_schedule;
    $param_user_id = $_SESSION["id"];
    mysqli_stmt_execute($insertStmt);
    mysqli_stmt_close($insertStmt);

      # code...
      break;
    
    default:
      # code...
      break;
  }


  // search users
  $searchStmt = mysqli_prepare($link, $searchSurveySql);
  // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($searchStmt, "iiiiiiiiii", $param_friendship, $param_privacy, $param_cleanliness, $param_entertainment, $param_religiosB, $param_friend_over, $param_studyM, $param_sameC, $param_sharing, $param_sleepS);
    $param_friendship = $friendship;
    $param_privacy = $privacy;
    $param_cleanliness = $cleanliness_level;
    $param_entertainment = $entertainment;
    $param_religiosB = $religious_beliefs;
    $param_friend_over = $friend_over;
    $param_studyM = $study_mate;
    $param_sameC = $same_course;
    $param_sharing = $sharing;
    $param_sleepS = $sleep_schedule;
    mysqli_stmt_execute($searchStmt);

    mysqli_stmt_bind_result($searchStmt, $id, $user_idP, $friendshipP, $privacyP, $cleanlinesP, $entertainmentP, $religious_beliefsP, $friendOvP, $studyMP, $sameCP, $sharingP, $sleepSP);

    // $usersMatched = ;

    // mysqli_stmt_close($searchStmt);



  
} catch (Exception $e) {
  echo "ERROR: Could not prepare query: " . mysqli_error($link);
  die();
}


 }

  if (isset($_POST["delete_survey"])){

    $dltsurvey_sql="DELETE FROM survey_answer WHERE user_id = " . $_SESSION["id"];

    try{
      $survey_result = mysqli_query($connect, $dltsurvey_sql);

      if (mysqli_query($connect, $dltsurvey_sql)) {
        $delete_survey_message = "Your survey has been deleted successfully";
      } else {
        echo "Error deleting survey: Please try again later " . mysqli_error($connect);
      }

      mysqli_close($connect);
      
    
  }
  catch (Exception $e) {
          echo "ERROR: Could not prepare query: $profile_sql. " . $e->getMessage();
          die();
  } 
  }



 ?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Survey</title>
  <link rel="stylesheet" href="css/style.css">
    <style>
        body{ background-color:azure;  font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:left; width:95%; }

    </style>
</head>
<body style="background-color:azure;">
  <a href="welcome.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <input type='submit' name="delete_survey" style=" background-color:black;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;" value="Delete my Survey Records" />
</form>
</a><br><br><br><br><br><br><br>
  <?php 
  if(!empty($delete_survey_message)){
    echo $delete_survey_message;
  }
  ?>
  <div class="container">
    
      <h1>Roommate Recommender Survey Form Questions!</h1><br>
      <h3 id="sub-header">Your best match based on survey comparison</h3>
      <hr>
      <h4 id="sub-header-2">Kindly fill the form below;</h4>

    </div>


    <div id="survey-form" class="row" style="border-color:black; border-width:5px; border-style:solid;">
      <div class="col">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              
              <div class="form-group">
                <label class="question-label" id="survey-question-1" for="survey-question">1.   How important is it for you to have a friendship with your roommate?</label>
                <select class="form-control question" id="question1" name="friendship">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-2" for="survey-question">2.   How important is it for you to have times of solitude and privacy?</label>
                <select class="form-control question" id="question2" name="privacy">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>

                <label class="question-label" id="survey-question-3" for="survey-question">3.   How important is it for you that your roommate keeps a clean room?</label>
                <select class="form-control question" id="question3"  name="cleanliness_level">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-4" for="survey-question">4.   How important is it for you to watch movies, play music or have parties?</label>
                <select class="form-control question" id="question4"  name="entertainment">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-5" for="survey-question">5.   How important is it for you and your roommate have the same religious beliefs?</label>
                <select class="form-control question" id="question5"  name="religious_beliefs">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-6" for="survey-question">6.   How important is it for you to have friends over?</label>
                <select class="form-control question" id="question6"  name="friend_over">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>                
                <label class="question-label" id="survey-question-7" for="survey-question">7.   How important is it for you to study with your roommate?</label>
                <select class="form-control question" id="question7"  name="study_mate">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-8" for="survey-question">8.   How important is it for you to live with someone doing the same course?</label>
                <select class="form-control question" id="question8"  name="same_course">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-9" for="survey-question">9.   How important is it that you and your roommate are open to sharing things(food,electronics,media,e.t.c)</label>
                <select class="form-control question" id="question9"  name="sharing">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-10" for="survey-question">10.   How important is it for your roommate to have similar sleep schedule?</label>
                <select class="form-control question" id="question10" name="sleep_schedule">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>                
              </div>
              <input style="margin: auto;" id="submit" class="btn btn-success" type="submit" value="Submit">
            </form>
      </div>
    </div>

    <div id="survey-results" class="row">
      <?php 

if (isset($searchStmt)) {
  $matched = 0 ;
  # code...
  while (mysqli_stmt_fetch($searchStmt)) {
    $compact= (($friendshipP + $privacyP + $cleanlinesP + $entertainmentP + $religious_beliefsP + $friendOvP + $studyMP + $sameCP + 
      $sharingP + $sleepSP )/50) * 100;
      if($compact < 20){
        continue;
      }
      $matched++;
      $connect = mysqli_connect("localhost", "root","", 'buddy');

      $name = $age = $gender = $budget = $photo = $bio = $phone_number = "";

      $profile_sql = "SELECT id, name, age, gender, photo, bio, budget, phone_number FROM profile WHERE user_id =".$user_idP;
      
      try{
        $profile_result = mysqli_query($connect, $profile_sql);

        while($profile = mysqli_fetch_assoc($profile_result)){
        $matched_profile = "INSERT INTO matched_profile(user_id, matched_profile_id ) VALUES(".$_SESSION['id'].", ".$profile['id'].")";
        $checkMatched = "SELECT * FROM matched_profile WHERE matched_profile_id = ". $profile['id'] ." AND user_id = ".$_SESSION['id'] ;

        $matched_rs =  mysqli_query($connect, $checkMatched);

        if (mysqli_num_rows ($matched_rs) <=  0) {
          mysqli_query($connect, $matched_profile);
        }



          $name = $profile['name'];
          $age = $profile['age'];
          $gender = $profile['gender'];
          $budget = $profile['budget'];
          $bio = $profile['bio'];
          $phone_number = $profile['phone_number'];
          $photo = $profile['photo'];
        }

        mysqli_close($connect);
        
      
    }
    catch (Exception $e) {
            echo "ERROR: Could not prepare query: $profile_sql. " . $e->getMessage();
            die();
    } 

   
    echo '
    <div class="col" style="margin-top: 20px;">
    <div class="card" style="width: 20rem;">
    <img id="pic-1" style="max-width:100%; max-height:200px;" src="img/'.$photo.'" class="card-img-top" alt="...">
    <div class="card-body">
      <h3 class="card-title"><strong style="color:black;">Best Match</strong></h3>
      <p id="name" class="card-text">Name :'.$name.'</p>
      <p id="age" class="card-text">Age :'.$age.'</p>
      <p id="gender" class="card-text">Gender :'.$gender.'</p>
      <p id="budget" class="card-text">Budget :'.$budget.'</p>
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
      <button style="padding:10px; background:#081F5C; border-radius:5px; border:none"><a href="houses.php" style="text-decoration:none; color:white;">View Houses</a></button>
    </div>
    </div>
    </div>
    <br>
    ';
        # code...
      }
      if ( $matched == 0 ){
        echo '<p style="text-align:center; color:black; font-size:16px;"> Sorry there are no matches currently available for you now. Please try again later</p>';
      }
      
}


      ?>

    </div>  <br><br> 

    

  </div>
 
     <footer>
<div class="footer_credit">
 <div class="footer_inner_credit">
 <div id="copyright">
 <div class="footer_credit">
            <div class="footer_inner_credit">
            <p>Buddy Web Application</p>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Email: <a href="starcie@gmail.com">starcie@gmail.com</a></p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
                   
                </div>
      </div>
      </div>
      </div>
        </footer>

   
  
  </body>
</html>
