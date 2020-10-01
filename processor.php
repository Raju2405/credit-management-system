<?php
include "conn.php";
date_default_timezone_set("Asia/Kolkata");
session_start();
if(isset($_POST['submit_user']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$credit=$_POST['credits'];
	$date=date("jS F Y");
	$time=date("h:i:s a");

	$sql="INSERT INTO users(name,email,credits,`current-date`,`current-time`) VALUES('$name','$email','$credit','$date','$time')";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$result = '<p class="alert-success">New User Added</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
	else
	{
		$result = '<p class="alert-danger">User Not Added</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
}

if(isset($_GET['del']))
{
	$id=$_GET['del'];
	$sql="DELETE FROM users WHERE id='$id'";
	$query=mysqli_query($conn,$sql);
	if($query)
	{
		$result = '<p class="alert-success">User Deleted</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
	else
	{
		$result = '<p class="alert-danger">Cannot Delete User</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
}


if(isset($_POST['transfer']))
{
	$from=$_POST['transfer_from'];
	$to=$_POST['transfer_to'];
	$credit=$_POST['credit_transfer'];
	$date=date("jS F Y");
	$time=date("h:i:s a");

	$transfer_data = "INSERT INTO transfer(transfer_from,transfer_to,credits,`transfer-date`,`transfer-time`) VALUES('$from','$to','$credit','$date','$time')";
	$query_transfer = mysqli_query($conn,$transfer_data);

	$previous="SELECT * FROM users where email='$to'";
	$prev_query=mysqli_query($conn,$previous);
	while($row=mysqli_fetch_array($prev_query))
	{
		$new_value = intval($row['credits']) + intval($credit);
		// echo $new_value;

		$insert_new="UPDATE users SET credits='$new_value' WHERE email='$to'";
		$sql_new=mysqli_query($conn,$insert_new);

	}

	$sub_sender="SELECT * FROM users WHERE email='$from'";
	$sub_query=mysqli_query($conn,$sub_sender);
	while($row2=mysqli_fetch_array($sub_query))
	{
		$new_sub_value = intval($row2['credits']) - intval($credit);
		// echo $new_sub_value;

		$insert_updated="UPDATE users SET credits='$new_sub_value' WHERE email='$from'";
		$sql_update=mysqli_query($conn,$insert_updated);

		if($sql_update)
		{
			$result = '<p class="alert-success">Credits Transferred</p>';
			$_SESSION['result']=$result;
			header("location:".$_SERVER['HTTP_REFERER']);
			exit();
		}
		else
		{
			$result = '<p class="alert-danger">Cannot Transfer Credits</p>';
			$_SESSION['result']=$result;
			header("location:".$_SERVER['HTTP_REFERER']);
			exit();
		}
	}
}

if(isset($_POST['submit_feedback']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$rating=$_POST['rating'];
	$feedback=$_POST['feedback'];

	$sql="INSERT INTO feedback(name,email,rating,message) VALUES('$name','$email','$rating','$feedback')";
	$query=mysqli_query($conn,$sql);

	$to = "rktech50@gmail.com";
	$subject = "Feedback From Credit Management";

	$message = "<b>Name : ".$name."</b>";
	$message .= "<b>Email : ".$email."</b>";
	$message .= "<b>Rating : ".$rating." / 10</b>";
	$message .= "<p>Feedback : ".$feedback."</p>";

	$header = "From:feedback@credit-management.com \r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html\r\n";

	$retval = mail ($to,$subject,$message,$header);

	if($query == true && $retval == true)
	{
		$result = '<p class="alert-success">Message Sent Successfully...</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
	else
	{
		$result = '<p class="alert-danger">Cannot Send Message !</p>';
		$_SESSION['result']=$result;
		header("location:".$_SERVER['HTTP_REFERER']);
		exit();
	}
}


?>