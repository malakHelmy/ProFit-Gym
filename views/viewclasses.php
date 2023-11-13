<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--css/icons/boostrap/jquery/fonts/images start-->
    <link rel="stylesheet" type="text/css" href="../public/CSS/footer.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/usersidebar.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/userprofile.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://kit.fontawesome.com/3472d45ca0.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.come/a076d05399.js"></script>
    <!--css/icons/boostrap/jquery/fonts/images end-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>



</head>

<body>
    <!-- usersidebar start -->
    <?php include("partials/usersidebar.php") ?>


    <div class="profile">

        <div class="greeting">
            <p class="hello-classes"><i class="fas fa-calendar"></i> Your Upcoming Classes</p>
        </div>

        <div class="reminders">
            <div class="reminder">
                <p class="class">Class:</p>
                <div class="class-title">YOGA</div>
                <div class="dates">
                    <div class="date">
                        <p>Date:</p>
                        <div class="class-date">21-10-2023</div>
                    </div>
                    <div class="time">
                        <p>Time:</p>
                        <div class="class-time">4:30 - 6:00 p.m</div>
                    </div>

                    <div class="day">
                        <p>Day:</p>
                        <div class="class-day">Sunday</div>
                    </div>
                </div>

                <div class="rem-info">
                    <p>Level:</p>
                    <p class="actual-rem"> Moderate</p>

                    <p>Instructor:</p>
                    <p class="actual-rem"> Sara Maged</p>

                    <p>Class Fees:</p>
                    <p class="actual-rem"> 200 L.E.</p>
                </div>
            </div>


            <div class="reminder">
                <p class="class">Class:</p>
                <div class="class-title">BODY-ATTACK</div>
                <div class="dates">
                    <div class="date">
                        <p>Date:</p>
                        <div class="class-date"> 28-10-2023</div>
                    </div>
                    <div class="time">
                        <p>Time:</p>
                        <div class="class-time">6:30 - 8:00 p.m</div>
                    </div>

                    <div class="day">
                        <p>Day:</p>
                        <div class="class-day">Monday</div>
                    </div>
                </div>

                <div class="rem-info">
                    <p>Level:</p>
                    <p class="actual-rem"> Hard</p>

                    <p>Instructor:</p>
                    <p class="actual-rem"> Kareem Ahmed</p>

                    <p>Class Fees:</p>
                    <p class="actual-rem"> 200 L.E.</p>
                </div>
            </div>

            <div class="reminder">
                <p class="class">Class:</p>
                <div class="class-title">AEROBICS</div>
                <div class="dates">
                    <div class="date">
                        <p>Date:</p>
                        <div class="class-date">31-10-2023</div>
                    </div>
                    <div class="time">
                        <p>Time:</p>
                        <div class="class-time">5:30 - 7:00 p.m</div>
                    </div>

                    <div class="day">
                        <p>Day:</p>
                        <div class="class-day">Tuesday</div>
                    </div>
                </div>

                <div class="rem-info">
                    <p>Level:</p>
                    <p class="actual-rem"> Easy</p>

                    <p>Instructor:</p>
                    <p class="actual-rem"> Anna Hall</p>

                    <p>Class Fees:</p>
                    <p class="actual-rem"> 0 L.E.</p>
                </div>
            </div>
        </div>
    </div>



    <script src="../public/js/slider.js"></script>


</body>
<?php include("partials/footer.php") ?>


<script src="../public/js/index.js"></script>



</html>