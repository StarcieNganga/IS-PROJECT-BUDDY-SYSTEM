<?php
// Include config file
require_once "config.php";
include 'includes.php';
session_start();
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        logger('use only letters, numbers and underscores');
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $log = " user name already taken($username)";
                     logger($log);
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $log = " password less than 6 characters";
                     logger($log);
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = md5($password); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //get the inserted user
                // Prepare a select statement
                $sql1 = "SELECT u.id FROM users u WHERE u.username=?";

                try {
                    $stmt1 = mysqli_prepare($link, $sql1);
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt1, "s", $param_uname);
                    // Set parameters
                    $param_uname = $username;
                    mysqli_stmt_execute($stmt1);
                    /* store result */
                    mysqli_stmt_store_result($stmt1);

                    if(mysqli_stmt_num_rows($stmt1) == 1){
                            mysqli_stmt_bind_result($stmt1, $id);
                            mysqli_stmt_fetch($stmt1);
                            // Prepare an insert statement
                            $sql2 = "INSERT INTO profile (user_id) VALUES ( ?)";
                            if($stmt2 = mysqli_prepare($link, $sql2)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt2, "i", $param_id);
                                    $param_id = $id;

                                    mysqli_stmt_execute($stmt2);
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    $_SESSION["role"] = $role; // Store the role in session

                                    // if session isin
                                     header("location: add_edit_profile.php");
  
                            }
                    }

                    
                } catch (Exception $e) {
                        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
        
                }
                
            
            } else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            // mysqli_stmt_close($stmt);
        }else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);

        }
    }
    
    // Close connection
    // echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
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
     <a href="home.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a><br><br><br><br>
     <fieldset>
    <div style="width: 50%; display: block; margin: auto; color: #aa2d2a;">
        <h1 style="color:#aa2d2a ;">Sign Up</h1>
        <p style="font-size: 22px;">Please fill this form to create an account.</p>
        <form style="border-color:#aa2d2a; border-width:5px; border-style:solid; text-align: left;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label><h3>Username</h3></label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="" placeholder="Your username">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label><h3>Password</h3></label>
                <input type="password" style="width:96%;" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="" placeholder="Your password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label><h3>Confirm Password</h3></label>
                <input type="password" style="width:96%;" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="" placeholder="Confirm Password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div style="width: 50%; display: block; text-align: center; margin: auto;">
                <input style="margin: auto;" type="submit" class="btn btn-primary" value="Submit">
                <input style="margin: auto;"  type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div><BR>
            <p style="text-align: center;">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>  
</fieldset><br>
    <footer>
<div class="footer_credit">
 <div class="footer_inner_credit">
 <div id="copyright">
 <div class="footer_credit">
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