<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Memberships</title>

    <!--css/icons/boostrap/jquery/fonts/images start-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/CSS/adminsidebar.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/addclient.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../public/CSS/alert.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--css/icons/boostrap/jquery/fonts/images end-->

</head>

<body>
    <?php require("partials/adminsidebar.php");
    include_once "../Models/ClientModel.php";
    include_once "../Models/MembershipsModel.php";
    include_once "../Models/PackageModel.php";

    $Client = new Client();
    $Memberships = new Memberships();
    $memberships = $Memberships->getAllMemberships();
    ?>
    <script>
    var currentDate = new Date();
    var maxDate = new Date(currentDate);
    maxDate.setMonth(currentDate.getMonth() + 3);
    </script>
    <div id="add-body" class="addbody">
        <div class="container">
            <h2 class="table-title">Memberships:</h2>
            <input type="text" id="searchBar" onkeyup="myFunction()" placeholder="Search for names..">
            <div id="tablediv">
                <table id="membershipsTable" class="view-table overflow-auto mh-10">
                    <hr>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Package</th>
                            <th scope="col">Start Date </th>
                            <th scope="col">End Date</th>
                            <th scope="col">Visits </th>
                            <th scope="col">Invitations </th>
                            <th scope="col">Status </th>
                            <th scope="col">Freeze</th>
                            <th scope="col">PT Sessions</th>
                            <th scope="col">inbody</th>
                            <th scope="col">Actions </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($memberships) > 0) {
                            foreach ($memberships as $membership) {
                                $client = $Client->getClientByID($membership->getclientId());
                                if ($client) {
                                    echo "<tr id='row-" . $membership->getID() . "'>";
                                    echo "<td><a class='membershipBtn' style=' font-size:17px;' href='viewClientMembership.php?ID=" . $membership->getID() . "'>" . $membership->getID() . "</a></td>";
                                    echo '<td> ' . $client->getFirstName() . ' ' . $client->getLastName() . ' </td>';
                                    echo '<td> ' . $client->getPhoneNumber() . ' </td>';
                                    echo '<td>' . $membership->getpackageId() . '</td>';
                                    echo '<td>' . $membership->getstartDate() . '</td>';
                                    echo '<td class="endDate-' . $membership->getID() . '">' . $membership->getendDate() . '</td>';
                                    echo '<td>' . $membership->getvisitsCount() . '</td>';
                                    echo '<td>' . $membership->getinvitationsCount() . '</td>';
                                    if ($membership->getfreezed() == 0) {

                                        echo '<td class="status-' . $membership->getID() . ' bg">Active</td>';
                                        echo '<td><button id="freezeBtn-' . $membership->getID() . '" class="btn btn-freeze" onclick="showDatePickerModal(' . $membership->getID() . ')">Freeze</button></td>
                                '; ?>
                                                                        <div class="modal" id="datePickerModal-<?php echo $membership->getID() ?>">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <span class="close-btn" onclick="hideDatePickerModal(<?php echo $membership->getID() ?>)">&times;</span>
                                                                                    <div>
                                                                                        <label for="datepicker">Choose a Date:</label>
                                                                                        <input type="date" id='datepicker-<?php echo $membership->getID() ?>' min="<?= date('Y-m-d', strtotime('+3 day')); ?>" max="<?= date('Y-m-d', strtotime('+' . $membership->getFreezeCount() . 'day')); ?>">
                                                                                    </div>
                                                                                    <button class="btn btn-primary"
                                                                                        onclick='freezeMembership(<?php echo $membership->getID() ?>)'>Freeze</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                    } else {
                                        echo '<td class="status-' . $membership->getID() . ' bg">Freezed</td>';
                                        echo '<td><button id="unfreezeBtn-' . $membership->getID() . '" class="btn btn-unfreeze" onclick="unfreezeMembership(' . $membership->getID() . ')">Unfreeze</button></td>';

                                    }
                                    echo '<td>' . $membership->getprivateTrainingSessionsCount() . '</td>';
                                    echo '<td>' . $membership->getinbodyCount() . '</td>';
                                    echo "<td><button class=\"btn btn-delete\" onclick='showDeleteModal()'>Delete</button></td>"; ?>
                                                            <div class="modal" id="deleteModal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <span class="close-btn" onclick="hideDeleteModal()">&times;</span>
                                                                        <div>
                                                                        <label >Are you sure you want to cancel this membership?</label>
                                                                        </div>
                                                                        <button class="btn btn-delete"
                                                                            onclick='deleteMembership(<?php echo $membership->getID() ?>)' style="background-color:red">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php echo '</tr>';
                                }
                            }
                        } else {
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="alert hide"> 
                    <span class="fas fa-check-circle"></span>
                    <span class="msg"></span>
                    <div class="close-btn">
                        <span class="fas fa-times"></span>
                    </div>
             </div>
        </div>
    </div>

    <script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchBar");
        filter = input.value.toUpperCase();
        table = document.getElementById("membershipsTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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

    function freezeMembership(membershipID) {
        var selectedDate = $('#datepicker-'+membershipID).val();
        console.log(selectedDate);

        console.log('Selected Date:', selectedDate);

        $.ajax({
            type: "POST",
            url: "../Controllers/MembershipsController.php",
            data: {
                action: "freezeClientMembership",
                membershipID: membershipID,
                selectedDate: selectedDate,
            },
            success: function(responseData) {
                console.log(response);
                var response = JSON.parse(responseData);
                $('.endDate-' + membershipID).text(response.EndDate);

                $('.status-' + membershipID).text('Freezed');

                var unfreezeButton = '<button id="unfreezeBtn-' + membershipID +
                    '" class="btn btn-unfreeze" onclick="unfreezeMembership(' + membershipID +
                    ')">Unfreeze</button>';
                $('#freezeBtn-' + membershipID).replaceWith(unfreezeButton);
                showSuccessAlert("Frozen successfully");
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            },
        });

        hideDatePickerModal(membershipID);
    }

    function unfreezeMembership(membershipID) {
        console.log(membershipID);
        $.ajax({
            type: "POST",
            url: "../Controllers/MembershipsController.php",
            data: {
                action: "unfreezeClientMembership",
                membershipID: membershipID,
            },
            success: function(responseData) {
                var response = JSON.parse(responseData);
                $('.endDate-' + membershipID).text(response.EndDate);
                $('.status-' + membershipID).text('Active');

                var freezeButton = '<button id="freezeBtn-' + membershipID +
                    '" class="btn btn-freeze" onclick="showDatePickerModal()">Freeze</button>';
                $('#unfreezeBtn-' + membershipID).replaceWith(freezeButton);
                showSuccessAlert("Unfrozen successfully");
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            },
        });
    }

    function showDatePickerModal(membership) {
        $('#datePickerModal-'+membership).fadeIn();

    }
    function hideDatePickerModal(membership) {
        $('#datePickerModal-'+membership).fadeOut();
    }
    
    function showDeleteModal() {
        $('#deleteModal').fadeIn();

    }
    function hideDeleteModal() {
        $('#deleteModal').fadeOut();
    }

    function submitFreeze() {
        var selectedDate = $('#datepicker').val();

        console.log('Selected Date:', selectedDate);

        hideDatePickerModal();
    }

    function deleteMembership(membershipID) {
        $.ajax({
            type: "POST",
            url: "../Controllers/MembershipsController.php",
            data: {
                action: "deleteMembership",
                membershipID: membershipID,
            },
            success: function(response) {
                if (response === "success") {
                    var tableRow = document.getElementById('row-' + membershipID);
                    if (tableRow) {
                        tableRow.parentNode.removeChild(tableRow);
                        // showSuccessAlert("Deleted successfully", "#FF0000");
                    } else {
                        console.log("Error.");
                    }
                } else {
                    console.log("Error deleting client.");
                }
                
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
            },
        });
        showDeleteModal();
    }
    function showSuccessAlert(message, backgroundColor = "#4CAF50") {
            $('.alert').removeClass("hide");
            $('.alert').addClass("show");
            $('.alert').addClass("showAlert");
            $('.msg').text(message);
            $('.alert').css("background-color", backgroundColor);
            $('.alert .close-btn').css("background-color", backgroundColor);

            setTimeout(function() {
                $('.alert').removeClass("show");
                $('.alert').addClass("hide");
            }, 5000);
        }
    </script>
</body>

</html>