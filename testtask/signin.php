<?php
    require "config.php";

    //signing in and redirecting the user to admin panel who entered the correct credentials
    $data = $_POST;

    if(isset($data['sign_in'])){
        $errors = array();
        $user = mysqli_query($conn, "SELECT * FROM users WHERE username='".$data['username']."'");
        $userResult = mysqli_fetch_assoc($user);
        if($userResult){
            if(password_verify($data['password'],$userResult['password'])){
                $_SESSION['signed_user'] = $userResult;
                header('Location: /');
                echo '<p class="alert">
                    You are successfully signed in
                </p>';            
            }else{
                $errors[] = 'Incorrect password';
            }
        } else{
            $errors[] = 'User with this username could not be found';
        }
    }

    if (!empty($errors)) {
        echo '<p class="alert">
        ' . array_shift($errors) . '</p>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
         *{
            margin:0;
            padding:0;
            
        }
        a{
            text-decoration: none;
            color: steelblue;
        }
        #signIn{
            padding:0px 50px;
        }
        header{
            padding: 10px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .alert{
            color:red;
            width: 48%;
            margin:10px auto;
        }
        #signinForm{
            width: 60%;
            margin:auto;
            padding:10px;
        }        
        input,label,button{
            display:block;
            width: 80%;
            margin:5px auto;
            padding:10px;
        }
        label{
            font-weight: bold;
        }
        input{
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div id="signIn">
        <header>
            <h1><a href="/">Admin Panel</a></h1>
                <div class="header-right">
                    <a href="signin.php">Sign in</a>
                    <a href="signup.php">Sign up</a>  
                </div>
        </header>
        <form action="/signin.php" method="POST" id="signinForm">
            <label for="fusername">Username</label>
            <input type="text" name="username" id="fusername" placeholder="Username" value="<?php echo @$data['username'] ?>">
            <label for="fpassword">Password</label>
            <input type="password" name="password" id="fpassword" placeholder="Password">
            <button type="submit" name="sign_in">Sign in</button>
        </form>
    </div>
</body>
</html>