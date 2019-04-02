<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="StaffCss/script.css">
    <a><title>DB Clinic | Staff Area</title>
    <script>
function myFunction() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
</head>
<body>
    <header>
        <div class="header">
            <div class="logoImg">
               <a href="../index.php"> <img src="../logosymbol.png" class="logo" height="50" width="50" alt="logo"> </a>
            </div>
            <div class="staff-area">
              <a href="home.php"> <h1>Staff Area</h1>       </a> 
            </div>
        </div>
    </header>
    <?php include('navigation.php'); ?>        
    

	