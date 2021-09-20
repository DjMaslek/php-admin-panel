<?php include "config.php";

    //if user isn't admin or signed in then redirect them on signup page
    if($_SESSION['signed_user']['role'] == 'user' or (!isset($_SESSION['signed_user']))){
        header('Location: signup.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        a{
            text-decoration: none;
            color: steelblue;
        }
        #profileView{
            padding:0px 50px;
        }
        header{
            padding: 10px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profile{
            font-size: 1.1rem;
            padding:10px;
        }
        .profile h2{
            margin-bottom: 20px;;
        }
        .profile p, .profile h3 {
            margin-bottom: 10px;
        }
        .profile button{
            padding:8px;
        }
    </style>
</head>
<body>
    <div id="profileView">
    <?php include "apheader.php" ?>

        <div class="profile">
            <h2>Users list</h2>
        
            <?php
                //displaying selected user entry
                $profile = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = " . (int) $_GET['id']);

                if (mysqli_num_rows($profile) <= 0) {
                ?>
                    <div class="col-sm-7">
                        <h2>User not found</h2>
                    </div>
                <?php
                } else {
                    $prof = mysqli_fetch_assoc($profile);
            ?>       
                        <h3>Username - <?php echo $prof['username'] ?></h3>
                        <p>Name - <?php echo $prof['name'] ?></p>
                        <p>Surname - <?php echo $prof['surname'] ?></p>
                        <p>Gender - <?php echo $prof['gender'] ?></p>
                        <p>Birthday - <?php echo $prof['birthday'] ?></p>
                        <p>Role - <?php echo $prof['role'] ?></p>
                        <a href="/edituser.php?id=<?php echo $prof['id']; ?>"><button>Edit</button></a>
                        <a href="/deleteuser.php?id=<?php echo $prof['id']; ?>"><button>Delete</button></a>
                        
            
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>