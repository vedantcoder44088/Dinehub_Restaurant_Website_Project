<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

    if ($conn) {
        echo "Connected";
    } else {
        echo "Not Connected";
        exit; // Exit if the connection is not successful
    }

    $email = 'homepc44088@gmail.com';
    $tablename = "cart_of_" . $email;

    $id = $_GET['id'];
    $sql = "DELETE FROM `$tablename` WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id); // "i" corresponds to integer
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header('location: viewcart.php'); // Redirect back to the cart view
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
