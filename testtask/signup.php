<?php
    require "config.php";

    //user sign up
    $data = $_POST;
    if (isset($data['sign_up'])) {

        $errors = array();

        //checking the username entered
        if (trim($data['username']) == '') {
            $errors[] = 'Enter an username';
        }
        //checking the password entered
        if ($data['password'] == '') {
            $errors[] = 'Enter a password';
        }
        
        //checking if the username exist
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE username='".$data['username']."'"))){
            $errors[] = 'A user with the same username already exists';
        }
        //registration in the database and redirecting the user to sign in page 
        //if user entered their credentials
        if (empty($errors)) {
            $sql = "INSERT INTO users (username, password, name, surname, gender, birthday) VALUES ('".$data['username']."',
              '".password_hash($data['password'], PASSWORD_DEFAULT)."',
              '".$data['name']."', '".$data['surname']."',
              '".$data['gender']."',
              '".$data['birthday']."')";
    
            if (mysqli_query($conn, $sql)) {
                header('Location: /signin.php');
            } else {
                echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo '<p class="alert">
            ' . array_shift($errors) . '</p>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        *{
            margin:0;
            padding:0;
            
        }
        a{
            text-decoration: none;
            color: steelblue;
        }
        #signUp{
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
        #signupForm{
            width: 60%;
            margin:auto;
            padding:10px;
        }        
        input,label, select,button{
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
    <div id="signUp">
        <header>
            <h1><a href="/">Admin Panel</a></h1>
                <div class="header-right">
                    <a href="signin.php">Sign in</a>
                    <a href="signup.php">Sign up</a>  
                </div>
        </header>
        <form action="/signup.php" method="POST" id="signupForm">
            <label for="fusername">Username</label>
            <input type="text" name="username" id="fusername" placeholder="Username" value="<?php echo @$data['username'] ?>">
            <label for="fname">Name</label>
            <input type="text" name="name" id="fname" placeholder="Name" value="<?php echo @$data['name'] ?>">
            <label for="fsurname">Surname</label>
            <input type="text" name="surname" id="fsurname" placeholder="Surname" value="<?php echo @$data['surname'] ?>">
            <label for="fgender">Gender</label>
            <select name="gender" id="fgender">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            <label for="fbirthday">Birthday</label>   
            <input type="date" name="birthday" id="fbirthday" value="<?php echo @$data['birthday'] ?>">
            <label for="fpassword">Password</label>
            <input type="password" name="password" id="fpassword" placeholder="Password">
            <button type="submit" name="sign_up">Sign Up</button>
        </form>
    </div>
</body>
</html>