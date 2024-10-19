<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dinehub.</title>
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="css/main_style.css">
</head>
<body>
    <div class="row-1 col-12"></div>
    <div class="row-2">
        <div class="col-4"></div>
        <div class="col-4 container-main">
            <form action="" method="post" class="login-form">

                <h1 class="header">Dinehub.</h1>
                <h1 class="subheader">Login</h1>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email">
                </div>

                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                </div>

                <div class="checkbox-div">
                    <input type="checkbox" name="showpassword" id="showpassword"> <i>Show Password</i>
                </div>

                <div class="reset-password">
                    <a href="#">Forget Password ?</a>
                </div>
                
                <div class="login-btn-div btn-main">
                    <button type="submit">Login</button>
                </div>

                <div class="hr-or">
                    <hr><span class="or-text">OR</span><hr>
                </div>

                <div class="create-account-btn-div btn-main">
                    <button type="button" id="signupButton">Create Account</button>
                </div>

                <!-- <div class="continue-with-google-btn-div btn-main">
                    <button type="button">Continue With Google</button>
                </div> -->
                
            </form>
        </div>
        <div class="col-4"></div>
    </div>

    <!-- JAVAScript -->
    <script>
        const signupref = document.getElementById('signupButton');
        signupref.addEventListener('click', function(){
            window.location = 'signup.php';
        });
    </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

    if ($conn) {
        echo "Connected";
    } else {
        echo "Not Connected";
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    $stmt = mysqli_prepare($conn, "SELECT password FROM user_info WHERE email = ?");

    mysqli_stmt_bind_param($stmt, "s", $email);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $hashedPassword);
        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['email'] = $email;
                header("Location: index.php");
                // exit();
            } else {
                unset($_SESSION['loggedIn']);
                unset($_SESSION['email']);

                $loginError = "Invalid email or password";
            }
        } else {
            $loginError = "User not found";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    

    

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}



?>