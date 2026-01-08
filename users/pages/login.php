<?php

    session_start();
    include '../../database/db_connection.php';

    $emailNotFound = '';
    $passwordError = '';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user_credentials WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $rows = mysqli_fetch_assoc($result);
            $hashedPassword = $rows['password_hash'];

            if(password_verify($password, $hashedPassword)){
                $_SESSION['id'] = $rows['id'] ?? "N/A";
                $_SESSION['full_name'] = $rows['full_name'] ?? "N/A";
                $_SESSION['email'] = $rows['email'] ?? "N/A";
                $_SESSION['dob'] = $rows['dob'] ?? "N/A";
                $_SESSION['phone_number'] = $rows['phone_number'] ?? "N/A";
                $_SESSION['country'] = $rows['country'] ?? "N/A";
                $_SESSION['city'] = $rows['city'] ?? "N/A";
                $_SESSION['address'] = $rows['address'] ?? "N/A";
                $_SESSION['interest'] = $rows['interest'] ?? "N/A";
                $_SESSION['created_at'] = $rows['created_at'] ?? "N/A";
                $_SESSION['updated_at'] = $rows['updated_at'] ?? "N/A";


                header("Location: home.php");
                exit();
            }else{
                $passwordError = "<p style='color:red; font-size: 12px;'>Invalid Password</p>";
            }
        }else{
            $emailNotFound = "<p style='color:red; font-size: 12px;'>Invalid Email</p>";
        }

    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/loginStyle.css">
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
            <h1>Welcome Back!</h1>
            <p>Glab to see you again 👋 <br> Login to your account below</p>
        </div>
        <form action="" method="post">
            <label for="email">Email: </label>
            <span>
                <input type="email" name="email" id="email" placeholder="enter email..." required>
                <?php echo ($emailNotFound) ? $emailNotFound : ""; ?>
            </span>
            <label for="password">Password:</label>
            <span>
                <div class="password-field">
                <input type="password" name="password" id="password" placeholder="enter password..." required>
                <input type="checkbox" id="passwordToggle1">
                <label for="passwordToggle1">
                    <i class="fa-solid fa-lock"></i>
                </label>
            </div>
            <?php echo ($passwordError) ? $passwordError : ""; ?>
            </span>
            <button type="submit">Login</button>
        </form>
        <span id="signUp">
            <p>Don't have an account? </p> <a href="./signUp.php">Sign Up</a>
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
</script>

</html>