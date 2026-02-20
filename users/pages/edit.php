<?php

session_start();
include '../../database/db_connection.php';
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'editprofile';

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $id = $_SESSION['id'];

//     $userSql = "SELECT * FROM user_info WHERE user_id='$id'";
//     $userResult = mysqli_query($conn, $userSql);
//     $currentUser = mysqli_fetch_assoc($userResult);

//     $full_name = !empty($_POST["full_name"]) ? $_POST["full_name"] : $currentUser['full_name'];
//     $dob = !empty($_POST['dob']) ? $_POST['dob'] : $currentUser['date_of_birth'];
//     $country = !empty($_POST['country']) ? $_POST['country'] : $currentUser['country'];
//     $city = !empty($_POST['city']) ? $_POST['city'] : $currentUser['city'];
//     $address = !empty($_POST['address']) ? $_POST['address'] : $currentUser['address'];
//     $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : $currentUser['phone_number'];
//     $interest = !empty($_POST['interest']) ? $_POST['interest'] : $currentUser['interests'];

//     $sql = "UPDATE user_info SET full_name = '$full_name', date_of_birth = '$dob', country = '$country', city = '$city', address='$address', phone_number='$phone_number', interests='$interest' WHERE user_id='$id'";

//     if (mysqli_query($conn, $sql)) {
//         $_SESSION['full_name'] = $full_name;
//         $_SESSION['dob'] = $dob;
//         $_SESSION['country'] = $country;
//         $_SESSION['city'] = $city;
//         $_SESSION['address'] = $address;
//         $_SESSION['phone_number'] = $phone_number;
//         $_SESSION['interest'] = $interest;

//         echo "<p style='color:green;'>Profile Updated Successfully!</p>";
//     } else {
//         echo "<p style='color:red;'>Error updating profile: " . mysqli_error($conn) . "</p>";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/editStyle.css">
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
                <a href="#">
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
                <a href="edit.php?page=editprofile"
                    class="edit-page <?= ($currentPage == 'editprofile') ? 'active' : '' ?>">
                    Edit Profile
                </a>

                <a href="edit.php?page=changepassword"
                    class="edit-page <?= ($currentPage == 'changepassword') ? 'active' : '' ?>">
                    Change Password
                </a>

                <a href="edit.php?page=editdetail"
                    class="edit-page <?= ($currentPage == 'editdetail') ? 'active' : '' ?>">
                    Edit Details
                </a>
            </div>
            <?php
                if(isset($_GET['page'])){
                    if($currentPage == 'editprofile'){
                        include '../components/editProfile.php';
                    }elseif($currentPage == 'changepassword'){
                        include '../components/changePassword.php';
                    }elseif($currentPage =='editdetail'){
                        include '../components/editDetails.php';
                    }else{
                        header("Location: accessDenied.php");
                    }

                }
            ?>
        </div>
    </main>
</body>

</html>