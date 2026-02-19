<?php

session_start();
include '../../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_SESSION['id'];
    
    $userSql = "SELECT * FROM user_info WHERE user_id='$id'";
    $userResult = mysqli_query($conn, $userSql);
    $currentUser = mysqli_fetch_assoc($userResult);
    
    $full_name = !empty($_POST["full_name"]) ? $_POST["full_name"] : $currentUser['full_name'];
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : $currentUser['date_of_birth'];
    $country = !empty($_POST['country']) ? $_POST['country'] : $currentUser['country'];
    $city = !empty($_POST['city']) ? $_POST['city'] : $currentUser['city'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $currentUser['address'];
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : $currentUser['phone_number'];
    $interest = !empty($_POST['interest']) ? $_POST['interest'] : $currentUser['interests'];

    $sql = "UPDATE user_info SET full_name = '$full_name', date_of_birth = '$dob', country = '$country', city = '$city', address='$address', phone_number='$phone_number', interests='$interest' WHERE user_id='$id'";

    if(mysqli_query($conn, $sql)){
        $_SESSION['full_name'] = $full_name;
        $_SESSION['dob'] = $dob;
        $_SESSION['country'] = $country;
        $_SESSION['city'] = $city;
        $_SESSION['address'] = $address;
        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['interest'] = $interest;
        
        echo "<p style='color:green;'>Profile Updated Successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/editStyle.css">
    <link rel="stylesheet" href="../style/mainStyle.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!---Google Fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header><?php
            include '../components/navbar.php';
            ?></header>
    <main>
        <div class="edit-container">
            <h1>Edit Profile</h1>
            <form action="" method="post">
                <h3>Avatar</h3>
                <div class="profile-img-upload">
                    <img src="../../images/user.jpg" alt="">
                    <span>
                        <button id="uploadBtn">Upload New Profile Picture</button>
                        <input type="file" id="hiddenInput" style="display:none">
                        <p>Upload your new profile picture from here!</p>
                    </span>
                </div>
                <div class="edit-detail-container">
                    <label for="full_name">Name: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="full_name" id="full_name" placeholder="<?php echo htmlspecialchars(isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''); ?>">
                        </div>
                    </div>
                    <label for="email">Email: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="text" name="email" id="email" placeholder="<?php echo htmlspecialchars(isset($_SESSION['email']) ? $_SESSION['email'] : ''); ?>">
                        </div>
                    </div>
                    <label for="dob">Date Of Birth: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="text" name="dob" id="dob" placeholder="<?php echo htmlspecialchars(isset($_SESSION['dob']) ? $_SESSION['dob'] : ''); ?>">
                        </div>
                    </div>
                    <label for="country">Nationality: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-solid fa-earth-americas"></i>
                            <input type="text" name="country" id="country" placeholder="<?php echo htmlspecialchars(isset($_SESSION['country']) ? $_SESSION['country'] : ''); ?>">
                        </div>
                    </div>
                    <label for="city">City: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-regular fa-building"></i>
                            <input type="text" name="city" id="city" placeholder="<?php echo htmlspecialchars(isset($_SESSION['city']) ? $_SESSION['city'] : ''); ?>">
                        </div>
                    </div>
                    <label for="address">Address: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <input type="text" name="address" id="address" placeholder="<?php echo htmlspecialchars(isset($_SESSION['address']) ? $_SESSION['address'] : ''); ?>">
                        </div>
                    </div>
                    <label for="phone_number">Phone Number: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="phone_number" id="phone_number" placeholder="<?php echo htmlspecialchars(isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : ''); ?>">
                        </div>
                    </div>
                    <label for="interest">Role/Interest: </label>
                    <div class="edit-detail">
                        <div class="edit-input">
                            <i class="fa-solid fa-suitcase"></i>
                            <input type="text" name="interest" id="interest" placeholder="<?php echo htmlspecialchars(isset($_SESSION['interest']) ? $_SESSION['interest'] : ''); ?>">
                        </div>
                    </div>
                   <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </main>
</body>
<script>
    const btn = document.getElementById("uploadBtn");
    const input = document.getElementById("hiddenInput");

    btn.addEventListener("click", () => {
        input.click();
    });
</script>

</html>