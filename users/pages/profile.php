<?php

session_start();
// if (!isset($_SESSION["email"])) {
//     header("Location: access_denied.php");
//     exit;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/mainStyle.css">
    <link rel="stylesheet" href="../style/profileStyle.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!---Google Fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        include '../components/navbar.php';
        ?>
    </header>
    <main>
        <div class="profile-user-container">
            <div class="profile-user-pictures">
                <div class="profile-user-bg-img">
                    <img src="../../images/bg-1.jpg" alt="../../images/default-white-bg.jpg">
                    <div class="profile-user-profile-img">
                        <img src="../../images/user.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="profile-user-info">
                <span style="display: flex; flex-direction: column; gap: 8px;">
                    <p class="profile-user-name"><?php echo $_SESSION['full_name'] ?></p>
                    <span style="display: flex; align-items: center; gap:5px;">
                        <i class="fa-regular fa-calendar"></i>
                        <p style="color: grey;font-size: 14px;">Started Date: <?php echo date('d M Y', strtotime($_SESSION['created_at'])); ?></p>
                    </span>
                </span>
                <a href="#"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a>
            </div>
        </div>
    </main>
</body>

</html>