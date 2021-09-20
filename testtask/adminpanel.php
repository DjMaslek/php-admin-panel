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
    <title>Admin Panel</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        a{
            text-decoration: none;
            color: steelblue;
        }
        #adminPanel{
            padding:0px 50px;
        }
        header{
            padding: 10px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user{
            border-bottom:1px solid black;
            padding:10px 10px;
            display:flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1rem;
        }
        .user button{
            padding:8px;
        }
    </style>
</head>
<body>
    <div id="adminPanel">
        <?php include "apheader.php" ?>

        <div id="usersList">
            <h2>Users list</h2>
            <?php
                //pagination
                $per_page = 4;
                $page = 1;

                if(isset($_GET['page'])){
                    $page = (int) $_GET['page'];
                }

                $total_count_query = mysqli_query($conn, "SELECT COUNT('id') AS 'total_count' FROM `users`");
                $total_count = mysqli_fetch_assoc($total_count_query);
                $total_count = $total_count['total_count'];

                $total_pages = ceil($total_count / $per_page);
                if($page <= 1 or $page > $total_pages){
                    $page = 1;
                }

                $offset = ($per_page * $page) - $per_page;

                $users = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `id` DESC LIMIT $offset,$per_page");
                //checking if there are existing user entries in the database
                $users_exist = true;
                if(mysqli_num_rows($users) <= 0){
                    echo 'Users do not exist';
                    $users_exist = false;
                }
            ?>
            <?php
                //displaying a list of registered users sorted by id
                while ($user = mysqli_fetch_assoc($users)){
            ?>
                <div class="user">
                <div class="user-left">
                    <span><?php echo $user['username'] ?></span>
                    <span><?php echo $user['name'] ?></span>
                    <span><?php echo $user['surname'] ?></span>
                    <span><?php echo $user['gender'] ?></span>
                    <span><?php echo $user['birthday'] ?></span>
                    <span><?php echo $user['role'] ?></span>
                </div>
                <div class="user-right">
                    <a href="/profile.php?id=<?php echo $user['id']; ?>"><button>View</button></a>
                    <a href="/edituser.php?id=<?php echo $user['id']; ?>"><button>Edit</button></a>
                    <a href="/deleteuser.php?id=<?php echo $user['id']; ?>"><button>Delete</button></a>
                </div>
            </div>
            <?php     
                }
                //pagination
                if($users_exist){
                    echo '<div class="paginator">';
                    if($page > 1){
                        echo '<a href="adminpanel.php?page='.($page - 1).'">Last </a>';
                    }
                    if($page < $total_pages){
                        echo '<a href="/adminpanel.php?page='.($page + 1).'"> Next</a>';
                    }
                    echo '</div>';
                }
            ?>

        </div>


    </div>
</body>
</html>