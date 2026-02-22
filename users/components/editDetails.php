<?php
$emailMatchedMessage = "";
$pClass1 = "";
$pClass2 = "";

$successMessage = "";

// Fetch current user data on page load
$id = $_SESSION['id']; 
$userSql = "SELECT * FROM user_info WHERE user_id='$id'";
$userResult = mysqli_query($conn, $userSql);
$currentUser = mysqli_fetch_assoc($userResult);

if (!$currentUser) {
    die("Error: User not found");
}

$credSql = "SELECT email FROM user_credentials WHERE id='$id'"; 
$credResult = mysqli_query($conn, $credSql);
$currentEmailRow = mysqli_fetch_assoc($credResult);
$currentEmail = $currentEmailRow['email'] ?? '';

// Get profile picture from database
$profilePicData = $currentUser['profile_pic'] ?? "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = !empty($_POST['email']) ? $_POST['email'] : $currentEmail;

    $emailCheckSql = "SELECT * FROM user_credentials WHERE email='$email' AND id != '$id'";
    $emailCheckResult = mysqli_query($conn, $emailCheckSql);

    if (mysqli_num_rows($emailCheckResult) > 0) {
        $pClass1 = "fail-text";
        $emailMatchedMessage = "<i class='fa-solid fa-exclamation'></i> Email already exists";
    } else {
        $full_name = !empty($_POST["full_name"]) ? mysqli_real_escape_string($conn, $_POST["full_name"]) : $currentUser['full_name'];
        $dob = !empty($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : $currentUser['date_of_birth'];
        $country = !empty($_POST['country']) ? mysqli_real_escape_string($conn, $_POST['country']) : $currentUser['country'];
        $city = !empty($_POST['city']) ? mysqli_real_escape_string($conn, $_POST['city']) : $currentUser['city'];
        $address = !empty($_POST['street']) ? mysqli_real_escape_string($conn, $_POST['street']) : $currentUser['address'];
        $phone_number = !empty($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : $currentUser['phone_number'];
        $interest = !empty($_POST['interest']) ? mysqli_real_escape_string($conn, $_POST['interest']) : $currentUser['interests'];

        $sql = "UPDATE user_info SET 
                    full_name='$full_name', 
                    date_of_birth='$dob', 
                    country='$country', 
                    city='$city', 
                    address='$address', 
                    phone_number='$phone_number', 
                    interests='$interest' 
                WHERE user_id='$id'";

        if (mysqli_query($conn, $sql)) {
            $updateEmailSql = "UPDATE user_credentials SET email='$email' WHERE id='$id'";
            mysqli_query($conn, $updateEmailSql);

            $_SESSION['full_name'] = $full_name;
            $_SESSION['dob'] = $dob;
            $_SESSION['country'] = $country;
            $_SESSION['city'] = $city;
            $_SESSION['address'] = $address;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['interest'] = $interest;
            $_SESSION['email'] = $email;

            $pClass1 = "success-text";
            $pClass2 = "success-text";
            $emailMatchedMessage = "<i class='fa-solid fa-circle-check'></i> Valid";
            $successMessage = "<i class='fa-solid fa-circle-check'></i> Update Sucessfull";
        } else {
            $pClass1 = "fail-text";
            $emailMatchedMessage = "<i class='fa-solid fa-exclamation'></i> Error updating profile: " . mysqli_error($conn);
        }
    }
}
?>

<div class="edit-details-container-wrapper">
    <h2>Change Details</h2>
    <div class="edit-details-container">
        <div class="design-img details-design-img">
             <?php if(!empty($profilePicData)): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($profilePicData) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="../../images/default-profile-pic.jpg" alt="Default Profile Picture">
            <?php endif; ?>
            <p><?= $_SESSION['full_name'] ?></p>
            <p><?= $_SESSION['interest'] ?></p>
        </div>
        <div class="change-field">
            <span>
                <h3>Change Details</h3>
                <p>You can change your details anytime you like</p>
            </span>
            <form action="" method="post">
                <div class="input-field-container-wrapper">
                    <div class="input-field-container">
                        <label for="full_name">Full Name: </label>
                        <div class="input-field-details">
                            <input type="text" name="full_name" id="full_name" placeholder="enter your full name">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="input-field-container">
                        <label for="dob">Date Of Birth: </label>
                        <div class="input-field-details">
                            <input type="date" name="dob" id="dob">
                        </div>
                    </div>
                </div>
                <div class="input-field-container-wrapper">
                    <div class="input-field-container">
                        <label for="country">Nationality: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-earth-asia"></i>
                            <input type="text" name="country" id="country" placeholder="Enter your country">
                        </div>
                    </div>
                </div>
                <div class="input-field-container-wrapper">
                    <div class="input-field-container">
                        <label for="city">City: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-city"></i>
                            <input type="text" name="city" id="city" placeholder="Enter your city">
                        </div>
                    </div>
                    <div class="input-field-container">
                        <label for="street">Street: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-road"></i>
                            <input type="text" name="street" id="street" placeholder="Enter your street">
                        </div>
                    </div>
                </div>
                <div class="input-field-container-wrapper">
                    <div class="input-field-container">
                        <label for="phone_number">Phone Number: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-phone"></i>
                            <input type="number" name="phone_number" id="phone_number" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="input-field-container">
                        <label for="email">Email: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-at"></i>
                            <input type="email" name="email" id="email" placeholder="<?php echo $_SESSION['email'] ?>">
                        </div>
                        <p class="<?= $pClass1 ?>"><?= $emailMatchedMessage ?></p>
                    </div>
                </div>
                <div class="input-field-container-wrapper">
                    <div class="input-field-container">
                        <label for="interest">Interest: </label>
                        <div class="input-field-details">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="interest" id="interest" placeholder="What's your interest ? ">
                        </div>
                    </div>
                </div>
                <button style="margin-top: 15px;" type="submit" id="saveChange">Save Changes</button><br>
                <p style="margin-top: 15px;" class="<?= $pClass2 ?>"><?php echo $successMessage ?></p>
            </form>
        </div>
    </div>
</div>