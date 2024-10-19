<?php

session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userEmail = $_SESSION['email'];


$userDetails = array();
$userSql = "SELECT name, email, number FROM user_info WHERE email = ?";
$userStmt = mysqli_prepare($conn, $userSql);

if ($userStmt) {
    mysqli_stmt_bind_param($userStmt, "s", $userEmail);

    if (mysqli_stmt_execute($userStmt)) {
        mysqli_stmt_bind_result($userStmt, $userName, $userEmail, $userNumber);
        mysqli_stmt_fetch($userStmt);
        
        $userDetails = array(
            'name' => $userName,
            'email' => $userEmail,
            'number' => $userNumber,
        );
    }
    
    mysqli_stmt_close($userStmt);
}


$bookingHistory = array();
$bookingSql = "SELECT resid, date, time, person FROM table_booking WHERE email = ?";
$bookingStmt = mysqli_prepare($conn, $bookingSql);

if ($bookingStmt) {
    mysqli_stmt_bind_param($bookingStmt, "s", $userEmail);

    if (mysqli_stmt_execute($bookingStmt)) {
        mysqli_stmt_bind_result($bookingStmt, $resid, $date, $time, $person);

        while (mysqli_stmt_fetch($bookingStmt)) {
            $bookingHistory[] = array(
                'resid' => $resid,
                'date' => $date,
                'time' => $time,
                'person' => $person,
            );
        }
    }

    mysqli_stmt_close($bookingStmt);
}

$orderHistory = array();
$orderSql = "SELECT order_id, order_date, order_time, amount, payment_method FROM order_info WHERE email = ?";
$orderStmt = mysqli_prepare($conn, $orderSql);

if ($orderStmt) {
    mysqli_stmt_bind_param($orderStmt, "s", $userEmail);

    if (mysqli_stmt_execute($orderStmt)) {
        mysqli_stmt_bind_result($orderStmt, $orderID, $orderDate, $orderTime, $orderAmount, $paymentMethod);

        while (mysqli_stmt_fetch($orderStmt)) {
            $orderHistory[] = array(
                'order_id' => $orderID,
                'order_date' => $orderDate,
                'order_time' => $orderTime,
                'amount' => $orderAmount,
                'payment_method' => $paymentMethod,
            );
        }
    }

    mysqli_stmt_close($orderStmt);
}

