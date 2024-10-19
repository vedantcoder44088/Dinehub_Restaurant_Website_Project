<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinehub.</title>
    <link rel="stylesheet" href="css/main_style.css">
    <link rel="stylesheet" href="css/navbar_style.css">
    <link rel="stylesheet" href="css/footer_style.css">
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/menu_section_style.css">

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

    <!-- On-Caruosel Section Dishes -->
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="col-3">
                <div class="cir-icon">
                    <img src="css/img/pasta.png">
                </div>
                <b><p>Italian Cuisine <br>"Indulge in the Authentic Flavors of Italy"</b></p>
            </div>
            <div class="col-3">
                <div class="cir-icon">
                    <img src="css/img/indian.png">
                </div>
                <b><p>Indian Cuisine <br> "Experience the Richness of Indian Spices" </b></p>
            </div>
            <div class="col-3">
                <div class="cir-icon">
                    <img src="css/img/chinese.png">
                </div>
                <b><p>Chinese Cuisine <br>  "Discover the Wonders of Chinese Wok Cooking"</b></p>
            </div>
            <div class="col-3">
                <div class="cir-icon">
                    <img src="css/img/turkish.png">
                </div>
                <b><p>Turkish Cuisine <br> "Savor the Richness of Turkish Kebabs" </b></p>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

    <!-- On-Carousel Section -->
    <section class="on-carousel col-12">
        <h1>Dinehub.</h1>
        <p>Delicious Specialities</p>

    </section>
    <!-- Main-Slider -->
    <section id="carousel col-12">
        <div>
            <div class="carousel-head">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="css/img/c_img01.jpeg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="css/img/c_img02.jpeg" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="css/img/c_img03.jpg" alt="">
                    </div>
                </div>
                <div class="carousel-btn carousel-btn-left" onclick="prevSlide()">&#10094;</div>
                <div class="carousel-btn carousel-btn-right" onclick="nextSlide()">&#10095;</div>
            </div>
        </div>
    </section>

    
    <!-- About Section -->

    <section class="about">
        <div class="main-container-about">
            <div class="col-1"></div>
            <div class="col-10 content-about">
                <div class="col-6 about-image">
                    <div class="image-1 col-6">
                        <img src="css/img/about_01.jpg" alt="">
                    </div>
                    <div class="image-2 col-6">
                        <img src="css/img/about_02.jpg" alt="">
                    </div>
                </div>
                <div class="col-6 about-details">
                    <h2>About</h2>
                    <h3>Dinehub Restaurant</h3>
                    <p>DineHub Restaurant: Where passion meets palate. Discover an unforgettable culinary adventure with our locally sourced ingredients, expertly crafted dishes, and exceptional hospitality. Join us for a taste journey like no other.<br><br><br>Monday - Friday <b>8AM - 11PM</b></p>
                        
                    <br> <p class="about-number">+91 9512951842</p>
                </div>
            </div>
            <div class="col-1"></div>
        </div>

    </section>


    <!-- Service Section -->
    <section class="main-container-service">
        <div class="col-1"></div>
        <div class="col-10 content-service">
            <div class="header-service col-12">
                <h2>Services</h2>
                <h3>Catering Services</h3>
            </div>
            <div class="details-service col-12">
                <div class="col-4">
                    <h4>Birthday Party</h4>
                    <p>"Celebrate in style at DineHub, where every birthday becomes an unforgettable culinary experience."</p>
                </div>
                <div class="col-4">
                    <h4>Business Meeting</h4>
                    <p>"Elevate your corporate gatherings with cutting-edge cuisine and a tech-savvy atmosphere at DineHub."</p>
                </div>
                <div class="col-4">
                    <h4>Wedding Party</h4>
                    <p>"Make your dream wedding a reality at DineHub, where modern elegance meets exceptional cuisine for an unforgettable celebration."</p>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </section>

    <!-- Menu Section -->
    <section class="menu">
            <div class="menu-title">
                <h2 class="menu-header">Specialities</h2>
                <p class="menu-header-line">Our Menu</p>
            </div>

           <div class="row-main">
            <div class="col-1"></div>
            
            <div class="col-10">
                <div class="row-menu1">
                    <div class="col-6">
                        <img src="css/img/menu/dosa.png" alt="image-01">
                        <p>A crispy, paper-thin rice crepe stuffed with a spiced potato filling, served with coconut chutney and sambar.</p>
                    </div>
                    <div class="col-6">
                        <img src="css/img/menu/vegetable-corma.png" alt="image-02">
                        <p>Mixed vegetables cooked in a creamy, mildly spiced coconut and cashew nut gravy.</p>
                    </div>
                </div>
                <div class="row-menu2">
                    <div class="col-6">
                        <img src="css/img/menu/paneer-tikka.png" alt="image-03">
                        <p>Chunks of paneer marinated in a spiced yogurt mixture and grilled to perfection, served with mint chutney.</p>
                    </div>
                    <div class="col-6">
                        <img src="css/img/menu/aloojerra.png" alt="image-04">
                        <p>Sautéed potatoes with cumin seeds and aromatic spices, a simple and comforting dish.</p>
                    </div>
                </div>
                <div class="row-menu3">
                    <div class="col-6">
                        <img src="css/img/menu/Screenshot 2023-10-16 at 11.46.15.png" alt="image-05">
                        <p>Deep-fried vegetable and paneer (cottage cheese) balls served in a creamy tomato-based gravy.</p>
                    </div>
                    <div class="col-6">
                        <img src="css/img/menu/Screenshot 2023-10-16 at 11.47.58.png" alt="image-06">
                        <p>A classic combination of potatoes and cauliflower cooked with spices and herbs.</p>
                    </div>
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



    <!-- JAVAScript -->
    <script>
        // Carousel JS
        let currentIndex = 0;
        const carouselItems = document.querySelectorAll('.carousel-item');

        function showSlide(index) {
        currentIndex = index % carouselItems.length;
        const offset = -currentIndex * 100;
        document.querySelector('.carousel-inner').style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
        showSlide(currentIndex + 1);
        }

        function prevSlide() {
        showSlide(currentIndex - 1 + carouselItems.length);
        }

        setInterval(nextSlide, 5000);
        
    </script>
    <script src="js/main.js"></script>
</body>
</html>