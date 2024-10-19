<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp - Dinehub.</title>
    <link rel="stylesheet" href="css/signup_style.css">
    <link rel="stylesheet" href="css/main_style.css">
</head>
<body>
    <div class="row-1 col-12"></div>
    <div class="row-2">
        <div class="col-4"></div>
        <div class="col-4 container-main">
            <form action="signup.php" method="POST" class="signup-form">

                <h1 class="header">Dinehub.</h1>
                <h1 class="subheader">SignUp</h1>

                <div class="input-field">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name">
                </div>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email">
                </div>

                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                </div>

                <div class="input-field">
                    <label for="confirm-password">Confirm-Password</label>
                    <input type="password" name="co-password" id="confirm-password" placeholder="Enter Confirm-Password">
                </div>

                <div class="input-field">
                    <label for="text">Mobile Number</label>
                    <input type="text" name="number" id="number" placeholder="Enter Mobile No.">
                </div>

                <div class="checkbox-div">
                    <input type="checkbox" name="showpassword" id="showpassword"><i> Show Password</i>
                </div>

                <div class="link-login-page">
                    <a href="login.html">If you already have an account ?</a>
                </div>
                
                <div class="sign-btn-div btn-main">
                    <button type="submit">SignUp</button>
                </div>

                <!-- <div class="hr-or">
                    <hr><span class="or-text">OR</span><hr>
                </div>

                <div class="continue-with-google-btn-div btn-main">
                    <button type="button">Continue With Google</button>
                </div> -->
                
            </form>
        </div>
        <div class="col-4"></div>
    </div>
    <script>
        const passwordInput = document.getElementById('password');
        const confirmpasswordInput = document.getElementById('confirm-password');
        const showpasswordInput = document.getElementById('showpassword');

        showpasswordInput.addEventListener('click', function(){
            passwordInput.type = showpasswordInput.checked ? "text" : "password";
            confirmpasswordInput.type = showpasswordInput.checked ? "text" : "password";
        })

    </script>
</body>
</html>

<?php
// require 'connection.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

    if ($conn) {
        echo "Connected";
    } else {
        echo "Not Connected";
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $otp = rand(1000, 9999);
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'homepc44088@gmail.com';
        $mail->Password = 'sbzwkqffboqpyzpp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('homepc44088@gmail.com', 'Admin');
        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);
        $mail->Subject = 'Registration Completed';
        $mail->Body = 'Hello ' . $name . ',<br> Thanks for registration OPT: '. $otp  . '.';
        $mail->AltBody = 'This is the plain text message body';

        $mail->send();
        echo 'Email sent successfully.';

    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }

    echo "
            <script>
                var inputOtp = prompt('Please enter the OTP sent to your email', '');
                if (inputOtp === '$otp') {
                    window.location.href = 'login.php';
                } else {
                    alert('Invalid OTP. Please try again.');
                    window.location.href = 'signup.php';
                }
            </script>
        ";

    


    $stmt = mysqli_prepare($conn, "INSERT INTO user_info(name, email, password, number) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPassword, $number);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['email'] = $email;
        $_SESSION['password_hash'] = $hashedPassword;

        echo "Registered Successfully!";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>