<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--css/icons/boostrap/jquery/fonts/images start-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/CSS/header.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/footer.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/contactus.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!--css/icons/boostrap/jquery/fonts/images end-->

    <title>ProFit Gym</title>
</head>

<body>

    <!-- include header -->
    <?php include("../partials/header.php") ?>
    <div class="contact-container">
        <div class="contact-form1">
            <div class="contact-info">
                <h3 class="contact-title">Let's get in touch</h3>
                <p class="contact-text">
                    Reach Out to Us for Support or Information
                </p>

                <div class="contact-info">
                    <div class="contact-information">
                        <img src="../public/Images/location.png" class="contact-icon" alt="" />
                        <p>Mansoura, Egypt</p>
                    </div>
                    <div class="contact-information">
                        <img src="../public/Images/email.png" class="contact-icon" alt="" />
                        <p>profitgym@gmail.com</p>
                    </div>
                    <div class="contact-information">
                        <img src="../public/Images/phone.png" class="contact-icon" alt="" />
                        <p>011--------</p>
                    </div>
                </div>

                <div class="contact-social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form action="../views/index.php" autocomplete="off">
                    <h3 class="contact-title">Contact us</h3>
                    <div class="contact-input-container">
                        <input type="text" name="name" class="contact-input" />
                        <label for="" class="contact-lbl">Username</label>
                        <span>Username</span>
                    </div>
                    <div class="contact-input-container">
                        <input type="email" name="email" class="contact-input" />
                        <label class="contact-lbl" for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="contact-input-container">
                        <input type="tel" name="phone" class="contact-input" />
                        <label class="contact-lbl" for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="contact-input-container textarea">
                        <textarea name="message" class="contact-input"></textarea>
                        <label class="contact-lbl" for="">Message</label>
                        <span>Message</span>
                    </div>
                    <input type="submit" value="Send" class="contact-btn" />
                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/contactus.js"></script>

    <!-- include footer -->
    <?php include("../partials/footer.php") ?>
</body>

</html>