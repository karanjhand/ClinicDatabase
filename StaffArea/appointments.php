<?php 
    require('../config/config.php');
    require('../config/db.php');

    $docID = (int)($_POST['docid']);

    if(isset($_POST['cancel'])){
        $appdate = htmlentities($_POST['app-Date']);
        $apptime = htmlentities($_POST['app-Time']);
        $query3 = "DELETE FROM appointments WHERE appointmentDate='$appdate' AND appointmentTime='$apptime' AND docid='$docID' ";
        $query4 = "UPDATE `docavailability` SET `Booked` = '0' WHERE `docavailability`.`Docdate` = '$appdate' AND `docavailability`.`Doctime` = '$apptime' AND `docavailability`.`DocID` = '$docID' ";
        if (mysqli_query($conn, $query3)){
            echo "Appointment Canceled ";
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
        if (mysqli_query($conn, $query4)){
            echo "Also Booking Updated";
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }

    $today = date("Y-m-d");
    $query = "SELECT * FROM appointments WHERE docid='$docID' AND  appointmentDate>='$today'"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $allAppointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $query2 = "SELECT docName FROM doctor WHERE docid='$docID'"; 
    $result2 = mysqli_query($conn, $query2);

    // fetch data into an associative array
    $docNameArray = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $docName = $docNameArray[0]['docName'];
?>

<?php include('inc/staffHeader.php'); ?>
<h1><?php echo $docName ; ?></h1>

<div class="div-table">
    <table>
        <tr>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Day</th>
            <th>Room Number</th>
            <th>Cancel</th>
        </tr>
        <?php foreach($allAppointments as $appointment): ?> 
        <tr>
            <?php 
                $userID = $appointment['userid'];
                $query3 = "SELECT userName FROM user WHERE userid='$userID'"; 
                $result3 = mysqli_query($conn, $query3);
            
                // fetch data into an associative array
                $userNameArray = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                $userName = $userNameArray[0]['userName']; 
            ?>
                <form action="userProfile.php" method="POST">
                    <input type="hidden" name="userid" value="<?php echo $userID ?>">
                    <td><input type="submit" name="go-to-profile" value="<?php echo $userName ?>"></td>
                </form>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                
                <input type="hidden" name="app-Date" value="<?php echo $appointment['appointmentDate']; ?>" >
                <input type="hidden" name="app-Time" value="<?php echo $appointment['appointmentTime']; ?>" >
                <input type="hidden" name="docid" value="<?php echo $docID; ?>" >
                
                <td><?php echo $appointment['appointmentDate']; ?></td>
                <td><?php echo $appointment['appointmentTime']; ?></td>
                <td><?php echo $appointment['appointmentDay']; ?></td>
                <td><?php echo $appointment['room']; ?></td>
                <td><input type="submit" name="cancel" value="Cancel"></td>
            </form>
        </tr>
        <?php endforeach; ?>        
    </table>
</div>


</body>
</html>
