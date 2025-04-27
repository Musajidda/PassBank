<nav class="navbar navbar-light rounded sticky-top" style="background-color:darkgreen;">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">
            <h5> <i class="fas fa-bars"></i> Pass Question Platform </h5>

        </a>
        <div class="d-flex">
            <?php
            if (isset($_SESSION["user"])) {
            ?>
                <a href="logout.php" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT</a>
            <?php
            } else {
            ?>
                <a href="login.php" class="nav-link  m-1 text-light">
                    <i class="fas fa-sign-in-alt"></i> Signin</a>
                <br />
                <a href="register.php" class="nav-link  m-1 text-light">
                    <i class="fas fa-sign-in-alt"></i> Signup </a>
            <?php
            }
            ?>
        </div>
    </div>
</nav>