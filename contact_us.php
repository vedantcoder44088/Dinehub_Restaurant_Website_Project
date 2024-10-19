<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactus_style.css">
    <link rel="stylesheet" href="css/main_style.css">
    <link rel="stylesheet" href="css/navbar_style.css">
    <link rel="stylesheet" href="css/footer_style.css">
    <title>Table Reservation</title>

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
            session_start();
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


    <div class="container-main-2 col-12">
        <div class="main-header col-12">
            <h1 class="header">Dinehub.</h1>
            <h1 class="subheader">Contact Us</h1>
        </div>
        <div class="table col-12">

            <div class="details col-6">
                <h1>Contact Information</h1>
                <p><b>Address:</b> 198 West 21th Street, 
                <br>
                Suite 721 New York NY 10016
                <br><br>
                <b>Phone:</b> + 1235 2355 98
                <br><br>
                <b>Email:</b> info@yoursite.com
                <br><br>
                <b>Website:</b> yoursite.com
                </p>

            </div>

            <div class="form-div col-6">
                <form action="" method="post" class="contactus-form" >
                    <div class="row-1">
                        <div class="input-field col-6">
                            <label for="Name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name">
                        </div>
        
                        <div class="input-field col-6">
                            <label for="Email">Email</label>
                            <input type="Email" name="email" id="email" placeholder="Enter Email">
                        </div>
                    </div>
                    
                    <div class="row-2">
                        <div class="input-field col-12">
                            <label for="Number">Number</label>
                            <input type="Number" placeholder="Number" name="Number">
                        </div>
                    </div>
    
                    <div class="row-3">
                        <div class="input-field col-12">
                            <label for="Message">Message</label>
                            <textarea name="massage" id="massage" cols="30" rows="10"></textarea>
                        </div>
                    </div>
    
                    <div class="Submit">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
            

            


        </div>

    </div>

    <div class="container-main-1 col-12">
        <div class="google-map col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117331.5493940661!2d72.56314588791001!3d23.22084599431933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395c2b987c6d6809%3A0xf86f06a7873e0391!2sGandhinagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1696867394741!5m2!1sen!2sin" width="600" height="450" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>









    <!-- footer -->
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