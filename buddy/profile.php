<?php
// Include config file
require_once "config.php";
session_start();


// if user has not logged in
if(!isset($_SESSION["id"])){
  header("location: login.php");
}

$name = $age = $gender = $budget = $photo = $bio = $phone_number = "";

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



















 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
       
        tr:nth-child(even) {
  		background: none;
		}

		h4{
			color: #4CAF50; font-weight: bold;
		}
    </style>
</head>
<body style="background-color:azure;">

	<a href="welcome.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>

	<a href="add_edit_profile.php" class="button" style=" background-color:#081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 20px; margin: 4px 2px; cursor: pointer; float: right;">Edit my profile</a>

  	<br><br><br><br><br><br>
  	<div style="display: flex; flex-direction: column; align-items: center;">
  		<div class="image" style="width: 50%;">
		  <img style="width:50%;" src="img/<?php echo $photo; ?>" />
  		</div><br><br><br>
  		<div class="details" style="width: 50%;">
  			<table style="border: none; font-size: 16px;">
  				<tr>
    			<td><h3>Name</h3></td>
    			<td><h4 style="color:black;"><?php echo $name; ?></h4></td>
  				</tr>

  				<tr>
    			<td><h3>Age</h3></td>
    			<td><h4 style="color:black;"><?php echo $age; ?></h4></td>
  				</tr>

  				<tr>
    			<td><h3>Gender</h3></td>
    			<td><h4 style="color:black;"><?php echo $gender; ?></h4></td>
  				</tr>

  				<tr>
    			<td><h3>Budget (Ksh)</h3></td>
    			<td><h4 style="color:black;"><?php echo $budget; ?></h4></td>
  				</tr>

  				<tr>
    			<td><h3>Course title</h3></td>
    			<td><h4 style="color:black;"><?php echo $bio; ?></h4></td>
  				</tr>

  				<tr>
    			<td><h3>Phone Number</h3></td>
    			<td><h4 style="color:black;"><?php echo $phone_number; ?></h4></td>
  				</tr>

  			</table>
  		</div>
  	</div><br><br><br><br>














     <footer>
<div class="footer_credit">
 <div class="footer_inner_credit">
 <div id="copyright">
 <div class="footer_credit">
            <div class="footer_inner_credit">
            <p>BUDDY WEB APPLICATION</p>
        <div class="contacts">
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
                   
                </div>
      </div>
      </div>
      </div>
        </footer>  
</body>
</html>