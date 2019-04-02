<?php include('inc/staffHeader.php'); ?>
<?php 
    require('../config/config.php');
    require('../config/db.php');
    $updated = 0;
    $inserted = 0;
    $deleted = 0;
    

    if(isset($_POST['updateMedicine'])){
        $medName = htmlentities($_POST['medName']);
        $medCost = htmlentities($_POST['medCost']);
        $medInfo = htmlentities($_POST['medInfo']);
        $quantity = htmlentities($_POST['quantity']);
        $medImage = htmlentities($_POST['medImage']);
        $medID = (int)($_POST['medID']);

        $query2 = "UPDATE medicine_info SET Name='$medName', Cost='$medCost', Info='$medInfo', quantity='$quantity', medImage='$medImage' WHERE medID='$medID' ";
        if (mysqli_query($conn, $query2)){
            $updated = 1;
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
        
    }

    if(isset($_POST['add-new-med'])){
        $medName = htmlentities($_POST['name-new']);
        $medCost = htmlentities($_POST['cost-new']);
        $medInfo = htmlentities($_POST['info-new']);
        $quantity = htmlentities($_POST['quantity-new']);
        $medImage = htmlentities($_POST['image-new']);

        $query4 = "INSERT INTO medicine_info(Name, Cost, Info, quantity, medImage) Values ('$medName', '$medCost', '$medInfo', '$quantity', '$medImage')";
        if (mysqli_query($conn, $query4)){
            $inserted = 1;
            $medName = htmlentities($_POST['suggest-name']);
            $medInfo = htmlentities($_POST['suggest-info']);
            $query6 = "DELETE FROM suggest WHERE medName='$medName' AND medInfo='$medInfo' ";
            if (mysqli_query($conn, $query6)){
                
            }
            else{
                echo "ERROR: " . mysqli_error($conn);
            }
            }
            else{
                echo "ERROR: " . mysqli_error($conn);
            }
    }

    if(isset($_POST['Delete'])){
        $medID = (int)($_POST['medID']);
        $query3 = "DELETE FROM medicine_info WHERE MedID='$medID' ";
        if (mysqli_query($conn, $query3)){
            $deleted = 1;
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['cancel-suggestion'])){
        $medName = htmlentities($_POST['suggest-name']);
        $medInfo = htmlentities($_POST['suggest-info']);
        $query6 = "DELETE FROM suggest WHERE medName='$medName' AND medInfo='$medInfo' ";
        if (mysqli_query($conn, $query6)){
            $deleted = 1;
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }

    $query = "SELECT * FROM medicine_info ORDER BY Name"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $query5 = "SELECT * FROM suggest"; 
    $result5 = mysqli_query($conn, $query5);

    // fetch data into an associative array
    $suggestions = mysqli_fetch_all($result5, MYSQLI_ASSOC);
?>

<a href="home.php">Back</a>
<div class="div-table">
    <table>
        <tr>
            <th>Name</th>
            <th>Cost</th>
            <th>Info</th>
            <th>Quantity</th>
            <th>Image url</th>
            <th>Update/Add</th>
            <th>Delete</th>
        </tr>
        <tr>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <td><input type="text" name="name-new" required></td>
                <td><input type="number" min="0" name="cost-new" required></td>
                <td><input type="text" name="info-new"></td>
                <td><input type="number" min="0" name="quantity-new" required></td>
                <td><input type="text" name="image-new"></td>    
                <input type="hidden" name="suggest-name" value="">
                <input type="hidden" name="suggest-info" value="">      
                <td><input type="submit" name="add-new-med" value="Add Medicine"></td>
                <td></td>
            </form>
            </tr>
        
        <?php foreach($suggestions as $suggestion): ?> 
        <tr>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <td><input class="table-content" type="text" name="name-new" value="<?php echo $suggestion['medName']; ?>"></td>
            <td><input type="number" min="0" name="cost-new" required></td>
            <td><input class="table-content" type="text" name="info-new" value="<?php echo $suggestion['medInfo']; ?>"></td>
            <td><input type="number" min="0" name="quantity-new" required></td>
            <td><input type="text" name="image-new"></td>
            <input type="hidden" name="suggest-name" value="<?php echo $suggestion['medName']; ?>">
            <input type="hidden" name="suggest-info" value="<?php echo $suggestion['medInfo']; ?>">
            <td><input type="submit" name="add-new-med" value="Add Medicine"></td>
            </form>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="hidden" name="suggest-name" value="<?php echo $suggestion['medName']; ?>">
            <input type="hidden" name="suggest-info" value="<?php echo $suggestion['medInfo']; ?>">
            <td><input type="submit" value="Cancel" name="cancel-suggestion"></td>
            </form>
        </tr>
        <?php endforeach; ?>
        <?php foreach($medicines as $medicine): ?> 
        <tr>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            
                <input type="hidden" name="medID" value="<?php echo $medicine['MedID'] ?>">
                <td><input class="table-content" type="text" name="medName" value="<?php echo $medicine['Name'] ?>"></td>
                <td>$<input class="table-content" type="number" name="medCost" min="0" value="<?php echo $medicine['Cost'] ?>"></td>
                <td><input class="table-content" type="text" name="medInfo" value="<?php echo $medicine['Info'] ?>"></td>
                <td><input class="table-content" type="number" name="quantity" value="<?php echo $medicine['quantity'] ?>"></td>
                <td><input class="table-content" type="text" name="medImage" value="<?php echo $medicine['medImage'] ?>"></td>
                <td><input type="submit" name="updateMedicine" value="Update"></td>
                </form>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="medID" value="<?php echo $medicine['MedID'] ?>">
                    <td><input type="submit" name="Delete" value="Delete"></td>
                </form> 
            </tr>          
        <?php endforeach; ?>
    </table>
</div>
<div id="snackbar">
<?php
    if($updated == 1){
        ?>
            <script>myFunction();</script>        
        <?php  
        echo "Medicine Updated";
    }
?>
<?php
    if($inserted == 1){
        ?>
            <script>myFunction();</script>        
        <?php  
        echo "New Medicine Added";
    }
?>
<?php
    if($deleted == 1){
        ?>
            <script>myFunction();</script>        
        <?php  
        echo "Medicine deleted Successfully";
    }
?>

</div>



</body>
</html>