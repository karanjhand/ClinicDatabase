<?php
    require('../config/config.php');
    require('../config/db.php');

    $query = "SELECT * FROM user ORDER BY userName"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include('inc/staffHeader.php'); ?>
<a href="home.php">Back</a>
<div class="div-table">
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
        <?php foreach($users as $user): ?> 
        <tr>
            <form action="userProfile.php" method="POST">
                <input type="hidden" name="userid" value="<?php echo $user['userid'] ?>">
                <td><input type="submit" name="go-to-profile" value="<?php echo $user['userName'] ?>"></td>
            </form>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['address'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
