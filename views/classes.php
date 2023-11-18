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
    <link rel="stylesheet" type="text/css" href="../public/CSS/classes.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!--css/icons/boostrap/jquery/fonts/images end-->

    <title>ProFit Gym</title>
</head>

<body>
    <!-- include header -->
    <?php include("partials/header.php") ?>
    <!-- add image -->
    <section id="welcome-image">
        <img src="../public/Images/bckgrnd2.jpg" alt="Home Image" class="main-img">
        <div class="img-text">
            <!-- title over image -->
            <h1 class="classes">Classes</h1>
        </div>
    </section>

    <div class="container py-5">
        <h2 style=" font-size: 22px;
    font-weight: bolder;
    text-transform: uppercase;
    color: rgb(176, 37, 37);
    letter-spacing: -1px;">Details:</h2>

        <div class="classinfo">
            Gyms today offer an array of fitness classes that extend well beyond traditional workout routines. These
            classes serve as dynamic platforms for individuals to not only improve their physical fitness but also
            relax, explore new experiences, and forge meaningful connections. From yoga and Pilates to high-intensity
            interval training (HIIT) and dance workouts, gym classes cater to diverse interests and skill levels.
        </div>
        <div class="classinfo">
            One of the most significant advantages of these classes is their potential to promote relaxation and stress
            relief. Yoga and meditation classes, for example, provide a sanctuary of tranquility amid the hustle and
            bustle of daily life. They offer an opportunity to unwind, focus on breathing, and achieve a sense of inner
            peace. Similarly, dance and group fitness classes infuse fun and energy into workouts, making them enjoyable
            experiences that can release endorphins and boost mood.
        </div>
        <div class="classinfo">
            In the social sphere, classes at the gym serve as natural meeting grounds for like-minded individuals.
            Participants often bond over shared goals and experiences, creating a sense of community and support. These
            connections not only foster accountability and motivation but also provide an opportunity to make new
            friends who share an interest in health and fitness.

        </div>
    </div>


    <div class="container py-5">
        <h2 style=" font-size: 22px;
    font-weight: bolder;
    text-transform: uppercase;
    color: rgb(176, 37, 37);
    letter-spacing: -1px;">Types:</h1>
            <div class="card-container">

                <div class="card">
                    <img src="../public/Images/yoga.jpg">
                    <h3>Yoga Class</h3>
                    <p>Yoga classes focus on improving flexibility, strength, and mental well-being 
                        through a combination of physical postures, breath control, and meditation.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/zumba2.jpg">
                    <h3>Zumba Class</h3>
                    <p>Zumba is a dance-based fitness class 
                        that incorporates Latin and international music. 
                        It combines energetic dance moves with cardiovascular exercises to create a fun and engaging workout.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/pilates.jpg">
                    <h3>Pilates Class</h3>
                    <p>Pilates focuses on core strength, flexibility, and overall body awareness. 
                        It involves precise movements and controlled breathing to improve posture and build long, lean muscles.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/aerobics1.jpg">
                    <h3>Aqua Aerobics Class</h3>
                    <p>Aqua aerobics takes traditional aerobic exercises into the pool. The water 
                        provides resistance, making it a low-impact yet effective workout that improves cardiovascular fitness and muscle strength.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/mind.jpg">
                    <h3>Mind-Body Fusion Class</h3>
                    <p>Classes like Barre combine elements of ballet, Pilates, and yoga.
                         They target small muscle groups through isometric movements, promoting strength, balance, and flexibility.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/cycling.jpg">
                    <h3>Indoor Cycling Class</h3>
                    <p>In these high-energy classes, participants pedal stationary bikes to the beat of music. 
                        It's an effective cardiovascular workout that also strengthens the legs and core.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/kettlebell.jpg">
                    <h3>Kettlebell Training Class</h3>
                    <p>In these high-energy classes, participants pedal stationary bikes to the beat of music. 
                        It's an effective cardiovascular workout that also strengthens the legs and coreKettlebell classes use kettlebells, 
                        which are weighted balls with handles, for dynamic strength training. They engage multiple muscle groups, improve coordination, and enhance power.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/circuit.jpg">
                    <h3>Circuit Training Class</h3>
                    <p>Circuit training involves moving through a series of different exercises at stations with minimal rest. 
                        It combines strength and cardiovascular training for an efficient and effective workout.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/parkour.jpg">
                    <h3>Parkour Class</h3>
                    <p> Parkour classes teach participants to navigate obstacles and urban environments with fluid movements. It improves agility, strength, and spatial awareness.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/aerial.jpg">
                    <h3>Aerial Yoga Class</h3>
                    <p> Aerial yoga combines traditional yoga poses with the use of silk hammocks suspended from the ceiling. 
                        It adds an element of suspension and flexibility, enhancing strength and balance.</p>
                </div>

                <div class="card">
                    <img src="../public/Images/strength1.jpg">
                    <h3>Strength and Conditioning Class</h3>
                    <p> Strength and conditioning classes focus on improving overall athletic performance. 
                        They incorporate a mix of weightlifting, plyometrics, and agility drills to enhance strength and power.</p>
                </div>

            </div>
    </div>

    <?php include("partials/footer.php") ?>

</body>

</html>