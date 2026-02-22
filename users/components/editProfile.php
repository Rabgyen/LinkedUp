<?php

$message = "";
$pClass = "";

// Get user ID from GET or session
$id = $_GET['id'] ?? $_SESSION['id'];

// Fetch current user data
$userSql = "SELECT * FROM user_info WHERE user_id='$id'";
$userResult = mysqli_query($conn, $userSql);
$currentUser = mysqli_fetch_assoc($userResult);

// Check if user exists
if (!$currentUser) {
    die("User not found");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Handle image removal
    if (isset($_POST['remove_image'])) {
        $removeSql = "UPDATE user_info SET profile_pic=NULL WHERE user_id='$id'";
        if (mysqli_query($conn, $removeSql)) {
            $pClass = 'success-text';
            $message = "<i class='fa-solid fa-circle-check'></i> Image Removed Successfully";

            // Refresh current user data after update
            $userResult = mysqli_query($conn, $userSql);
            $currentUser = mysqli_fetch_assoc($userResult);
            $profilePicData = $currentUser['profile_pic'] ?? "";
        } else {
            $pClass = 'fail-text';
            $message = "<i class='fa-solid fa-circle-xmark'></i> Error removing image: " . mysqli_error($conn);
        }
    }

    // Full name and bio
    $full_name = !empty($_POST["full_name"]) ? mysqli_real_escape_string($conn, $_POST["full_name"]) : $currentUser['full_name'];
    $bio = !empty($_POST["bio"]) ? mysqli_real_escape_string($conn, $_POST["bio"]) : $currentUser['bio'];

    // Profile picture handling
    $profile_pic_sql = "";
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $imageData = mysqli_real_escape_string($conn, file_get_contents($_FILES['profile_pic']['tmp_name']));
        $profile_pic_sql = ", profile_pic='$imageData'";
    }

    // Update user info query
    $updateSql = "UPDATE user_info SET full_name='$full_name', bio='$bio' $profile_pic_sql WHERE user_id='$id'";
    if (mysqli_query($conn, $updateSql)) {
        // Update session variables
        $_SESSION['full_name'] = $full_name;
        $_SESSION['bio'] = $bio;
        $pClass = 'success-text';
        $message = "<i class='fa-solid fa-circle-check'></i> Changes Saved";

        // Refresh current user data after update
        $userResult = mysqli_query($conn, $userSql);
        $currentUser = mysqli_fetch_assoc($userResult);
    } else {
        $pClass = 'fail-text';
        $message = "<i class='fa-solid fa-circle-xmark'></i> Error Occurred: " . mysqli_error($conn);
    }
}

// Fetch profile picture to display
$profilePicData = $currentUser['profile_pic'] ?? "";
?>

<div class="editProfile">
    <h2>Edit Profile</h2>
    <div class="edit-profile-container">
        <!-- Profile Picture Section -->
        <div class="edit-profile-img">
            <?php if (!empty($profilePicData)): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($profilePicData) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="../../images/default-profile-pic.jpg" alt="Default Profile Picture">
            <?php endif; ?>
            <span>
                <span style="display: flex; gap: 15px;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <button type="button" id="upload-img-btn"><i class="fa-solid fa-plus"></i> Change Image</button>
                        <input type="file" id="img-input" name="profile_pic" accept="image/*" hidden>
                    </form>
                    <form action="" method="post" style="display:inline;">
                        <button type="submit" name="remove_image" value="1" class="remove-btn"><i class="fa-solid fa-trash"></i> Remove Image</button>
                    </form>
                </span>
                <p>Change your picture anytime you like!</p>
            </span>
        </div>

        <!-- Profile Details Section -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="edit-profile-name">
                <label for="full_name">Full Name: </label>
                <div class="input-field">
                    <input type="text" name="full_name" id="full_name" placeholder="<?= $_SESSION['full_name'] ?>" value="<?= htmlspecialchars($currentUser['full_name']) ?>">
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>

            <div class="edit-profile-bio">
                <label for="bio">Bio: </label>
                <textarea maxlength="150" name="bio" id="bio" placeholder="Write your thoughts..."><?= htmlspecialchars($currentUser['bio']) ?></textarea>
                <p><span id="count"><?= strlen($currentUser['bio'] ?? "") ?></span>/150 characters</p>
            </div>

            <button type="submit" id="saveChange">Save Changes</button><br>
            <p class="<?= $pClass ?>"><?= $message ?></p>
        </form>
    </div>
</div>

<script>
    // Character counter for bio
    const bio = document.getElementById("bio");
    const count = document.getElementById("count");
    bio.addEventListener("input", function() {
        count.textContent = bio.value.length;
    });

    // Custom upload button
    const uploadImgBtn = document.getElementById('upload-img-btn');
    const imgInput = document.getElementById('img-input');
    uploadImgBtn.addEventListener('click', () => {
        imgInput.click();
    });

    // Optional: auto-submit image form when file selected
    imgInput.addEventListener('change', () => {
        imgInput.form.submit();
    });
</script>