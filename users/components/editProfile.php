<?php

    include '../../database/db_connection.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $full_name = $_POST['full_name'];
        
    }

?>


<div class="editProfile">
    <h2>Edit Profile</h2>
    <div class="edit-profile-img">
        <img src="../../images/user.jpg" alt="">
        <span>
            <button type="button" id="upload-img-btn"><i class="fa-solid fa-plus"></i> Change Image</button>
            <button type="button" id="remove-img-btn">Remove Image</button>
            <input type="file" id="realInput" accept="image/*" hidden>
            <p>Change your picture anytime you like!</p>
        </span>
    </div>
    <form action="" method="post">
        <div class="edit-profile-name">
            <label for="full_name">Full Name: </label><br>
            <div class="input-field">
                <input type="text" name="full_name" id="full_name" placeholder="<?php echo $_SESSION['full_name'] ?>" required>
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <div class="edit-profile-bio">
            <label for="bio">Bio: </label><br>
            <textarea maxlength="150" name="bio" id="bio" placeholder="Write your thoughs...."></textarea>
            <p><span id="count">0</span>/200 characters</p>
        </div>
        <button type="submit" id="saveChange">Save Changes</button>
    </form>
</div>
<script>
    const bio = document.getElementById("bio");
    const count = document.getElementById("count");

    bio.addEventListener("input", function() {
        count.textContent = bio.value.length;
    });
</script>