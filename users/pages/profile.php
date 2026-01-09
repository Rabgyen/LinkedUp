<?php

session_start();
include '../../database/db_connection.php';
if (!isset($_SESSION["email"])) {
    header("Location: accessDenied.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_SESSION['id'];
    
    $sql = "DELETE FROM `user_credentials` WHERE id = '$id'";
    
    if(mysqli_query($conn, $sql)){
        $_SESSION = [];
        session_destroy();
        header("Location: login.php");
        exit();
    }

}

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
                    <p style="font-size: 22px; font-weight: bold; color: black"><?php echo $_SESSION['full_name'] ?></p>
                    <span style="display: flex; align-items: center; gap:5px;">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>Started Date: <?php echo date('d M Y', strtotime($_SESSION['created_at'])); ?></p>
                    </span>
                </span>
                <a href="#" class="log-out-btn edit-btn" id="log-out-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
            </div>
            <div class="profile-detail-container-wrapper">
                <div class="profile-detail-header">
                    <span>
                        <p style="color: black; font-size: 18px; font-weight: bold;">Profile Details</p>
                        <span style="display: flex; align-items: center; gap:5px;">
                            <i class="fa-solid fa-wrench"></i>
                            <p>Updated Date: <?php echo date('d M Y', strtotime($_SESSION['updated_at'])); ?></p>
                        </span>
                    </span>
                    <span style="display: flex; gap: 10px"> <a href="#" class="btn edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a>
                <a href="#" class="delete-btn edit-btn" id="delete-btn"><i class="fa-solid fa-trash"></i> Delete Profile</a></span>
                </div>
                <div class="profile-detail-container">
                    <div class="profile-detail">
                        <i class="fa-regular fa-user"></i>
                        <span>
                            <p class="font-size:10px;">Full Name: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['full_name'] ?></p>
                        </span>
                    </div>

                    <div class="profile-detail">
                        <i class="fa-regular fa-envelope"></i>
                        <span>
                            <p class="font-size:10px;">Email: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['email'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-regular fa-calendar"></i>
                        <span>
                            <p class="font-size:10px;">Date of birth: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['dob'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-solid fa-earth-americas"></i>
                        <span>
                            <p class="font-size:10px;">Nationality: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['country'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-regular fa-building"></i>
                        <span>
                            <p class="font-size:10px;">City: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['city'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <span>
                            <p class="font-size:10px;">Address: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['address'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-solid fa-phone"></i>
                        <span>
                            <p class="font-size:10px;">Phone Number: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['phone_number'] ?></p>
                        </span>
                    </div>
                    <div class="profile-detail">
                        <i class="fa-solid fa-suitcase"></i>
                        <span>
                            <p class="font-size:10px;">Role/Interest: </p>
                            <p style="font-size: 14px; color: black; font-weight: 600;"><?php echo $_SESSION['interest'] ?></p>
                        </span>
                    </div>
                </div>
            </div>
            <span id="post-list-header">
                <p style="font-size: 22px; font-weight: bold; color: black">Your Posts:</p>
            </span>
            <div class="post-container">
                <?php include '../components/posts.php' ?>
            </div>
        </div>
    </main>
    <div class="delete-pop-up" id="delete-pop-up">
        <div class="delete-confirmation-container">
        <form action="" method="post">
            <div class="delete-logo">
                <i class="fa-solid fa-trash"></i>
            </div>
            <p style="font-size: 20px; text-align: center;max-width: 250px;">Are you sure you want to delete your account?</p>
            <p style="color:#8a8c8d;font-size: 14px;"><?php echo $_SESSION['email'] ?></p>
            <span>
                <button id="cancelBtn" type="button">Cancel</button>
                <button id="deleteConfirmBtn" type="submit">Delete Account</button>
            </span>
        </form>
    </div>
    </div>
</body>
<script>
    const deletePopUp = document.getElementById('delete-pop-up');
    const cancelBtn = document.getElementById('cancelBtn');
    const openDelete = document.getElementById('delete-btn');

    if(openDelete){
        openDelete.addEventListener('click', (e) => {
            e.preventDefault();
            deletePopUp.classList.add('show');
        });
    }

    if(cancelBtn){
        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            deletePopUp.classList.remove('show');
        });
    }

</script>
</html>