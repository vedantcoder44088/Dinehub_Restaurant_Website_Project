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
    <link rel="stylesheet" href="css/menu_page_style.css">

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


    <section class="menu">
        <div class="menu-title">
            <p class="menu-page-header">Our Menu</p>
        </div>

        <div class="row-main">
            <div class="col-1"></div>

            <div class="col-10">
                <div class="row">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'r_system');

                    if ($conn) {
                        $stmt = mysqli_prepare($conn, "SELECT id, name, description, price, image_url FROM menu_items");
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $menu_id, $name, $description, $price, $image_url);

                        echo '<table>';

                        while (mysqli_stmt_fetch($stmt)) {
                            echo '<tr>';
                            echo '<td>';
                            echo '<h3>' . $name . '</h3>';
                            echo '</td>';

                            echo '<td>';
                            echo '<img src="' . $image_url . '" alt="' . $name . '">';
                            echo '</td>';

                            echo '<td>';
                            echo '<p>' . $description . '</p>';
                            echo '</td>';

                            echo '<td>';
                            echo '<p>$' . $price . '</p>';
                            echo '</td>';

                            echo '<td>';
                            echo '<form method="POST" action="addtocarthandler.php">';
                            echo '<input type="hidden" name="menu_id" value="' . $menu_id . '">';
                            echo '<button type="submit">Buy</button>';
                            echo '</form>';
                            echo '</td>';

                            echo '</tr>';
                        }
                        echo '</table>'; 

                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                    } else {
                        echo "Not Connected";
                    }
                    ?>
                </div>
            </div>

            <div class="col-1"></div>
        </div>
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
