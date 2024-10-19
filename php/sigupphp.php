<?php
// require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $servername = "localhost";
    $username = "root";
    $dbname = "r_system";

    $conn = mysqli_connect($servername, $username, "", $dbname);

    if($conn){
        echo "Connected";
    }else{
        echo "Not Connected";
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    echo $name;
    echo $email;
    echo $password;
    echo $number;

    // $sql = "INSERT INTO user_info (name,email, password, number) VALUES ('$name', $email', '$password', '$number')";


    // if(mysqli_query($conn,$sql)){
    //     include 'index.html';
    // }
    // else{
    //     echo "Error: $sql <br> $con->error";
    // }

    $stmt = mysqli_prepare($conn, "INSERT INTO user_info(name, email, password, number) VALUES (?, ?, ?, ?)");

    
    

    mysqli_stmt_bind_param($stmt, "sssd", $name, $email, $hashedPassword, $number);

    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
        alert('Registered Successfully!');
        
        </script>
        ";
        unset($name);
        unset($email);
        unset($hashedpassword);
        unset($number);
        

        // header("Location: ./login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}

?>