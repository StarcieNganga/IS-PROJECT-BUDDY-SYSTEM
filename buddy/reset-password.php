<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $new_password = $confirm_password = "";
$username_err =  $new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    

    // Validate new password
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter the username.";     
    } else{
        $username = trim($_POST["username"]);
    }
  
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
 
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(!empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($username_err)){
        
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
            
            // Set parameters
            $param_password = md5($new_password);
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
          body{ background-color: #ff9966;  font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
    </style>
</head>
<body>
<a href="home.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a><br><br><br><br>
<fieldset>
    <div style="width: 50%; display: block; margin: auto; color: #aa2d2a;">
    <h1 style="color:#aa2d2a ;">Reset Password</h1>
    <p style="font-size: 22px;">Please fill this form to reset your password.</p>
    <form style="border-color:#aa2d2a; border-width:5px; border-style:solid; text-align: left;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label><h3>Username</h3></label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label><h3>New Password</h3></label>
                <input type="password" style="width:96%;" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label><h3>Confirm Password</h3></label>
                <input type="password" style="width:96%;" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>  
    </fieldset><br><br>
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