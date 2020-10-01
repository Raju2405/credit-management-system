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
          <a class="nav-link" href="history.php">TRANSACTION HISTORY</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="review.php">REVIEW</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container main_container1 my-5">
  <div class="form_row_main row w-100 pt-2" style="display: flex;">
    <div class="main_form border rounded py-3 px-4">
      <h4 class="text-white mb-4">FEEDBACK & REVIEW</h4>
      <form method="POST" action="processor.php" class="form_main">
        <div class="form-group">
          <input type="text" class="form-control" name="name" required="required" id="name">
          <label class="form-control-placeholder" for="name">Full Name</label>
        </div>

        <div class="form-group">
          <input type="email" class="form-control" name="email" required="required" id="email">
          <label class="form-control-placeholder" for="email">Email</label>
        </div>

        <div class="form-group">
          <input type="number" class="form-control" name="rating" required="required" id="rating">
          <label class="form-control-placeholder" for="rating" onkeypress="return numval(event)">Rate From Out of 10</label>
        </div>

        <div class="form-group">
          <textarea type="text" class="form-control" name="feedback" id="feedback" placeholder="Write a Feedback or Message !" rows="4"></textarea>
        </div>

        <input type="submit" class="btn btn-outline-primary float-right" name="submit_feedback" id="submit">
      </form>
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