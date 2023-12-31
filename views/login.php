<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--css/icons/boostrap/jquery/fonts/images start-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/CSS/header.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/footer.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/loginform.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!--css/icons/boostrap/jquery/fonts/images end-->

    <title>ProFit Gym</title>



</head>

<?php session_start(); ?>
<body>
    <!-- include header -->
    <?php include("partials/header.php") ?>
    <div class="login-container">
        <div class="login-form1">
            <form autocomplete="off" method="post" id="login-form" action="../Controllers/ClientController.php">
            <input type="hidden" name="action" value="login">
                <h3 class="login-title">Log In</h3>
                <div class="login-input-container">
                    <input type="email" name="email" id="email" class="login-input" required />
                    <label class="login-lbl" for="">Email</label>
                    <span>Email</span>
                </div>
                <span id="email-error"><?php echo isset( $_SESSION["emailErr"] ) ?  $_SESSION["emailErr"]  : ''; ?></span>
                <div class="login-input-container">
                    <input type="password" name="password" id="password" class="login-input" required />
                    <label class="login-lbl" for="">Password</label>
                    <span>Password</span>
                </div>
                <span id="password-error"><?php echo isset($_SESSION["passwordErr"]) ? $_SESSION["passwordErr"] : ''; ?></span>
                <span id="all-error"><?php echo isset($_SESSION["allErr"]) ? $_SESSION["allErr"] : ''; ?></span>
                <input type="submit" value="Login" class="login-btn" />
                <p class="register-text">Don't Have an Account? <a class="register-link"
                        href="../views/register.php">Register Now</a></p>
            </form>

            <?php
            unset($_SESSION["emailErr"]);
            unset($_SESSION["passwordErr"]);
            unset($_SESSION["allErr"]);
            ?>
        </div>

    </div>

    <script src="../public/js/login_validation.js"></script>

    <!-- include footer -->
    <?php include("partials/footer.php") ?>


<script>
const inputs = document.querySelectorAll(".login-input");

function focusFunc() {
    let parent = this.parentNode;
    parent.classList.add("focus");
}

function blurFunc() {
    let parent = this.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", focusFunc);
    input.addEventListener("blur", blurFunc);
});
</script>

</body>
</html>