
<?php include('inc/header.php'); ?>
<?php include('inc/navbar.php'); ?>
    <h2>Staff and Medicine </h2>
    <input type="radio" class="radiobtns" name="tablename" value="medicine_info" checked required> User
    <input type="radio" class="radiobtns" name="tablename" value="doctor" required> Doctor<br>
    <label><b>Column you want to see</b></label>
    <select class="qualification" name="colm">
			  <option value="Name">Med Name</option>
			  <option value="info">Medicine info </option>
			  <option value="docName">Doctor Name </option>

    </select>
    <br>
    <input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
	<a href="account.php"><input type="button" id="back_btn" value="Back"/></a>
<?php include('inc /footer.php'); ?>




<?php include('config_/userLogIN.php'); ?>
<?php
    require('config_/config.php');
    require('config_/db.php');

    if(isset($_POST['submit_btn']))
    {
        $table =$_POST['tablename'];
        $colm=$_POST['colm'];
        if($table=="medicine_info"){
            if($colm=="Name"){
                $columnname="Name";
            }
            if($colm=="info"){
                $columnname="info";
            }
        }

        else if($table=="doctor"){
            if($colm=="docName"){
                $columnname="docName";
            }

        }

        $query= "SELECT 'columnname' from 'table'";
        //exceute query
        if($result->num_rows>0){
            echo "<table align=\"center\"border= \"1\">";
            echo "<tr><th>".$columnname."</th></tr>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row[$columnname]."</td></tr>";
            }
        }
        else{
           echo '<script type="text/javascript"> alert("0 Result") </script>';
        }
    }
?>
