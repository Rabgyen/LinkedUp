<?php

include '../../database/db_connection.php';

$emailError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullName = $_POST['fullName'] ?? '';
    $fullName = trim($fullName);
    $fullName = ucwords(strtolower($fullName));

    $email = $_POST['email'] ?? '';
    $dob = $_POST['dateOfBirth'] ?? '';
    $phNumber = $_POST['phNumber'] ?? '';
    $country = $_POST['nationality'] ?? '';
    $interest = $_POST['interest'] ?? '';
    $password = $_POST['password'] ?? '';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkEmailSql = "SELECT * FROM user_credentials WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $checkEmailSql);

    $emailError = (mysqli_num_rows($resultCheckEmail)) ? "*Email already exits*" : "";

    if (!$emailError) {
        $insertSql = "INSERT INTO user_credentials (full_name, email, dob, phone_number, country, interest, password_hash) VALUES ('$fullName', '$email', '$dob', '$phNumber', '$country', '$interest', '$hashedPassword')";

        if (mysqli_query($conn, $insertSql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/signUpStyle.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!---Google Fonts--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-wrapper">
        <div class="heading">
            <div class="logo">
                <img src="../../images/up-logo.png" alt="logo">
            </div>
            <h1>Sign Up</h1>
            <p>Enter your details below to create your account and get started.</p>
        </div>

        <form action="" method="post" id="signUpForm">

            <div class="container">
                <div class="name-container">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" placeholder="full name" required>
                </div>
                <div class="email-container">
                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                    <?php echo $emailError ? "<p style='color: red;'> $emailError </p>" : "" ?>
                </div>
            </div>

            <div class="container">
                <div class="dob-container">
                    <label for="dateOfBirth">Date of Birth: </label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" required>
                </div>

                <div class="ph-number-container">
                    <label for="phNumber">Phone Number: </label>
                    <input type="number" id="phNumber" name="phNumber" placeholder="Phone Number" required>
                </div>
            </div>

            <div class="container">
                <div class="country-container">
                    <label for="nationality">Select Country:</label>
                    <select name="nationality" id="nationality">
                        <option value="">-- Select Country --</option>

                        <option value="AF">Afghanistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AR">Argentina</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BE">Belgium</option>
                        <option value="BR">Brazil</option>
                        <option value="CA">Canada</option>
                        <option value="CN">China</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IT">Italy</option>
                        <option value="JP">Japan</option>
                        <option value="MY">Malaysia</option>
                        <option value="NP">Nepal</option>
                        <option value="NL">Netherlands</option>
                        <option value="NO">Norway</option>
                        <option value="PK">Pakistan</option>
                        <option value="PH"> Philippines</option>
                        <option value="RU">Russia</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="KR">South Korea</option>
                        <option value="ES">Spain</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="TH">Thailand</option>
                        <option value="TR">Turkey</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="GB">United Kingdom</option>
                        <option value="US">United States</option>
                        <option value="VN">Vietnam</option>
                    </select>
                </div>

                <div class="role-container">
                    <label for="interest">Role/Intererst: </label>
                    <input type="text" name="interest" id="interest" placeholder="Role/Interest" required>
                </div>

            </div>

            <div class="pass-confirm-container">
                <div class="pass-container">
                    <div class="password-container">
                        <label for="password">Password: </label>
                        <div class="password-field">
                            <input type="password" name="password" id="password" placeholder="passowrd" required>
                            <input type="checkbox" id="passwordToggle1">
                            <label for="passwordToggle1">
                                <i class="fa-solid fa-lock"></i>
                            </label>
                        </div>
                    </div>

                    <div class="confirm-password-container">
                        <label for="confirmPassword">Password: </label>
                        <div class="confirm-password-field">
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="confirm password" required>
                            <input type="checkbox" id="passwordToggle2">
                            <label for="passwordToggle2">
                                <i class="fa-solid fa-lock"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <p id="passwordError"></p>
            </div>

            <div class="confirm">
                <button>Cancel</button>
                <button type="submit">Submit</button>
            </div>
        </form>
        <span>
            <p>Already have an account? </p> <a href="./login.php">Login</a>
        </span>
    </div>
</body>
<script>
    const passwordField1 = document.getElementById("password");
    const togglePasswordField1 = document.getElementById("passwordToggle1");

    const passwordIcon1 = document.querySelector('label[for="passwordToggle1"] i');

    togglePasswordField1.addEventListener("change", (e) => {
        const checked = e.target.checked;
        passwordField1.type = checked ? "text" : "password";
        if (passwordIcon1) {
            passwordIcon1.className = checked ? 'fa-solid fa-lock-open' : 'fa-solid fa-lock';
        }
    });

    const passwordField2 = document.getElementById("confirmPassword");
    const togglePasswordField2 = document.getElementById("passwordToggle2");

    const passwordIcon2 = document.querySelector('label[for="passwordToggle2"] i');

    togglePasswordField2.addEventListener("change", (e) => {
        const checked = e.target.checked;
        passwordField2.type = checked ? "text" : "password";
        if (passwordIcon2) {
            passwordIcon2.className = checked ? 'fa-solid fa-lock-open' : 'fa-solid fa-lock';
        }
    });

    const form = document.getElementById("signUpForm");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', (e) => {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            passwordError.innerHTML = "*Password does not match*";
            confirmPassword.focus();
        }
    })
</script>

</html>