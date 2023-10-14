<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--css/icons/boostrap/jquery/fonts/images start-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/CSS/usersidebar.css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/admindesign.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3472d45ca0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://kit.fontawesome.come/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!--css/icons/boostrap/jquery/fonts/images end-->

    <title>Admin Dashboard</title>
</head>

<body>
    <?php include("../partials/adminsidebar.php") ?>
    <div class="container">
        <h1 class="coaches-title">Coaches</h1>
        <table id="coaches-table" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-title="ID">1</td>
                    <td data-title="Name">Sandy Mohammed</td>
                    <td data-title="Class">Body Pump</td>
                </tr>
                <tr>
                    <td data-title="ID">2</td>
                    <td data-title="Name">Kenzy Khaled</td>
                    <td data-title="Class">Yoga</td>
                </tr>
                <tr>
                    <td data-title="ID">3</td>
                    <td data-title="Name">Carmen Ahmed</td>
                    <td data-title="Class">Aerobics</td>
                </tr>
                <tr>
                    <td data-title="ID">4</td>
                    <td data-title="Name">Ziad Sherif</td>
                    <td data-title="Class">Core</td>
                </tr>
                <tr>
                    <td data-title="ID">5</td>
                    <td data-title="Name">Saad Omar</td>
                    <td data-title="Class">Body Attack</td>
                </tr>
            </tbody>
        </table>
        <div class="modify-coaches">
            <button class="modify-coaches-btn" id="add-coach"> Add Coach</button>
            <button class="modify-coaches-btn" id="edit-coach"> Edit Coach</button>
            <button class="modify-coaches-btn" id="delete-coach"> Delete Coach</button>
        </div>
    </div>
    </div>
</body>