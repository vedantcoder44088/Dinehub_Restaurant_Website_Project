<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/main_style.css">
    <link rel="stylesheet" href="css/navbar_style.css">
    <link rel="stylesheet" href="css/footer_style.css">
    <link rel="stylesheet" href="css/view_cart_style.css">

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
    
    <div class="row-main-checkout">
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

                    if ($conn) {
                        // echo "Connected";
                    } else {
                        echo "Not Connected";
                        exit; // Exit if the connection is not successful
                    }

                    $email = $_SESSION['email'];
                    $tablename = "cart_of_" . $email;

                    // Check if the user's cart table exists
                    $result = mysqli_query($conn, "SHOW TABLES LIKE '" . $tablename . "'");

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<h1 class='view-cart-page-header'>Shopping Cart</h1>";
                            echo "<table border='1'>";
                            echo "<tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                            </tr>";

                            $totalPrice = 0;

                            // Fetch cart items from the user's cart table
                            $sql = "SELECT id, name, price FROM `" . $tablename . "`"; 
                            $cartItemsResult = mysqli_query($conn, $sql);

                            if ($cartItemsResult) {
                                while ($row = mysqli_fetch_assoc($cartItemsResult)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td><a href='deletecartitem.php?id=" . $row['id'] . "'>Delete</a></td>";
                                    echo "</tr>";

                                    $totalPrice += $row['price'];
                                }

                                // Calculate GST (18%)
                                $gst = ($totalPrice * 0.18);

                                echo "</table>";
                                echo "<p class='first-p'>Total Price: $" . $totalPrice . "</p>";
                                echo "<p class='first-p'>GST (18%): $" . $gst . "</p>";
                                echo "<p class='first-p'>Grand Total: $" . ($totalPrice + $gst) . "</p>";

                                echo "<form action='checkout.php' method='post' class='payment-form'>
                                        <p >Total Amount:  ($totalPrice + $gst)  </p>
                                        <label for='payment_method'>Select Payment Method:</label>
                                        <select name='payment_method' id='payment_method'>
                                            <option value='cash'>Cash</option>
                                            <option value='qr_code'>QR Code</option>
                                        </select>
                                        <input type='submit' value='Submit Payment'>
                                    </form>";
                            } else {
                                echo "Error fetching cart items: " . mysqli_error($conn);
                            }
                        } else {
                            echo "
                        <script>
                            alert('Empty Cart......');
                            window.location.href = 'menu.php';
                        </script>";
                        }

                        // Free the result
                        mysqli_free_result($result);
                    } else {
                        echo "Error checking if the table exists: " . mysqli_error($conn);
                    }

                    // Close the main connection
                    mysqli_close($conn);
                } else {
                    header('location: index.php');
                }
            ?>

    </div>

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