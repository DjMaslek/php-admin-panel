<header>
   <h1><a href="adminpanel.php">Admin Panel</a></h1>
    <div class="header-right">
        <span>Hello, <?php echo $_SESSION['signed_user']['name'];?></span>
        <a href="adduser.php">Add user</a>
        <a href="logout.php">Log out</a>
    </div>
</header>