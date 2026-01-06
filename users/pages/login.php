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
            <input type="email" name="email" id="email" placeholder="enter email..." required>
            <label for="password">Password:</label>
            <div class="password-field">
                <input type="password" name="password" id="password" placeholder="enter password..." required>
                <input type="checkbox" id="passwordToggle1">
                <label for="passwordToggle1">
                    <i class="fa-solid fa-lock"></i>
                </label>
            </div>
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