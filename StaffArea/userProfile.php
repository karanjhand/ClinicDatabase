<?php
    require('../config/config.php');
    require('../config/db.php');

        $today = date("Y-m-d");
        
        $userid = htmlentities($_POST['userid']);
        $query = "SELECT * FROM user WHERE userid='$userid'"; 
        $result = mysqli_query($conn, $query);

        // fetch data into an associative array
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $query2 = "SELECT medicine_info.name, sum(orders.quantity) FROM medicine_info, orders WHERE orders.medid=medicine_info.MedID AND userID='$userid' GROUP BY medicine_info.Name"; 
        $result2 = mysqli_query($conn, $query2);

        // fetch data into an associative array
        $ordersHistory = mysqli_fetch_all($result2, MYSQLI_ASSOC);

        $query3 = "SELECT appointmentDate, appointmentTime, appointmentDay, doctor.docName FROM appointments, doctor WHERE appointments.docid=doctor.docid  AND appointments.userID='$userid' AND appointments.appointmentDate<='$today' "; 
        $result3 = mysqli_query($conn, $query3);

        // fetch data into an associative array
        $appointmentsHistory = mysqli_fetch_all($result3, MYSQLI_ASSOC);

 ?>


<?php include('inc/staffHeader.php'); ?>
 <div class="div-table">
     <h1><?php echo $users[0]['userName']; ?></h1>
     <p><?php echo $users[0]['address']; ?></p>
    <h2>Appointments History</h2>
    <table>
        <tr>
            <th>Dctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Day</th>
        </tr>
        <?php foreach($appointmentsHistory as $appointment): ?> 
        <tr>
            <td><?php echo $appointment['docName'] ?></td>
            <td><?php echo $appointment['appointmentDate'] ?></td>
            <td><?php echo $appointment['appointmentTime'] ?></td>
            <td><?php echo $appointment['appointmentDay'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Medicines Bought</h2>
    <table>
        <tr>
            <th>Medicine Name</th>
            <th>Quantity Bought</th>
        </tr>
        <?php foreach($ordersHistory as $order): ?> 
        <tr>
            <td><?php echo $order['name'] ?></td>
            <td><?php echo $order['sum(orders.quantity)'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>