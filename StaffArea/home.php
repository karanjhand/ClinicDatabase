<?php 
    session_start(); //Start the session
    if (isset($_SESSION['isDoctor']) && $_SESSION['isDoctor'] == true){
    }
    else{
        header('Location: ../docLogin.php');        
    }

?>



<?php include('inc/staffHeader.php'); ?>   
<div class="staffhome">
<h1>Site administration</h1>

<h2>ACCOUNTS INFO</h2>
<a href="user-info.php">Users</a>

<h2>Pharmacy</h2>
<a href="medicines.php">Medicines</a>

<h2>Doctors</h2>
<a href="doc-info.php">Appointments and Schedules</a>
</div>
</body>
</html>