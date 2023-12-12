
<?php
include 'config.php';

if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
   $email = mysqli_real_escape_string($conn,$_POST['email']);

    $password = mysqli_real_escape_string($conn,$_POST['password']);
     $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);

      $select = mysqli_query($conn,"SELECT *FROM `user_info` WHERE email = '$email' AND password='$password' ") or die ('query failed');

      if(mysqli_num_rows($select)>0){
      	$msg[]="User name is not available";

      }
      else{
      	mysqli_query($conn, "INSERT INTO `user_info` (name,email,password) VALUES ('$name','$email','$password')") or die ('failed');
      	$msg[]="Welcome You are successfully registerd";
      	header('location:login.php');

      }
}




  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registation</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div>
		<?php
                     if(isset($msg)){
                     	foreach ($msg as $msg) {
                     		echo "<div class='msg' onclick='this.remove()'>" .$msg."</div>";
                     	}
                     }
		  ?>
	</div>
	<div class="from-container">

		<form action="" method="post">
			<h3>Registation here</h3>
			<input type="text" name="name" placeholder="Enter your name" class="box" >

			<input type="email" name="email" placeholder="Enter your email " class="box" >

			<input type="password" name="password" placeholder="ENter your password" class="box">

			<input type="password" name="cpassword" placeholder="Enter password again" class="box" >

			<input type="submit" name="submit" class="btn" value="CLick for Registation">

			<p>Are you already registerd <a href="Login.php">Click for login</a></p>


		</form>
	</div>

</body>
</html>