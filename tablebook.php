<?php
session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
    function generateReservationID($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $reservationID = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $reservationID .= $characters[$randomIndex];
        }
    
        return $reservationID;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = mysqli_connect('localhost', 'root', '', 'r_system');
    
        if ($conn) {
            echo "Connected";
        } else {
            echo "Not Connected";
        }
        $reservationid = generateReservationID();
        $email = $_SESSION['email'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $person = $_POST['person'];
    
        echo $reservationid, $name, $number, $date, $time, $person;
    
        $stmt = mysqli_prepare($conn, "INSERT INTO table_booking(resid, email, name, number, date, time, person) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
        mysqli_stmt_bind_param($stmt, "sssssss", $reservationid, $email,$name, $number, $date, $time, $person);
    
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('Table Book Success. Table Booking ID: " . $reservationid . "');
            </script>";

            unset($reservationid);
            unset($name);
            unset($number);
            unset($date);
            unset($time);
            unset($person);
            
            header("Location: index.php");

            // exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
    
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
    echo "<script>
    alert('Login After Book Table !');
    </script>";

    header("Location: login.php");
}


?>