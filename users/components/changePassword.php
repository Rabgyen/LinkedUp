<?php

$id = $_GET['id'] ?? $_SESSION['id'];
$pClass = "";

$currentPasswordMessage = "";
$newPasswordMessage = "";
$confirmPasswordMessage = "";
$passwordChangedMessage = "";

$currentPassword = false;
$newPassword = false;
$confirmPassword = false;
$passwordResultHash = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $current_password = isset($_POST['current-password']) ? $_POST['current-password'] : '';
    $new_password = isset($_POST['new-password']) ? $_POST['new-password'] : '';
    $confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';

    $passwordSql = "SELECT password_hash FROM user_credentials WHERE id='$id'";
    $passwordResult = mysqli_query($conn, $passwordSql);

    if (mysqli_num_rows($passwordResult) == 1) {
        $passwordResultRow = mysqli_fetch_assoc($passwordResult);
        $passwordResultHash = $passwordResultRow['password_hash'] ?? '';
    }

    if (password_verify($current_password, $passwordResultHash)) {
        $pClass1 = 'success-text';
        $currentPasswordMessage = "<i class='fa-solid fa-circle-check'></i> Correct";
        $currentPassword = true;
        if ($new_password != $current_password) {
            $pClass2 = 'success-text';
            $newPasswordMessage = "<i class='fa-solid fa-circle-check'></i> Valid";
            $newPassword = true;
            if ($confirm_password == $new_password) {
                $pClass3 = 'success-text';
                $confirmPasswordMessage = "<i class='fa-solid fa-circle-check'></i> Valid";
                $confirmPassword = true;
                if ($currentPassword && $newPassword && $confirmPassword) {
                    $confirm_password_hash = password_hash($confirm_password, PASSWORD_DEFAULT);
                    $updatePasswordSql = "UPDATE user_credentials SET password_hash = '$confirm_password_hash' WHERE id='$id'";
                    if (mysqli_query($conn, $updatePasswordSql)) {
                        $pClass4 = "success-text";
                        $passwordChangedMessage = "<i class='fa-solid fa-circle-check'></i> Password Changed";
                    } else {
                        $pClass4 = "fail-text";
                        $passwordChangedMessage = "<i class='fa-solid fa-circle-xcheck'></i> Error";
                    }
                }
            } else {
                $pClass3 = 'fail-text';
                $confirmPasswordMessage = "<i class='fa-solid fa-circle-xmark'></i> Invalid";
                $confirmPassword = false;
            }
        } else {
            $pClass2 = 'fail-text';
            $newPasswordMessage = "<i class='fa-solid fa-circle-xmark'></i> Same as current password";
            $newPassword = false;
        }
    } else {
        $pClass1 = 'fail-text';
        $currentPasswordMessage = "<i class='fa-regular fa-circle-xmark'></i> Incorrect";
        $currentPassword = false;
    }

}

?>

<div class="change-password-container-wrapper">
    <h2>Change Password</h2>
    <div class="change-password-container">
        <div class="design-img">
            <img src="../../images/security-password.png" alt="change password">
        </div>
        <div class="change-field">
            <span>
                <h3>Update Account Password</h3>
                <p>Update your password to strong password</p>
            </span>
            <form action="" method="post">
                <label for="current-password">Current Password: </label>
                <div class="password-input">
                    <input type="password" name="current-password" id="current-password" placeholder="enter your current passsword" required>
                    <i class="fa-solid fa-lock toggle" data-target="current-password"></i>
                </div>
                <p class="<?= $pClass1 ?>"><?= $currentPasswordMessage ?></p>
                <label for="new-password">New password:</label>
                <div class="password-input">
                    <input type="password" name="new-password" id="new-password" placeholder="enter your new password" required>
                    <i class="fa-solid fa-lock toggle" data-target="new-password"></i>
                </div>
                <p class="<?= $pClass2 ?>"><?= $newPasswordMessage ?></p>
                <label for="confirm-password">Confirm Password</label>
                <div class="password-input">
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="enter your confirm password" required>
                    <i class="fa-solid fa-lock toggle" data-target="confirm-password"></i>
                </div>
                <p class="<?= $pClass3 ?>"><?= $confirmPasswordMessage ?></p><br>
                <button type="submit" id="saveChange">Save Changes</button><br>
                <p class="<?= $pClass4 ?>"><?= $passwordChangedMessage ?></p><br>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.toggle').forEach(icon => {
        icon.addEventListener('click', function() {

            const input = document.getElementById(this.dataset.target);

            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;

            this.classList.toggle('fa-lock');
            this.classList.toggle('fa-lock-open');
        });
    });
</script>