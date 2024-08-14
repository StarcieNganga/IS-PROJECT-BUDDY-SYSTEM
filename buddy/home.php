<?php
include 'includes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
    </style>
</head>
<body style="background-color:azure;">

    <a href="home.php"><img src="img/logo.png" alt="smiley face"  style="float:left;"></a>
    <a href="register.php" class="button" style="background-color:#081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;">Register</a>
    <a href="login.php" class="button" style="background-color:#081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;">
    <?php 
    logger("User logged in");
    ?>
    Log In</a>
                             <!--end of Navigation-->
                              <!--article-->
        <br><br><br><br>

        <h1 style="color: #aa2d2a;"  class="my-5"> Find a Roommate Today!!</h1>
                              
        <h3 style="font-size: 24px;">Giving students a cross-platform roommate recommender<br> solution to find the perfect roommate </h3><br>

        <a href="welcome.php" class="button" style="background-color:#081F5C; none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer;">Lets Go!!!</a>

        <br> <br> 
    <img style="width: 500px;; "src="img/home 6.jpeg">
    <img style="width: 380px;; "src="img/home 5.jpeg">
  
                                          <!-- Start of footer -->
                                          <footer>
        <div class="footer_credit">
            <div class="footer_inner_credit">
    <footer class="footer">
        <p><b>BUDDY WEB APPLICATION</p></b>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
        </div>
    </footer>
</body>
</html>
           
	  </div>
	  </div>
	  </div>
		</footer>
	  </body>
</html>