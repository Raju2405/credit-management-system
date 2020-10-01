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
<title>Transaction History</title>
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
          <a class="nav-link" href="transaction.php">TRANSFER CREDITS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="history.php">TRANSACTION HISTORY</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="review.php">REVIEW</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container main_container1 my-5">
  <div class="text-white my-4 w-100 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
    <h3>Transaction History</h3>
  </div>
  <div class="table_row row w-100">
    
    <div class="col-12">
      <div class="table_main">
        <table class="table table-striped table-bordered w-100" id="table_main">
          <thead class="table-dark text-center">
            <tr>
              <th>TRANS ID</th>
              <th>FROM</th>
              <th>TO</th>
              <th>CREDITS TANSFERRED</th>
              <th>DATE</th>
              <th>TIME</th>
            </tr>
          </thead>

          <tbody class="table-dark text-center added_users">
            <?php
              $sql="SELECT * FROM transfer";
              $query=mysqli_query($conn,$sql);
              while($row = mysqli_fetch_array($query))
              {
            ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['transfer_from']; ?></td>
              <td><?php echo $row['transfer_to']; ?></td>
              <td><?php echo $row['credits']; ?></td>
              <td><?php echo $row['transfer-date']; ?></td>
              <td><?php echo $row['transfer-time']; ?></td>
            </tr>
            <?php
              }
            ?>
            <tr>
              <td>2</td>
              <td>raju@gmail.com</td>
              <td>rktech50@gmail.com</td>
              <td>&#x20B9; &nbsp;2,000</td>
              <td>16 Sept 2020</td>
              <td>05:03 PM</td>
            </tr>
          </tbody>

          <tfoot class="table-dark text-center">
            <tr>
              <th>TRANS ID</th>
              <th>FROM</th>
              <th>TO</th>
              <th>CREDITS TANSFERRED</th>
              <th>DATE</th>
              <th>TIME</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
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