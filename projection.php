
<?php include('config/userLogIN.php'); ?>
<?php

require('config/config.php');
require('config/db.php');

$projectionDoc = "SELECT docName from doctor";
$projection_resultDoc = mysqli_query($conn,$projectionDoc);

$projection_med = "SELECT Name,info from medicine_info";
$projection_resultMed = mysqli_query($conn,$projection_med);

$project_med = mysqli_fetch_all($projection_resultMed, MYSQLI_ASSOC);
$project_doc = mysqli_fetch_all($projection_resultDoc, MYSQLI_ASSOC);
print_r($project_med);

?>

<?php include('inc/header.php'); ?>
<?php include('inc/navbar.php'); ?>
<html>
<body>
<head>  <link rel="stylesheet" type="text/css" href="css/styles.css"></head>
<section class="HomePage">
<div class="Home">

<div class="h1div"><h1 class="h1booked">NAMES</h1></div>
<div class="division">

	 <table class="table of names">
        <tr>
            <th>doctor name #</th>

        </tr>
        <?php foreach($project_med as $projection_med): ?>
            <tr><td><?php echo $projection_med['docName']?> </td>

            </tr>
        <?php endforeach; ?>

        <tr>
            <th>med name</th>
            <th>med info</th>
        </tr>
        <?php foreach($project_med as $projection_med): ?>
            <tr><td><?php echo $projection_med['Name']?> </td>
              <td><?php echo $projection_med['info']?> </td>
            </tr>
        <?php endforeach; ?>

	</table>


</div>
</div>
</section>
</body>
<?php include('inc/footer.php'); ?>
</html>
