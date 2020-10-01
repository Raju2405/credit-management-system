<?php
include "conn.php";
date_default_timezone_set("Asia/Kolkata");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="./assets/css/app.css">
<title>Transaction</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">CREDIT MANAGEMENT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#credit_management_nav" aria-controls="credit_management_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="credit_management_nav">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="users.php">USERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="transaction.php">TRANSFER CREDITS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php">TRANSACTION HISTORY</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="review.php">REVIEW</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container main_container1 text-white my-5">
  <h3 class="text-left mb-2 w-100">Transfer Credits</h3>
  <div class="credit_transfer border py-4 px-3 w-100">
    <form class="form_transfer" method="POST" action="processor.php">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-12  mt-lg-0 mt-2">
            <div class="form-group">
              <label class="mb-1">Transfer From</label>
              <select class="form-control" name="transfer_from" required>
               <option disabled selected value="">Select Account To Transfer</option>
                <?php
                  $sql="SELECT * FROM users";
                  $query=mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_array($query))
                  {
                ?>
                <option value="<?php echo $row['email']; ?>"><?php echo $row['email']; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-12 mt-lg-0 mt-2">
            <div class="form-group">
              <label class="mb-1">Transfer To</label>
              <select class="form-control" name="transfer_to" required>
               <option disabled selected value="">Select Beneficiary</option>
               <?php
                  $sql="SELECT * FROM users";
                  $query=mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_array($query))
                  {
                ?>
                <option value="<?php echo $row['email']; ?>"><?php echo $row['email']; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col-12">
            <input type="number" class="w-100 form-control" name="credit_transfer" placeholder="Enter Amount To Transfer" onkeypress="numval()" required>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col-12 text-center">
            <input type="submit" class="btn btn-outline-primary w-50" name="transfer" value="Transfer Now">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="results_toast"><?php echo $_SESSION['result']; ?></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
<script type="text/javascript" src="./assets/js/app.js"></script>

<script type="text/javascript">

$('#table_main').DataTable( {
    responsive: true
} );

</script>

</body>
</html>


<?php 
if(isset($_SESSION['result']))
{
  echo '<script type="text/javascript">
  var x = document.getElementById("results_toast");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);</script>';
}

session_destroy();

?>