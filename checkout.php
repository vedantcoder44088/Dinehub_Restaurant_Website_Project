<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

    if ($conn) {
        // echo "Connected";
    } else {
        echo "Not Connected";
        exit;
    }

    $email = $_SESSION['email'];
    $tablename = "cart_of_" . $email;


    $orderID = "ORDER_" . mt_rand(1000, 9999);

    $orderDate = date("Y-m-d");
    $orderTime = date("H:i:s");


    $sql = "SELECT SUM(price) AS total_amount FROM `$tablename`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalAmount = $row['total_amount'];

    $paymentMethod = $_POST['payment_method'];

    $sql = "INSERT INTO order_info (order_id, order_date, order_time, amount, email, payment_method) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsss", $orderID, $orderDate, $orderTime, $totalAmount, $email, $paymentMethod);
    
    if (mysqli_stmt_execute($stmt)) {
        $sql = "DROP TABLE IF EXISTS `$tablename`";
        mysqli_query($conn, $sql);

        // echo "Order placed successfully! Order ID: $orderID";

        echo "
            <script>
                alert('ORDER ID:' $orderID);
                window.location.href = 'login.php';
            </script>";
    } else {
        echo "Error inserting order information: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

else{
    // echo "
    // <script>
    //     alert('ORDER ID:' $orderID);
    //     window.location.href = 'login.php';
    // </script>";

}
?>