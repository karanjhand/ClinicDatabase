<?php
    require('../config/config.php');
    require('../config/db.php');

    $docID = (int)($_POST['docid']);

    $query2 = "SELECT docName FROM doctor WHERE docid='$docID'"; 
    $result2 = mysqli_query($conn, $query2);

    // fetch data into an associative array
    $docNameArray = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $docName = $docNameArray[0]['docName'];

    $today = date("Y-m-d");
    $query3 = "DELETE FROM docavailability WHERE DocDate<'$today' ";
    if (mysqli_query($conn, $query3)){
        echo "Items deleted";
    }
    else{
        echo "ERROR: " . mysqli_error($conn);
    }

    if(isset($_POST['deleteSchedule'])){
        $isBooked = htmlentities($_POST['booked']);
        if($isBooked == '0'){
            $docdate = htmlentities($_POST['doc-date']);
            $doctime = htmlentities($_POST['doc-time']);
            $query4 = "DELETE FROM docavailability WHERE Docdate='$docdate' AND Doctime='$doctime' AND Docid='$docID' ";
        }
        if (mysqli_query($conn, $query4)){
            echo "Schedule deleted";
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }


    if(isset($_POST['addSchedule'])){
        $docdate = htmlentities($_POST['doc-date']);
        $doctime = htmlentities($_POST['doc-time']);
        $day = date('l', strtotime(date("$docdate")));
        
        $query2 = "INSERT INTO docavailability(Docid, Docdate, doctime, docday, Booked) Values ('$docID', '$docdate', '$doctime', '$day', 0)";

        if (mysqli_query($conn, $query2)){
            echo "New Schedule Added";
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }

    $query = "SELECT * FROM docavailability WHERE Docid='$docID' ORDER BY Docdate"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $fullSchedule = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>

<?php include('inc/staffHeader.php'); ?>

<h1><?php echo $docName ; ?></h1>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <input type="hidden" name="docid" value="<?php echo $docID ?>">
    <input type="date" name="doc-date" min="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d") ?>">
    <input type="text" name="doc-time">
    <input type="submit" name="addSchedule" value="ADD">
</form>

<div class="div-table">
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Day</th>
            <th>Booked</th>
            <th>Delete</th>
        </tr>
        <?php foreach($fullSchedule as $schedule): ?> 
        <tr>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <td><input type="hidden" name="doc-date" value="<?php echo $schedule['Docdate']; ?>"><?php echo $schedule['Docdate']; ?></td>
                <td><input type="hidden" name="doc-time" value="<?php echo $schedule['Doctime']; ?>"><?php echo $schedule['Doctime']; ?></td>
                <td><?php echo $schedule['Docday']; ?></td>
                <td><input type="hidden" name="booked" value="<?php echo $schedule['Booked']; ?>"><?php echo $schedule['Booked']; ?></td>
                <input type="hidden" name="docid" value="<?php echo $docID ?>">
                <td><input type="submit" name="deleteSchedule" value="Delete"></td>
            </form>
        </tr>
        <?php endforeach; ?>        
    </table>
</div>

</body>
</html>

