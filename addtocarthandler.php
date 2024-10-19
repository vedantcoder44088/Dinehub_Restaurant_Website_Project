<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

    if ($conn) {
        echo "Connected";
    } else {
        echo "Not Connected";
        exit; // Exit if the connection is not successful
    }
    
    $menu_id = $_POST['menu_id'];

    $stmt = mysqli_prepare($conn, "SELECT id, name, price FROM menu_items WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $menu_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $price);
    mysqli_stmt_fetch($stmt);

    $email = $_SESSION['email'];
    
    // Check Table Name
    $tablename = "cart_of_" . $email;

    // Create a new connection for the "CREATE TABLE" query
    $conn2 = mysqli_connect('localhost', 'root', '', 'r_system');

    $result = mysqli_query($conn2, "SHOW TABLES LIKE '$tablename'");

    if ($result !== false) {
        if (mysqli_num_rows($result) > 0) {
            echo "Table Exists";

            // Create a new connection for INSERT
            $conn4 = mysqli_connect('localhost', 'root', '', 'r_system');
            
            $sql = "INSERT INTO `$tablename` (name, price) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn4, $sql);
            mysqli_stmt_bind_param($stmt, "sd", $name, $price); // "sd" corresponds to string and double (for price)
            
            if (mysqli_stmt_execute($stmt)) {
                echo "Data inserted into table '$tablename' successfully";
                header('location: viewcart.php');
            } else {
                echo "Error inserting data: " . mysqli_error($conn4);
            }

            mysqli_close($conn4); 
        } else {
            $sql = "CREATE TABLE `$tablename` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            $result = mysqli_query($conn2, $sql);

            if ($result) {
                
                $conn3 = mysqli_connect('localhost', 'root', '', 'r_system');
                
                $sql = "INSERT INTO `$tablename` (name, price) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn3, $sql);
                mysqli_stmt_bind_param($stmt, "sd", $name, $price); 
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "Data inserted into table '$tablename' successfully";

                    header('location: viewcart.php');
                } else {
                    echo "Error inserting data: " . mysqli_error($conn3);
                }

                mysqli_close($conn3);
            } else {
                echo "Error creating table: " . mysqli_error($conn2);
            }
        }

        // Free the result (only if it's not false)
        mysqli_free_result($result);
    } else {
        echo "Error checking if the table exists: " . mysqli_error($conn2);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    mysqli_close($conn2);
}

else{
    echo "
    <script>
        alert('Please Go To Login Page.....');
        window.location.href = 'login.php';
    </script>";
}
?>
