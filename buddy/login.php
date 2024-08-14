<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file and includes file
require_once "config.php";
include 'includes.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        logger('Enter username');
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }  

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        logger('Enter password');
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }   

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $connection = mysqli_connect("localhost", "root","", 'buddy');
        $sql = "SELECT `username`, id, `password`, `role` FROM users WHERE `username` = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $id, $hashed_password, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (md5($password) == $hashed_password) {
                            // Password is correct, so start a new session
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["role"] = $role; // Store the role in session
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($connection);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($connection);
        }

        // Close connection
        mysqli_close($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background-color:azure; font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
    </style>
</head>
<body>
    <a href="home.php"><img src="img/logo.png" alt="Smiley Face" style="float:left;"></a><br><br><br><br>
    <fieldset>
        <div style="width: 50%; display: block; margin: auto; color: #aa2d2a;">
            <h1 style="color:#aa2d2a ;">Log in</h1>
            <p style="font-size: 22px;">Please fill in your credentials to login.</p>
            <?php 
            if(!empty($login_err)){
                echo '<div style="color:red; font-size:22px;">' . $login_err . '</div>';
            }  
            if(!empty($password_err)){
                echo '<div style="color:red; font-size:22px;">' . $password_err . '</div>';
            }  
            if(!empty($username_err)){
                echo '<div style="color:red; font-size:22px;">' . $username_err . '</div>';
            }  
            ?>
            <form style="border-color:#aa2d2a; border-width:5px; border-style:solid; text-align: left;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label><h3>Username</h3></label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Your username">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group">
                    <label><h3>Password</h3></label>
                    <input type="password" style="width:96%;" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Your password">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div><br>
                <div style="width: 50%; display: block; text-align: center; margin: auto;">
                    <input type="submit" class="btn btn-primary" value="Login"><br><br>
                    <a href="reset-password.php" class="btn btn-warning" >Reset Your Password</a>
                </div><br>
                <p style="text-align: center;">Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
        </div>
        
    </fieldset><br><br>
    <footer>
        <div class="footer_credit">
            <div class="footer_inner_credit">
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
