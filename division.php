<?php include('config/userLogIN.php'); ?>
<?php
    require('config/config.php');
    require('config/db.php');





	$division = "SELECT d.docid, d.docname, d.doctype
FROM doctor d
WHERE NOT EXISTS (SELECT da.docid
                  FROM doctor da
                  WHERE NOT EXISTS (SELECT a.docid,a.booked
                                    FROM docavailability a
                                    WHERE a.docid = da.docid and a.docid = d.docid and a.booked = '1'
                                    group by a.docid
                                  ))";
$divisionresult= mysqli_query($conn, $division);

$allbooked = mysqli_fetch_all($divisionresult, MYSQLI_ASSOC);
print_r($allbooked);

	?>
<?php include('inc/header.php'); ?>
<?php include('inc/navbar.php'); ?>
<html>
<head>  <link rel="stylesheet" type="text/css" href="css/styles.css"></head>
<body>

<section class="HomePage">
<div class="Home">

<div class="h1div"><h1 class="h1booked">DOCTORS ALL BOOKED</h1></div>
<div class="division">

	 <table class="bookedtable">
        <tr>
            <th>Doctor #</th>
            <th>Name</th>
            <th>Speciality</th>

        </tr>
        <?php foreach($allbooked as $booked): ?>
            <tr><td><?php echo $booked['docid']?> </Td>
            <td><?php echo $booked['docname']?> </td>
            <td> <?php echo $booked['doctype']?>	</td>
            </tr>
        <?php endforeach; ?>

	</table>


</div>
</div>
</section>
</body>
<?php include('inc/footer.php'); ?>
</html>
