<?php
    require "config.php";

    //if user isn't admin or signed in then redirect them on signup page
    if($_SESSION['signed_user']['role'] == 'user' or (!isset($_SESSION['signed_user']))){
        header('Location: signup.php');
    }
    //editing user
    $data = $_POST;
    if (isset($data['edit_user'])) {

        $errors = array();

        //checking the username entered
        if (trim($data['username']) == '') {
            $errors[] = 'Enter an username';
        }
        //checking the password entered
        if (trim($data['role']) != 'user' or trim($data['role']) != 'admin') {
            $errors[] = 'Incorrect role';
        }
        //checking if the username exist
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username='".$data['username']."'"))){
            $errors[] = 'A user with the same username already exists';
        }
        //update user entry in database
        if (empty($errors)) {
              $sql = "UPDATE users SET username='".$data['username']."',
                name='".$data['name']."',
                surname='".$data['surname']."',
                birthday='".$data['birthday']."'
                role='".$data['role']."',
                WHERE id='".$data['getId']."'";
            if (mysqli_query($conn, $sql)) {
                header("Location: profile.php?id=".$data['getId']);
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
    <title>Add user</title>
    <style>
        *{
            margin:0;
            padding:0;
            
        }
        a{
            text-decoration: none;
            color: steelblue;
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
        .success{
            color:limegreen;
            width: 48%;
            margin:10px auto;
        }
        #editUser{
            padding:0px 50px;
        }
        #edituserForm{
            width: 60%;
            margin:auto;
            padding:10px;
        }        
        input,label, select,button{
            display:block;
            width: 85%;
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
    <div id="editUser">
        <?php include "apheader.php" ?>
        <form action="/edituser.php" method="POST" id="edituserForm">
            <?php
                $editableprofile = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = " . (int) $_GET['id']);
                $editprof = mysqli_fetch_assoc($editableprofile);
            ?>     
            <label for="fusername">Username</label>
            <input type="text" name="username" id="fusername" placeholder="Username" value="<?php echo @$editprof['username'] ?>">
            <label for="fname">Name</label>
            <input type="text" name="name" id="fname" placeholder="Name" value="<?php echo @$editprof['name'] ?>">
            <label for="fsurname">Surname</label>
            <input type="text" name="surname" id="fsurname" placeholder="Surname" value="<?php echo @$editprof['surname'] ?>">
            <label for="fbirthday">Birthday</label>   
            <input type="date" name="birthday" id="fbirthday" value="<?php echo @$editprof['birthday'] ?>">
            <label for="fsurname">Role</label>
            <input type="text" name="surname" id="fsurname" placeholder="Surname" value="<?php echo @$editprof['role'] ?>">
            <button type="submit" name="edit_user">Confirm editing</button>
            <input type="hidden" name="getId" value="<? echo $_GET['id'] ?>" />
        </form>
    </div>
</body>
</html>