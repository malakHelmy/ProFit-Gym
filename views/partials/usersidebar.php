<style>
    ::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: rgb(224, 224, 224);
}

::-webkit-scrollbar-thumb {
  background-color: rgb(31, 31, 31);
}

</style>
<?php
require_once 'sessionusercheck.php';
?>

<div class="sidebar close">
        <div class="logo-details">
        <i class='bx bx-user-circle'></i>
        <span class="logo-name">Welcome Back</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../views/userprofile.php">
                <i class='bx bxs-grid-alt'></i>
                <span class="link-name">Profile</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a  class="link-name" href="../views/userprofile.php">Profile</a></li>
                </ul>
            </li>
            </li>
            <li>
                <div class="icon-link">
                   <a href="#">
                   <i class='bx bxs-book-add'></i>
                   <span class="link-name">Booking</span>
                   </a>
                   <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a  class="link-name" href="#">Booking</a></li>
                    <li><a href="../views/packagebooking.php">Package</a></li>
                    <li><a href="../views/classbooking.php">Class</a></li>
                    <li><a href="../views/personaltrainerbooking.php">Personal Trainer</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                <a href="#">
                <i class='bx bxs-message-alt-detail'></i>
                <span class="link-name">Details</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a  class="link-name" href="#">Details</a></li>
                    <li><a href="../views/viewpackage.php">Package</a></li>
                    <li><a href="../views/viewclasses.php">Class</a></li>
                    <li><a href="../views/viewpt.php">Personal Training</a></li>
                </ul>
            </li>
            <!-- <li>
                <div class="icon-link">
                <a href="#">
                <i class='bx bxs-leaf'></i>
                <span class="link-name">Diet Plan</span>
                </a>
                <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a  class="link-name" href="#">Diet Plan</a></li>
                    <li><a href="../views/viewdietplan.php">View</a></li>
                    <li><a href="../views/bookdietplan.php">Book</a></li>
                </ul>
            </li> -->
            <li>
                <div class="icon-link">
                <a href="../views/reqfreeze.php">
                <i class='bx bxs-lock-alt'></i>
                <span class="link-name">Freeze</span>
                </a>
                </div>
                <ul class="sub-menu blank">
                    <li><a  class="link-name" href="../views/reqfreeze.php">Freeze</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                <a href="../views/userprofsettings.php">
                <i class='bx bxs-cog'></i>
                <span class="link-name">Account</span>
                </a>
                </div>
                <ul class="sub-menu blank">
                    <li><a  class="link-name" href="../views/userprofsettings.php">Account Settings</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                <a href="../views/index.php">
                <i class='bx bx-log-out'></i>
                <span class="link-name">Logout</span>
                </a>
                </div>
                <ul class="sub-menu blank">
                    <li><a  class="link-name" href="../views/logout.php">Logout</a></li>
                </ul>
            </li>
            <li>
            <div class="icon-link">
                <a href="../views/index.php">
                    <i class='bx bx-home'></i>
                    <span class="link-name">Return to Homepage</span>
                </a>
            </div>
            <ul class="sub-menu blank">
                <li><a class="link-name" href="../views/index.php">Return to Homepage</a></li>
            </ul>
        </li>

        </ul> 
        
</div>
        <section class="home-section">
                    <div class="home-content">
                      <i class='bx bx-menu'></i>
                    </div>
         </section>



       <script>
        let arrow = document.querySelectorAll(".arrow");
arrow.forEach((arrowElement) => {
    arrowElement.addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
        console.log(arrowParent);
    });
});

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

        
        </script>