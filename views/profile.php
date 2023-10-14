<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Profit </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/CSS/adminsidebar.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="../public/CSS/addclient.css?v=<?php echo time(); ?>">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php require("../partials/adminsidebar.php")?>
    <div id="add-body">
        <div class="container">
            <div class="row">
            <div class="col-lg-3 col-sm-1">
    <img src="../public/Images/bckgrnd.jpg" alt="" id="empimg">
</div>
<div class="col-5">
    <h3>Mohamed Fareed</h3>
    <br>
    <span class="text-info">Mohamed@gmail.com </span><span>- Administrator</span>
    <br>
    <br>
    <label for="photo">Change image </label>
    <input type="file" name="photo" id="imgfile">
</div>
            </div>

        </div>
<hr>
<h3>Account : </h3>
<form action="" class="row">
    <div class="col-lg-2 ">
<span>username : </span>
    </div>
    <div class="col-lg-10">
        <input type="text" name="" id="" value="Mohamed Fareed" class="un">
    </div>
    <br>
    <br>
    <hr>
    <div class="col-lg-2 ">
<span>Password : </span>
    </div>
    <div class="col-lg-10">
        <input type="password" name="" id="" value="Mohamed Fareed" class="un">
        <a href="">change ? </a>
    </div>
    <br>
    <br>
    <hr>
    <div class="col-lg-2 ">
<span>Email : </span>
    </div>
    <div class="col-lg-10">
        <input type="text" name="" id="" value="Mohamed@gmail.com" class="un">
        
    </div>
    <br>
    <br>
    <hr>
    <div class="col-lg-2 ">
<span>Job Title : </span>
    </div>
    <div class="col-lg-10">
        <input type="text" name="" id="" value="Administrator" class="un">
        
    </div>
    <br>
    <br>
    <hr>
    <div class="col-lg-2 ">
<span>Salary : </span>
    </div>
    <div class="col-lg-10">
        <input type="text" name="" id="" value="3000" class="un">
        
    </div>
    <br>
    <br>
    <hr>
    <div class="col-lg-2 ">
<span>Attendance for current month : </span>
    </div>
    <div class="col-lg-10">
        <input type="text" name="" id="" value="10 Days" class="un">
        
    </div>
</form>
    </div>
</body>
</html>