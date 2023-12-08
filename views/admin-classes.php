<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All classes| Profit </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/CSS/adminsidebar.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/addclient1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../public/js/classes.js?v=<?php echo time(); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<style>
    .admin-classes-css {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 27px;
        text-transform: uppercase;
        padding-top: 20px;
        color: rgb(36, 34, 34);
        padding-left: 40px;
        padding-bottom: 30px;
    }

    .hidden {
        display: none;
    }

    span[id$="-err"],
    #success {
        color: red;
        font-size: 16px;
    }
</style>

<body>
    <?php
    session_start();
    require("partials/adminsidebar.php");
    ?>

    <script src="../public/js/addClass.js"></script>
    <?php 
    include_once "../Models/ClassesModel.php";
    include_once "../Models/AssignedClassModel.php";
    include_once "../Models/ReservedClassModel.php";

    $assignedclass = new AssignedClass();
    $results = $assignedclass->getallCoachesandClasses();
    ?>
    <div id="add-body">
        <div class="container">
            <h2 class="table-title">Clients:</h2>
            <input type="text" id="searchBar" onkeyup="myFunction()" placeholder="Search for class names..">

            <table class="table" id="classesTable">
                <thead>
                    <tr>
                        <td class="col"> ID </td>
                        <td class="col"> Name </td>
                        <td class="col"> Coach </td>
                        <td class="col"> Coach's Phone Number</td>

                        <td>Days</td>
                        <td>Action </td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result) : ?>
                        <tr id="row_<?php echo $result['ClassID']; ?>">
                            <td> <?php echo $result['ClassID'] ?> </td>
                            <td> <?php echo $result['ClassName'] ?> </td>
                            <td> <?php echo $result['CoachName'] ?></td>
                            <td> <?php echo $result['PhoneNumber'] ?> </td>
                            <td> <?php echo $result['Date'] ?> </td>

                            <td><button id="add-btn" action="viewClients">View Clients</button>
                                <button id="add-btn" style="background-color:red; color:white;" data-classid="<?php echo $result['ClassID']; ?>" data-coachid="<?php echo $result['CoachID']; ?>" data-date="<?php echo $result['Date']; ?>" onclick='deleteClass(this)'>Delete</button>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>

            <h2 class="admin-classes-css">Add New Class: </h2>
            <form method="post" autocomplete="off" action="../Controllers/ClassController.php" onsubmit="return validateAddForm()" enctype="multipart/form-data">
                <input type="hidden" name="action" value="addClass">
                <div class="conatiner">
                    <div class="row">
                        <div class="col-4">
                            <label for="name">Name : </label>
                            <br>
                            <input type="text" name="name" id="name">
                        </div>
                        <br>
                        <br>
                        <span id="name-err"><?php echo isset($_SESSION["nameErr"]) ? $_SESSION["nameErr"] : ''; ?></span>
                        <br>
                        <div class="col-4">
                            <label for="descr">Description : </label>
                            <br>
                            <input type="text" name="descr" id="descr">
                        </div>
                        <br>
                        <br>
                        <span id="descr-err"><?php echo isset($_SESSION["descrErr"]) ? $_SESSION["descrErr"] : ''; ?></span>
                        <br>
                        <div class="col-4">
                            <label for="image">Image : </label>
                            <br>
                            <input type="file" name="image" id="image">
                        </div>
                        <br>
                        <br>
                        <span id="img-err"><?php echo isset($_SESSION["imageErr"]) ? $_SESSION["imageErr"] : ''; ?></span>
                        <br>
                        <label for="days">Select Day/s:</label>
                        <div class="col-m-8">
                            <?php
                            // Get tomorrow's date
                            $tomorrow = date('Y-m-d', strtotime('+1 day'));

                            // Loop through the next 7 days
                            for ($i = 0; $i < 7; $i++) {
                                // Generate the date for each day
                                $date = date('Y-m-d', strtotime("+$i day", strtotime($tomorrow)));

                                // Get the day name
                                $dayName = date('l', strtotime($date));

                                // Display the day name and date
                                echo '<div class="form-check form-switch">';
                                echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheck' . $i . '" name="days[]" value="' . $dayName . '">';
                                echo '<label class="form-check-label" for="flexSwitchCheck' . $i . '">' . $dayName . '</label>';
                                echo '</div>';
                                echo '<br>';
                            }
                            ?>
                            <br>

                        </div>
                        <br>
                        <br>
                        <span id="days-err"><?php echo isset($_SESSION["daysErr"]) ? $_SESSION["daysErr"] : ''; ?></span>
                        <span id="success"><?php echo isset($_SESSION["success"]) ? $_SESSION["success"] : ''; ?></span>
                    </div>
                    <div class="col-m-4">
                        <button id="add-btn">Add Class </button>
                    </div>
                    <br>
                </div>
            </form>
            <?php
            // Unset specific error messages
            unset(
                $_SESSION["nameErr"],
                $_SESSION["descrErr"],
                $_SESSION["imageErr"],
                $_SESSION["success"]
            );
            ?>

            <br>
            <hr>
            <h2 class="admin-classes-css">Assign Class to Coach: </h2>
            <form method="post" autocomplete="off" action="../Controllers/ClassController.php" onsubmit="return validateAssignForm()">
                <input type="hidden" name="action" value="assignCoachtoClass">
                <label for="coaches"> Select The Coach : </label>
                <select name="coaches" id="select-coaches">
                    <option value="">Select Coach </option>

                    <?php
                    include_once "../Models/CoachesModel.php";

                    $coach = new Coach();
                    $employeesData = $coach->GetAllCoaches();

                    foreach ($employeesData as $coach) {
                        echo "<option value='" . $coach["CoachID"] . "'>" . $coach["Name"] . " </option>";
                    }
                    ?>

                </select>


                <span id="coach-err"><?php echo isset($_SESSION["coachErr"]) ? $_SESSION["coachErr"] : ''; ?></span>
                <br>
                <hr>
                <h3 class="admin-classes-css">Selected Coach Classes : </h3>
                <div id="selectedCoachClasses">
                </div>
                <br>
                <h3 class="admin-classes-css">Class Details : </h3>
                <div class="conatiner">
                    <div class="row">
                        <div class="col-4">
                            <label for="classes"> Select The Class : </label>
                            <br>
                            <?php
                            include_once "../Models/ClassesModel.php";

                            $class = new Classes();
                            $classes = $class->GetAllClasses();

                            echo "<select name='classes' id='select-classes'>";
                            echo "<option value=''>Select Class:</option>";

                            foreach ($classes as $class) {
                                echo "<option value='" . $class["ID"] . "'>" . $class["Name"] . "</option>";
                            }

                            echo "</select>";
                            ?>
                        </div>

                        <br>
                        <br>
                        <span id="class-err"><?php echo isset($_SESSION["classErr"]) ? $_SESSION["classErr"] : ''; ?></span>
                        <br>
                        <div class="col-4">
                            <label for="from">From : </label>
                            <br>
                            <input type="time" name="from" id="from">
                        </div>
                        <br>
                        <span id="from-err"><?php echo isset($_SESSION["fromErr"]) ? $_SESSION["fromErr"] : ''; ?></span>
                        <br>
                        <div class="col-4">
                            <label for="to">To : </label>
                            <br>
                            <input type="time" name="to" id="to">
                        </div>
                        <br>
                        <span id="to-err"><?php echo isset($_SESSION["toErr"]) ? $_SESSION["toErr"] : ''; ?></span>
                        <br>
                        <br>
                    </div>
                    <div class="price-container">
                        <div class="free-title">Free:</div>
                        <div class="radio-buttons">
                            <input type="radio" id="free" name="price" value="Free" class="radio-btn" onclick="hidePriceField()">
                            <label for="limited" id="">Yes</label>

                            <input type="radio" id="" name="price" value="NotFree" class="radio-btn" onclick="showPriceField()">
                            <label for="unlimited" id="unlimited">No</label>
                        </div>
                        <span id="isFree-err"><?php echo isset($_SESSION["isFreeErr"]) ? $_SESSION["isFreeErr"] : ''; ?></span>
                        <br>
                        <div id="priceField" class="hidden">
                            <label for="class-price">Price:</label>
                            <br>
                            <input type="number" id="classPrice" name="class-price">
                        </div>
                        <span id="price-err"><?php echo isset($_SESSION["priceErr"]) ? $_SESSION["priceErr"] : ''; ?></span>
                        <br>
                        <div class="col-4">
                            <label for="attendants">Number of Attendants: </label>
                            <br>
                            <input type="number" name="attendants" id="attendants">
                        </div>
                        <br>
                        <span id="attendants-err"><?php echo isset($_SESSION["attendantsErr"]) ? $_SESSION["attendantsErr"] : ''; ?></span>
                    </div>
                    <br>
                    <span id="days-err"><?php echo isset($_SESSION["daysErr"]) ? $_SESSION["daysErr"] : ''; ?></span>
                    <span id="success"><?php echo isset($_SESSION["success"]) ? $_SESSION["success"] : ''; ?></span>
                    <div id="days-container">


                    </div>
                    <div class="col-m-4">
                        <button id="add-btn">Submit </button>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
    <?php
    // Unset specific error messages
    unset(
        $_SESSION["titleErr"],
        $_SESSION["fromErr"],
        $_SESSION["toErr"],
        $_SESSION["daysErr"],
        $_SESSION["coachErr"],
        $_SESSION["isFreeErr"],
        $_SESSION["priceErr"],
        $_SESSION["success"]
    );
    ?>
    <script>
        function showPriceField() {
            var priceField = document.getElementById("priceField");
            priceField.style.display = "block";

        }

        function hidePriceField() {
            var limitField = document.getElementById("priceField");
            priceField.style.display = "none";
        }



        $(document).ready(function() {
            // Attach change event to the select element
            $('#select-classes').change(function() {
                // Get the selected class ID
                var classId = $(this).val();

                // Check if a class is selected
                if (classId !== '') {
                    // Use AJAX to fetch days for the selected class
                    $.ajax({
                        url: 'getClassDays.php', // Update the path to your PHP script
                        type: 'POST',
                        data: {
                            classId: classId
                        },
                        success: function(response) {
                            // Update the days-container with the fetched days
                            $('#days-container').html(response);
                        }
                    });
                } else {
                    // If no class is selected, clear the days-container
                    $('#days-container').html('');
                }
            });
        });


        $(document).ready(function() {
            // Attach change event to the select element
            $('#select-coaches').change(function() {
                // Get the selected class ID
                var coachId = $(this).val();

                // Check if a class is selected
                if (coachId !== '') {
                    // Use AJAX to fetch days for the selected class
                    $.ajax({
                        url: 'getSelectedCoachClasses.php', // Update the path to your PHP script
                        type: 'POST',
                        data: {
                            coachId: coachId
                        },
                        success: function(response) {
                            // Update the days-container with the fetched days
                            $('#selectedCoachClasses').html(response);
                        }
                    });
                } else {
                    // If no class is selected, clear the days-container
                    $('#selectedCoachClasses').html('');
                }
            });
        });


        function deleteClass(button) {
            // Extract ClassID, CoachID, and Date from the data attributes
            var classID = button.getAttribute('data-classid');
            var coachID = button.getAttribute('data-coachid');
            var date = button.getAttribute('data-date');

            // Use JavaScript to remove the corresponding row
            var rowId = 'row_' + classID;
            var row = document.getElementById(rowId);
            if (row) {
                row.parentNode.removeChild(row);
            }

            // Use AJAX to send a request to your controller to delete the record from the backend
            $.ajax({
                url: '../Controllers/ClassController.php', // Update the path to your controller
                type: 'POST',
                data: {
                    action: 'deleteClass',
                    classID: classID,
                    coachID: coachID,
                    date: date
                },
                success: function(response) {
                    // Handle the response from the controller if needed
                    console.log(response);
                },
                error: function(error) {
                    // Handle errors if any
                    console.error(error);
                }
            });
        }


        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchBar");
            filter = input.value.toUpperCase();
            table = document.getElementById("classesTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                // td = tr[i].getElementsByTagName("td")[7]; search based on phone numbers
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>