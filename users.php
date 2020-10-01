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
<title>Users</title>
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
          <a class="nav-link active" aria-current="page" href="users.php">USERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction.php">TRANSFER CREDITS</a>
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

<div class="container main_container my-5">
  <div class="row action_div w-100">
    <div class="col-lg-9 col-12 d-flex justify-content-lg-start justify-content-md-start justify-content-center text-white">
      
    </div>
    <div class="col-lg-3 col-12 d-flex justify-content-lg-end justify-content-md-end justify-content-center">
      <a type="button" class="btn btn-primary" id="add_user_button" onclick="add_user()">ADD USER</a>
    </div>
  </div>

  <div class="form_row_main row w-100 pt-2" id="add_new_user" style="display: none;">
    <div class="main_form border rounded py-3 px-4">
      <h4 class="text-white mb-4">ADD NEW USER</h4>
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
          <input type="number" class="form-control" name="credits" required="required" id="credits">
          <label class="form-control-placeholder" for="credits" onkeypress="return numval(event)">Add Credits</label>
        </div>

        <input type="submit" class="btn btn-outline-primary float-right" name="submit_user" required="required" id="submit">
      </form>
    </div>
  </div>

  <div class="table_row row w-100">
    <div class="col-lg-9 col-md-9 col-12 d-flex justify-content-lg-start justify-content-md-start justify-content-center text-white my-4">
      <h3>REGISTERED USERS</h3>
    </div>

    <div class="col-12">
      <div class="table_main">
        <table class="table table-striped table-bordered w-100" id="table_main">
          <thead class="table-dark text-center">
            <tr>
              <th>REG ID</th>
              <th>NAME</th>
              <th>EMAIL ID</th>
              <th>CREDITS AVAILABLE</th>
              <th>REG DATE</th>
              <th>ACTION</th>
            </tr>
          </thead>

          <tbody class="table-dark text-center added_users">
            <?php
              $sql="SELECT * FROM users";
              $query=mysqli_query($conn,$sql);
              while($row = mysqli_fetch_array($query))
              {
            ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td>&#x20B9; &nbsp;<?php echo number_format($row['credits']); ?></td>
              <td><?php echo $row['current-date']; ?><br><?php echo $row['current-time']; ?></td>
              <td><a href="processor.php?del=<?php echo $row['id']; ?>" class="btn btn-danger py-1" onclick="return confirm('Are You Sure You Want To Delete ?')">Delete</a></td>
            </tr>
            <?php
              }
            ?>
          </tbody>

          <tfoot class="table-dark text-center">
            <tr>
              <th>REG ID</th>
              <th>NAME</th>
              <th>EMAIL ID</th>
              <th>CREDITS AVAILABLE</th>
              <th>REG DATE</th>
              <th>ACTION</th>
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