mysqli_close($conn);
}
else{
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="css/main_style.css">
    <link rel="stylesheet" href="css/navbar_style.css">
    <link rel="stylesheet" href="css/footer_style.css">
    <link rel="stylesheet" href="css/profile_style.css">

    <!-- Google ICON-CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <!-- UP - Navbar -->
    <div class="info">
        <div class="col-1"></div>
        <div class="num col-4">
            <p> +91 9512951842</p>
        </div>
        <div class="email col-4">
            <p>info.dinehub@gmail.com</p>
        </div>
        <div class="time col-4">
            <p>Open hours: Monday - Sunday 8:00AM to 9:00PM</p>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- Navbar Code -->
    <div class="main-row" id="nav-row">
        <div class="col-1"></div>
        <div class="navbar col-10">
            <a href="index.html" class="logo-link">Dinehub.<a>
            <div class="routes-links">
                <a href="index.php">HOME</a>
                <a href="menu.php">MENU</a>
                <a href="table-re.php">BOOK TABLE</a>
                <a href="contact_us.php">CONTACT US</a>
            </div> 
            <?php
            
            if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
                echo "
                <div class='login-final'>
                    <div class='addtocart-btn'>
                        <button id='addtocartButton' class='addtocart-link'>
                        <span class='material-symbols-outlined'>
                        shopping_cart
                        </span></button>
                    </div>
                    
                    <div class='user-btn'>
                        <button id='userButton' class='user-link'>
                        <span class='material-symbols-outlined'>
                            account_circle
                        </span>
                        </button>
                    </div>

                    <div class='logout-btn'>
                        <button id='logoutButton' class=logout-link'>Log Out</button>
                    </div>
                </div>
                ";  

                echo "<script>
                    const addtocartButton = document.getElementById('addtocartButton');
                    addtocartButton.addEventListener('click', function(){
                        window.location = 'viewcart.php'; // Redirect to viewcart.php
                    });

                    const userButton = document.getElementById('userButton');
                    userButton.addEventListener('click', function(){
                        window.location = 'profile.php';
                    });

                    const logoutButton = document.getElementById('logoutButton');
                    logoutButton.addEventListener('click', function(){
                        window.location = 'logout.php';
                    });
                </script>";
            } else {
                echo "<div class='login-btn' id='login-btn'>
                    <button class='login-link' id='loginButton'>Log In</button>
                </div>";

                echo "<script>
                const loginref = document.getElementById('loginButton');
                loginref.addEventListener('click', function(){
                    window.location = 'login.php';
                });
                </script>";
            }
            ?>
        </div>
        <div class="col-1"></div>
    </div>

    <div class="image col-12">
        <img src="css/img/reservation-img.jpeg" alt="" srcset="" class="img-img">
    </div>
    <section class="User-Details-section">
        <div class="col-1"></div>
        <div class="col-10 profile-row-1">
            <div class="user-details-header">
                <p>User Details</p>
            </div>
            <table class="user-table-details">
                <tr>
                    <td><b>Name</b></td>
                    <td><?php echo $userDetails['name']; ?></td>
                </tr>
                <tr>
                    <td><b>E-Mail:</b></td>
                    <td><?php echo $userDetails['email']; ?></td>
                </tr>
                <tr>
                    <td><b>Phone Number:</b></td>
                    <td><?php echo $userDetails['number']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-1"></div>
    </section>


    <section class="user-table-details-section">
        <div class="col-1"></div>
        <div class="col-10 profile-row-2">
            <p>Table Booking History</p>
            <table class="user-table-reservation-details">
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of People</th>
                </tr>
                <?php
                foreach ($bookingHistory as $booking) {
                    echo "<tr>";
                    echo "<td>" . $booking['resid'] . "</td>";
                    echo "<td>" . $booking['date'] . "</td>";
                    echo "<td>" . $booking['time'] . "</td>";
                    echo "<td>" . $booking['person'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="col-1"></div>
    </section>

    <section class="user-order-history-section">
        <div class="col-1"></div>
        <div class="col-10 profile-row-3">
            <p>Order History</p>
            <table class="user-order-history-details">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                </tr>
                <?php
                foreach ($orderHistory as $order) {
                    echo "<tr>";
                    echo "<td>" . $order['order_id'] . "</td>";
                    echo "<td>" . $order['order_date'] . "</td>";
                    echo "<td>" . $order['order_time'] . "</td>";
                    echo "<td>" . $order['amount'] . "</td>";
                    echo "<td>" . $order['payment_method'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="col-1"></div>
    </section>


    <!-- Footer Code -->
    <div class="footer-main-container">
        <div class="col-1"></div>
        <div class="container col-10">
            <div class="col-4">
                <h2 class="header">Dinehub</h2>
                <p class="header-line">"Your gateway to culinary excellence,<br> where taste meets technology."</p>
            </div>
            <div class="col-4">
                <h2>Open Hours</h2>
                <p class="timing">Monday 9:00 - 24:00 <br>
                   Tuesday 9:00 - 24:00 <br>
                   Wednesday 9:00 - 24:00 <br>
                   Thursday 9:00 - 24:00 <br>
                   Friday 9:00 - 02:00 <br>
                   Saturday 9:00 - 02:00 <br>
                   Sunday 9:00 - 02:00 
                </p>
            </div>
            <div class="col-4">
                <h2>Newsletter</h2>
                <p class="news-letter">Far far away, behind the word<br>mountains, far from the countries.</p>
                <form action="" method="post" class="input-field-footer">
                    <input type="email" name="email" id="email" placeholder="Enter Email"><br>
                    <button type="submit" class="footer-button">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
