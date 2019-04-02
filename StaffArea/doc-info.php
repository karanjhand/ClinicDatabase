<?php
    require('../config/config.php');
    require('../config/db.php');

    $query = "SELECT * FROM doctor ORDER BY docName"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include('inc/staffHeader.php'); ?>
<a href="home.php">Back</a>
<div class="div-table">
    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Info</th>
            <th>Manage Schedule</th>
            <th>View Appointments</th>
        </tr>
        <?php foreach($doctors as $doctor): ?> 
        <tr>
            <form action="doc-schedule.php" method="POST">
                <input type="hidden" name="docid" value="<?php echo $doctor['docid']; ?>">
                <td><?php echo $doctor['docName'] ?></td>
                <td><?php echo $doctor['docType'] ?></td>
                <td><?php echo $doctor['docInfo'] ?></td>
                <td><input type="submit" name="manage-schedule" value="Manage Schedule"></td>
            </form>
            <form action="appointments.php" method="POST">            
                <input type="hidden" name="docid" value="<?php echo $doctor['docid']; ?>">
                <td><input type="submit" name="doc-appointments" value="Appointments"></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
