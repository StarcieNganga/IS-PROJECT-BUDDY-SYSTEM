<?php
// Include config file
require_once "config.php";
session_start();


// if user has not logged in
if(!isset($_SESSION["id"])){
  header("location: login.php");
}
 
// Define variables and initialize with empty values
$name = $age = $gender = $budget = $photo = $bio = $phone_number = "";
$name_err = $age_err = $budget_err = $photo_err = $bio_err = $phone_err = $gender_err =  "";
$profile_sql = "SELECT name, age, gender, photo, bio, budget, phone_number FROM profile WHERE user_id = ?";

try{
    $profile_stmt = mysqli_prepare($link, $profile_sql);

    mysqli_stmt_bind_param($profile_stmt, "i", $param_user_id);

    $param_user_id = $_SESSION["id"];

    mysqli_stmt_execute($profile_stmt);
    /* store result */
    mysqli_stmt_store_result($profile_stmt);

    mysqli_stmt_bind_result($profile_stmt, $name, $age, $gender, $photo, $bio, $budget, $phone_number);
    mysqli_stmt_fetch($profile_stmt);

    
}
catch (Exception $e) {
                        echo "ERROR: Could not prepare query: $profile_sql. " . mysqli_error($link);
                        die();
        
                }
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    }

    // if(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["name"]))){
    //     $name_err = "name can only contain letters, numbers, and underscores.";
    // } 
    
    if(empty(trim($_POST["age"]))){
        $age_err = "Please enter a age.";
    } 
    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please enter a gender. ";
    } 
    if(empty(trim($_POST["budget"]))){
        $budget_err = "Please enter a budget.";
    } 
    if(empty($_FILES["photo"])){
        $photo_err = "Please enter a profile picture.";
    } 
    if(empty(trim($_POST["phone_number"]))){
        $phone_err = "Please enter a valid phone number.";
    }
    if(empty(trim($_POST["bio"]))){
        $bio_err = "Please enter your bio info";
    }

    else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM profile WHERE phone_number = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_phone_num);
            
            // Set parameters
            $param_phone_num = trim($_POST["phone_number"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $user_id);
                mysqli_stmt_fetch($stmt);

                
                if($_SESSION["id"]  ==  $user_id){
                    $phone_err = "This phone number is already exists.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($age_err) && empty($gender_err) && empty($budget_err) && empty($photo_err) && empty($phone_err) && empty($bio_err)){

      $name = $_POST['name'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $budget = $_POST['budget'];
      $bio = $_POST['bio'];
      $phone_number = $_POST['phone_number'];
      $gender = $_POST['gender'];

        // Prepare an insert statement
        $sql = "UPDATE profile SET name = ?, age = ?, gender = ?, budget = ?, photo = ?, bio = ?, phone_number = ? WHERE user_id = ?";
                

        if($stmt = mysqli_prepare($link, $sql)){
          //upload the hoto
            $filename = $_FILES["photo"]["name"];
            $tempname = $_FILES["photo"]["tmp_name"];    
            $folder = "img/".$filename;
            move_uploaded_file($tempname, $folder);

            if(empty ($filename)){
                $filename = $photo;
            }


  
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisdssii", $param_name, $param_age, $param_gender, $param_budget, $param_photo, $param_bio, $param_phone_number, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_age = $age;
            $param_gender = $gender;
            $param_budget = $budget;
            $param_bio = $bio;
            $param_phone_number = $phone_number;
            $param_photo = $filename;
            $param_id = $_SESSION["id"];

            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to profile page
                header("location: welcome.php");
            } else{
              echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
                echo "Oops! Something went wrong. Please try again later.";

            }


            // Close statement
            mysqli_stmt_close($stmt);
        }else{
          echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    die();
        }
    }


    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{ background-color:azure;  font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }

    </style>
</head>
<body>

     <a href="welcome.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a><br><br><br><br>
     <fieldset>
    <div style="width: 50%; display: block; margin: auto; color: #aa2d2a;">
        <h1 style="color:#aa2d2a ;">Add Profile</h1>
        <p style="font-size: 22px;"></p>
        <form style="border-color:#aa2d2a; overflow: hidden; border-width:5px; border-style:solid; text-align: left; " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label><h2>Name</h2></label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Your name">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>    
            <div class="form-group">
                <label><h2>Age</h2></label>
                <input type="text" name="age" class="form-control" value="<?php echo $age; ?>" placeholder="Your age">
                <span class="invalid-feedback"><?php echo $age_err; ?></span>
            </div>
            <div class="form-group">
                <label><h2>Gender</h2></label>
                <select type="text" name="gender" class="form-control" value="<?php echo $gender; ?>" placeholder="Your gender">
                  <option value="" selected="selected" hidden="hidden"  >Select your gender</option>
                   <option value="male"  <?php if($gender == 'male'){ echo 'selected';}  ?>>Male</option>
                   <option value="female" <?php if($gender == 'female') { echo 'selected';}  ?>>Female</option>
                   <option value="other" <?php if($gender == 'other'){ echo 'selected';}?>>Other</option>
                </select>
                <span class="invalid-feedback"><?php echo $gender_err; ?></span>
            </div>

            <div class="form-group">
                <label><h2>Budget (Ksh)</h2></label>
                <input type="text" name="budget" class="form-control" value="<?php echo $budget; ?>" placeholder="Your budget">
                <span class="invalid-feedback"><?php echo $budget_err; ?></span>
            </div>
            <div class="form-group">
                <label><h2>Course Title</h2></label>
                <input type="text"  name="bio" class="form-control"  value="<?php echo $bio; ?>" placeholder="Enter your course title">
                <span class="invalid-feedback"><?php echo $bio_err; ?></span>
            </div>
            <div class="form-group">
                <label><h2>Phone Number</h2></label>
                <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>" placeholder="Your phone">
                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
            </div>
            
            <div class="form-group">
                <label><h2>Photo</h2></label>
                <img style="max-width: 100px; max-height: 100px;" src="./img/<?php echo $photo; ?>" />
                <input type="file" name="photo" class="form-control" value=""/>
                <span class="invalid-feedback"><?php echo $photo_err; ?></span>
            </div>
            <div style="width: 50%; display: block; text-align: center; margin: auto;">
                <input style="margin: auto;" type="submit" class="btn btn-primary" value="Update my Profile">
                <input style="margin: auto;"  type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div><BR>
        </form>
    </div>  
</fieldset><br>
    <footer>
<div class="footer_credit">
 <div class="footer_inner_credit">
 <div id="copyright">
 <p>BUDDY WEB APPLICATION</p>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
                   
      </div>
      </div>
      </div>
        </footer>  
</body>
</html>