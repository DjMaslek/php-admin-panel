<?php require "config.php";
      ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in or sign up</title>
    <style>
        *{
            margin: 0;
            padding:0;
        }
        a{
            text-decoration: none;
            color: steelblue;
        }
        #mainPage{
            padding:0px 50px;
        }
        header{
            padding: 10px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <!-- Redirecting signed in admin user to adminpanel-->
    <?php if(isset($_SESSION['signed_user'])) : ?>
        <?php
            ob_start();
            $user = mysqli_query($conn, "SELECT * FROM users WHERE username='".$_SESSION['signed_user']['username']."'");
            $userResult = mysqli_fetch_assoc($user);
            if($userResult['role'] == 'admin'){
                header('Location: adminpanel.php');
            } else{
                echo '<h2>You are not an administrator you cannot enter the adminpanel </h2><a href="logout.php">Log out</a>';
            }
        ?>
    <?php else :?>
    <div id="mainPage">
        <header>
            <h1><a href="/">Admin Panel</a></h1>
                <div class="header-right">
                    <a href="signin.php">Sign in</a>
                    <a href="signup.php">Sign up</a>  
                </div>
        </header>
        <h2>Please authorize to enter the adminpanel</h2>
             
    </div>
    <?php endif; ?>
</body>
</html>