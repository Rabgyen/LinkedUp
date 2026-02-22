<?php

session_start();
include '../../database/db_connection.php';
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'editprofile';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Your Account</title>
    <link rel="stylesheet" href="../style/editStyle.css">
    <link rel="icon" type="image/png" href="../../images/up-logo.png">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!---Google Fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div>
                <a href="profile.php">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Back to home
                </a>
            </div>
            <div>
                <i class="fa-solid fa-bell"></i>
                <span>
                    <a href="logout.php" class="logout">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </span>
            </div>
        </nav>
    </header>
    <main>
        <div class="edit-container">
            <div class="edit-nav">
                <a href="edit.php?page=editprofile&id=<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>"
                    class="edit-page <?= ($currentPage == 'editprofile') ? 'active' : '' ?>">
                    Edit Profile
                </a>

                <a href="edit.php?page=changepassword&id=<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>"
                    class="edit-page <?= ($currentPage == 'changepassword') ? 'active' : '' ?>">
                    Change Password
                </a>

                <a href="edit.php?page=editdetail&id=<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>"
                    class="edit-page <?= ($currentPage == 'editdetail') ? 'active' : '' ?>">
                    Edit Details
                </a>
            </div>
            <?php
                if($currentPage == 'editprofile'){
                    include '../components/editProfile.php';
                }elseif($currentPage == 'changepassword'){
                    include '../components/changePassword.php';
                }elseif($currentPage == 'editdetail'){
                    include '../components/editDetails.php';
                }else{
                    header("Location: accessDenied.php");
                }
            ?>
        </div>
    </main>
</body>

</html>