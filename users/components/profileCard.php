
<div class="profile-card-container">
    <div class="profile-card">
        <div class="profile-card-info">
            <div class="profile-card-img">
                <img src="../../images/user.jpg" alt="profile-img">
            </div>
            <span>
                <p style="font-size: 20px; font-weight: bold;"><?php echo $_SESSION['full_name'] ?></p>
                <p><?php echo $_SESSION['interest'] ?></p>
                <p><i class="fa-solid fa-location-dot"></i> Kathmandu, Nepal</p>
                <p id="bio-text"><?php echo $_SESSION['bio'] ?></p>
                <a href="../pages/profile.php"><p>Manage Profile</p><i class="fa-solid fa-arrow-right"></i></a>
            </span>
        </div>
    </div>
    <div class="menu-container">
        <a href="#"><i class="fa-solid fa-bookmark"></i>  Saved items</a>
        <a href="#"><i class="fa-solid fa-comment"></i>  Comments</a>
        <a href="#"><i class="fa-solid fa-calendar"></i>  Events</a>
        <a href="#"><i class="fa-solid fa-newspaper"></i>  Newsletters</a>
    </div>
</div>