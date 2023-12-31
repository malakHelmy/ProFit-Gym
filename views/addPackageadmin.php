<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Package | Admin </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/CSS/adminsidebar.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/addPackage.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>


<body>
    <?php session_start(); ?>
    <script src="../public/js/addPackage.js"></script>
    <?php require("partials/adminsidebar.php") ?>

    <div id="add-body" class="addbody">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="coaches-title">Add Package: </h4>
                </div>
                <hr>
                <form method="post" class="row" autocomplete="off" action="../Controllers/PackageController.php"
                    onsubmit="return validateForm()">
                    <input type="hidden" name="action" value="addPackage">
                    <div class="col-lg-4 col-md-12">
                        <label for="name">Title : </label>
                    </div>
                    <input type="text" name="title" id="title">
                    <span
                        id="title-error"><?php echo isset($_SESSION["titleErr"]) ? $_SESSION["titleErr"] : ''; ?></span>
                    <div class="col-lg-4 col-md-12">
                        <label for="name">Number Of Months : </label>
                    </div>
                    <input type="Number" name="months" id="months">
                    <span
                        id="months-error"><?php echo isset($_SESSION["monthsErr"]) ? $_SESSION["monthsErr"] : ''; ?></span>
                    <div class="visits-container">
                        <div class="visits-title">Visits:</div>
                        <div class="radio-buttons">
                            <input type="radio" id="limited" name="visits" value="limited" class="radio-btn"
                                onclick="showLimitField()">
                            <label for="limited" id="limited">Limited</label>

                            <input type="radio" id="unlimited" name="visits" value="unlimited" class="radio-btn"
                                onclick="hideLimitField()">
                            <label for="unlimited" id="unlimited">Unlimited</label>
                        </div>
                        <span
                            id="isLimited-error"><?php echo isset($_SESSION["visitsErr"]) ? $_SESSION["visitsErr"] : ''; ?></span>

                        <div id="limitField" class="hidden">
                            <label for="limitDays">Limit (Days):</label>
                            <input type="number" id="limitDays" name="limitDays">
                        </div>
                        <span
                            id="limit-error"><?php echo isset($_SESSION["limitDaysErr"]) ? $_SESSION["limitDaysErr"] : ''; ?></span>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <label for="name">Freeze Limit (Days) : </label>
                    </div>
                    <input type="number" name="freezelimit" id="freezelimit">
                    <span
                        id="freezeLimit-error"><?php echo isset($_SESSION["freezeLimitErr"]) ? $_SESSION["freezeLimitErr"] : ''; ?></span>
                    <div class="col-lg-4 col-md-12">
                        <label for="phone">Number of Invitations : </label>
                    </div>
                    <input type="number" name="invitation" id="invitation">
                    <span
                        id="invitations-error"><?php echo isset($_SESSION["invitationErr"]) ? $_SESSION["invitationErr"] : ''; ?></span>
                    <div class="col-lg-4 col-md-12">
                        <label for="email">Number of Inbody : </label>
                    </div>
                    <input type="number" name="inbody" id="inbody">
                    <span
                        id="inbody-error"><?php echo isset($_SESSION["inbodyErr"]) ? $_SESSION["inbodyErr"] : ''; ?></span>
                    <div class="col-lg-4 col-md-12">
                        <label for="nationalid">Number of PT sessions : </label>
                    </div>
                    <input type="number" name="ptsession" id="ptsession">
                    <span
                        id="ptsession-error"><?php echo isset($_SESSION["ptSessionErr"]) ? $_SESSION["ptSessionErr"] : ''; ?></span>
                    <div class="col-lg-4 col-md-12">
                        <label for="nationalid">Price : </label>
                    </div>
                    <input type="number" name="price" id="price" style="margin-bottom:24px;">
                    <span
                        id="price-error"><?php echo isset($_SESSION["priceErr"]) ? $_SESSION["priceErr"] : ''; ?></span>
                    <span id="success"><?php echo isset($_SESSION["success"]) ? $_SESSION["success"] : ''; ?></span>
                    <div class="col-lg-9 col-md-12">
                        <input type="submit" value="Add Package" id="add-btn">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
                unset(
    $_SESSION["visitsErr"],
    $_SESSION["limitDaysErr"],
    $_SESSION["freezeLimitErr"],
    $_SESSION["titleErr"],
    $_SESSION["monthsErr"],
    $_SESSION["invitationErr"],
    $_SESSION["inbodyErr"],
    $_SESSION["ptSessionErr"],
    $_SESSION["priceErr"],
    $_SESSION["success"]
);
?>

</body>

</html>