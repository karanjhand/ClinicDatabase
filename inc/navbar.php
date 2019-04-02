<?php $currentPage = $_SERVER['REQUEST_URI']; ?>

<ul>
    <li><a class="<?php if ($currentPage == "/files/clinicdatabase/index.php")echo "active"; ?>" href="index.php">Home</a></li>
    <li><a class="<?php if ($currentPage == "/files/clinicdatabase/staff.php"|| $currentPage == "/files/clinicdatabase/appointment.php")echo "active"; ?>" href="staff.php">Staff</a></li>
    <li><a class="<?php if ($currentPage == "/files/clinicdatabase/pharmacy.php") echo "active"; ?>" href="pharmacy.php">Pharmacy</a></li>
    <li><a class="<?php if ($currentPage == "/files/clinicdatabase/account.php")echo "active"; ?>" href="account.php">Your Account</a></li>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
        <li style="float:right"><a href="logout.php">Log Out</a></li>
    <?php } else { ?>
    <li style="float:right"><a href="register.php">Register</a></li>
    <li style="float:right"><a href="login.php">Log In</a></li>
    <?php } ?>
</ul>   