<navbar style="height: 100%; width: 100%">
    <div class="nav-items">
        <div class="logo">
            <a href="home.php">
                <picture>
                    <source media="(max-width: 480px)" srcset="../../images/up-logo.png">
                    <img src="../../images/linkedup-logo.png" alt="logo">
                </picture>
            </a>
        </div>
        <div class="links-container">
            <input type="checkbox" id="sidebar-activate">
            <label for="sidebar-activate" class="sidebar-open">
                <i class="fa-solid fa-bars"></i>
            </label>
            <div class="page-links">
                <label for="sidebar-activate" class="sidebar-close">
                    <i class="fa-solid fa-x"></i>
                </label>
                <a href="home.php"><i class="fa-solid fa-house"></i></a>
                <a href="#"><i class="fa-solid fa-suitcase"></i></a>
                <a href="#"><i class="fa-solid fa-bell"></i></a>
                <a href="profile.php" id="user"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="search-container-wrapper">
                <div class="search-container">
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Search">
                    </form>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="profile">
                    <a href="../pages/profile.php"><img src="../../images/user.jpg" alt="profile image"></a>
                </div>
            </div>
        </div>
    </div>
</navbar>