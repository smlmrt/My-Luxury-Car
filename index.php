
<?php
require_once('submit_contact.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MY-CAR LUXURY-CARS</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" type="images/png" href="images/logo.png">

        <style>
            body {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            .container {
                width: 80%;
                margin: auto;
                overflow: hidden;
            }

            header {
                background: rgb(255, 0, 0);
                color: #ffffff;
                padding: 0px 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            header .container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }

            header .logo img {
                width: 100px;
                height: auto;
            }

            header nav {
                flex-grow: 1;
                display: flex;
                justify-content: center;
            }

            header nav ul {
                margin: 0;
                padding: 0;
                list-style: none;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            header nav ul li {
                margin-left: 80px;
            }

            header nav ul li a {
                color: #000000;
                text-decoration: none;
                font-weight: bold;
                font-family: 'Arial', sans-serif;
                color: #333;
                margin: 20px 0;
                text-align: center;
                transition: text-shadow 0.3s ease;
            }

            /*Header Geçiş Efekti*/
            .image-container {
                position: relative;
                width: 100%;
                height: 100%;
            }

            .image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .overlay-text {
                position: absolute;
                top: 4%;
                left: 30%;
                transform: translate(-50%, -50%);
                color: black;
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                background-color: rgba(0, 0, 0, 0); /* Yazı arkasında yarı saydam siyah arka plan */
                padding: 10px;
                border-radius: 5px;
            }

            /* Carousel bölümü */
            #carousel h2 {
                margin-left: 20px;
            }

            .carousel-images {
                display: flex;
                justify-content: space-between;
                overflow: hidden;
                padding: 10px 0;
            }

            .carousel-card {
                flex: 1;
                margin: 0 10px;
                background-color: #f8f8f8;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(255, 0, 0, 0.1);
                transition: transform 0.5s ease-in-out;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .carousel-card img {
                width: 100%;
                height: auto;
                border-radius: 10px 10px 0 0; 
            }

            .carousel-card p {
                margin: 10px 0; 
                font-size: 17px; 
                color: #333; 
            }

            .carousel-card .star-rating {
                color: #ff9800; /* Yıldızların rengi */
                margin: 5px 0 15px 0;
            }

            .carousel-card .star-rating .fa-star,
            .carousel-card .star-rating .fa-star-half-alt,
            .carousel-card .star-rating .fa-star,
            .carousel-card .star-rating .fa-star {
                margin-right: 2px;
            }

            .carousel-card:hover {
                transform: scale(1.05);
            }

            /* Hizmetlerimiz bölümü */
            #services h2 {
                text-align: left;
                margin-bottom: 20px;
            }

            .services-container {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .service-card {
                flex: 1;
                margin: 10px;
                padding: 20px;
                background-color: #f8f8f8;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(255, 0, 0, 0.1);
                transition: transform 0.5s ease-in-out;
                text-align: center;
            }

            .service-card img {
                width: 100%;
                height: auto;
                border-radius: 10px;
                margin-bottom: 15px;
            }

            .service-card h3 {
                margin-bottom: 15px;
            }

            .service-card p {
                color: #666;
            }

            .service-card:hover {
                transform: scale(1.05);
            }

            /* Hakkımızda bölümü */
            #about .container {
                margin: 0 auto;
                max-width: 100%;
            }

            .card {
                background-color: #f8f8f8;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 4px 8px rgba(255, 0, 0, 0.1);
            }

            .contact-container {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }

            .contact-info,
            .form-container {
                flex-basis: calc(50% - 20px);
            }

            .contact-info {
                margin-right: 20px;
            }

            .contact-info h2,
            .form-container h3 {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 10px;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                width: calc(100% - 22px);
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid lightcoral;
                border-radius: 5px;
                box-sizing: border-box;
            }

            input[type="submit"] {
                padding: 10px 20px;
                background-color: red;
                color: white;
                border: none;
                
                border-radius: 5px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }

            footer {
                background-color: #f8f8f8;
                padding: 20px 0;
            }

            .social-media {
                text-align: center;
                margin-top: 20px;
            }

            .social-media a {
                color: #555;
                margin-right: 10px;
            }

            .social-media a:hover {
                color: #007bff;
            }

            .carousel-images {
                display: flex;
                justify-content: space-between;
                overflow: hidden;
                padding: 10px 0;
            }

            .carousel-button {
                display: flex;
                justify-content: center;
                margin-top: 20px; /* Opsiyonel: Buton ile aralarındaki mesafeyi ayarlar */
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: red;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                border: 2px solid red;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .btn:hover {
                background-color: #45a049;
                color: white;
            }

            .services-container {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .services-button {
                display: flex;
                justify-content: center;
                margin-top: 20px; /* Opsiyonel: Buton ile aralarındaki mesafeyi ayarlar */
                margin-bottom: 20px;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: red;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                border: 2px solid red;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .btn:hover {
                background-color: #45a049;
                color: white;
            }


        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="logo">
                    <img src="images/logo.png" alt="MY-CAR LUXURY-CARS ">
                </div>
                <nav>
                    <ul>
                        <li><a href="#image-container">Ana Sayfa</a></li>
                        <li><a href="#carousel">Araçlarımız</a></li>
                        <li><a href="#services">Hizmetlerimiz</a></li>
                        <li><a href="#about">Hakkımızda</a></li>
                        <li><a href="#footer">İletişim</a></li>
                        <li><a href="login.html">Giriş</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="image-container">
            <img src="images/BMW.jpeg" alt="Sample Image">
            <div class="overlay-text">Hayalinizdeki araba MY-CAR LUXURY-CARS ile yanınızda</div>
        </div>

        <section id="carousel">
            <div class="container">
                <h2>LUXURY CARS</h2>
                <div class="carousel-images">
                    <div class="carousel-card">
                        <img src="images/Audi.jpeg" alt="Car 1">
                        <p>Audi A3 Sedan</p>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <div class="carousel-card">
                        <img src="images/mercedes-e220.jpg" alt="Car 2">
                        <p>Mercedes E220</p>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <div class="carousel-card">
                        <img src="images/Volvo.jpeg" alt="Car 3">
                        <p>Volvo XC90</p>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="carousel-button">
                    <a href="cars.html" target="_blank" class="btn">Tüm Araçları Gör</a>
                </div>
            </div>
        </section>
        

        <section id="services">
            <div class="container">
                <h2>Hizmetlerimiz</h2>
                <div class="services-container">
                    <div class="service-card">
                        <img src="images/kiraya_verme.jpg" alt="Kiralama">
                        <h3>Kiralama</h3>
                        <p>Araç kiralama hizmetlerimizle en kaliteli araçları uygun fiyatlarla kiralayabilirsiniz.</p>
                    </div>
                    <div class="service-card">
                        <img src="images/satın_alma.jpg" alt="Satın Alma">
                        <h3>Satın Alma</h3>
                        <p>Geniş araç yelpazemizden dilediğiniz aracı satın alabilirsiniz.</p>
                    </div>
                    <div class="service-card">
                        <img src="images/kiralatmak.jpg" alt="Kiraya Verme">
                        <h3>Kiraya Verme</h3>
                        <p>Araçlarınızı kiraya vererek ek gelir elde edebilirsiniz.</p>
                    </div>
                </div>
                <div class="services-button">
                    <a href="product.html" target="_blank" class="btn">Tüm Hizmetleri Gör</a>
                </div>
            </div>
        </section>        

        <section id="about">
            <div class="container">
                <div class="card">
                    <h2>Hakkımızda</h2>
                    <p>2019 yılından beridir sizlere sunduğumuz hizmetlerimiz hakkında sizlere bilgi vermek isteriz.</p>
                    <p>Seyahat etmek, keşfetmek ve hedeflerinize ulaşmak için ihtiyacınız olan araca sahip olmak, yaşamınızı kolaylaştırır. İşte tam burada biz devreye giriyoruz! MY-CAR LUXURY-CARS Araç Kiralama olarak, seyahat planlarınızı hayata geçirmenize yardımcı olacak profesyonel ve güvenilir araç kiralama hizmeti sunuyoruz.</p>
                    <p>Yolculuğunuzun başlangıcı, hayalinizdeki aracı bulmakla başlar. İşte tam burada biz devreye giriyoruz! MY-CAR LUXURY-CARS Araç Satın Alma olarak, ihtiyaçlarınıza uygun aracı bulmanıza ve satın almanıza yardımcı olacak profesyonel ve güvenilir bir hizmet sunuyoruz.</p>
                    <p> Artık aracınızı pasif bir varlık olarak değil, size gelir sağlayan bir yatırım olarak düşünün. İşte tam burada biz devreye giriyoruz! MY-CAR LUXURY-CARS Kirala platformu olarak, kendi aracınızı kiraya vermenizi kolaylaştıran güvenilir ve kullanıcı dostu bir hizmet sunuyoruz.</p>
                </div>
            </div>
        </section>
        
        
        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="form-container">
                    <form action="" method="post">
                        <h3>Geri bildirim</h3>
                        <?php 
                            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
                                if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
                                    echo "<p style='color:green;'>Mesajınız başarıyla gönderildi!</p>";
                                } else {
                                    echo "<p style='color:red;'>Lütfen tüm alanları doldurun!</p>";
                                }
                        } ?>
                        <label for="name">Adınız:</label>
                        <input type="text" id="name" name="name">
                        
                        <label for="email">E-posta:</label>
                        <input type="email" id="email" name="email">
                        
                        <label for="message">Mesaj:</label>
                        <textarea id="message" name="message"></textarea>
                        
                        <input type="submit" value="Gönder">
                    </form>
                </div>
            </div>
            <div class="container">
                <!-- Sosyal medya ve telif hakkı bilgisi -->
                <div class="social-media">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <p>&copy; MY-CAR LUXURY-CARS tüm hakları saklıdır.</p>
                </div>
            </div>
        </footer>
    </body>
</html>