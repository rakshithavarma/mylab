<nav class="navtop">
    <div>
        <a class="navbar-brand" href="#">
            <img src="images/mylab.png" alt="Logo" style="width:40px; padding-top: 5px;" class="rounded-pill">
        </a>
        <h1>MyLab</h1>

        <a href="welcome-<?php if ($_SESSION["role"] === 2) {
                                echo "s";
                            } elseif ($_SESSION["role"] === 1) {
                                echo "t";
                            } elseif ($_SESSION["role"] === 1) {
                                echo "s";
                            } ?>.php"><i class="fas fa-home"></i>Home</a>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>