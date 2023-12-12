
<?php 





include 'config.php';
session_start();







if(isset($_POST['submit'])){

	$email = mysqli_real_escape_string($conn,$_POST['email']);

    $password = mysqli_real_escape_string($conn,$_POST['password']);


          $select = mysqli_query($conn,"SELECT *FROM `user_info` WHERE email = '$email' AND password='$password' ") or die ('query failed');
           if(mysqli_num_rows($select)>0){
           	$row =mysqli_fetch_assoc($select);
           	
           	

           	$_SESSION['session']=$row['id'];
                       echo $row['id'];
           	header('location:index.php');
           
          }
          else{
          	$msg[]='Wrong password or username try again';
          }

      }


 ?>
  

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

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
			<h3>Login here</h3>
			
			<input type="email" name="email" placeholder="Enter your email " class="box" >

			<input type="password" name="password" placeholder="ENter your password" class="box">

			

			<input type="submit" name="submit" class="btn" value="CLick for Login">

			<p>Are you not registerd? <a href="reg.php">Click for Register</a></p>

</body>
</html>