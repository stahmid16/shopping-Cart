


<?php

include 'config.php';

session_start();



    $id = $_SESSION['session'];
    echo $id;
    


   if(!isset($id)){
    	header('location:login.php');


    	if(isset($_GET['logout'])){
	unset($id);
	session_destroy();
}
    


}


       if(isset($_POST['add_cart'])){
       	$procuct_name= $_POST['procuct_name'];
       	$procuct_price= $_POST['procuct_price'];
       	$procuct_img= $_POST['procuct_img'];
       	$procuct_qui= $_POST['procuct_quantity'];

             
             $sel_cart=  mysqli_query($conn,"SELECT *FROM `pro_craft` WHERE name='$procuct_name' AND user_id= '$id'") or die ('query failed');

                      if(mysqli_num_rows($sel_cart)>0){
                      	$msg[]= "product allready entrey";
                      }
                      else{
                               mysqli_query($conn, "INSERT INTO `pro_craft` (user_id,name,price,image, 	quiantity ) VALUES ('$id','$procuct_name','$procuct_price','$procuct_img','$procuct_qui')") or die ('failed');


                      }



       }



  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Shoping cart</title>
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

	<div class="container">
		<div class="user-info">
			<?php

			    $user_select = mysqli_query($conn,"SELECT *FROM `user_info` WHERE id = '$id'") or die ('query failed');

			       if(mysqli_num_rows($user_select)>0){
			       	$row=mysqli_fetch_assoc($user_select);


			       }

			  ?>
			  <p>User Name- <span> <?php echo $row['name'];;  ?> </span> </p>
			   <p>User Name- <span> <?php echo $row['email'];;  ?> </span> </p>
			   <div class="flex">
			   	  <a href="login.php" class="btn">login</a>
			   	  <a href="reg.php" class="option-btn">Register</a>
			   	  <a href="index.php?logout= <?php echo $row['id'] ?>" onclick="return confrim('Are you sure to logput');" class="delete-btn">Logout</a>

			   </div>
			
		</div>
		
	</div>



	<div class="product">
		
		 <div class="box-contain">
		 	   <?php

                     $select_product = mysqli_query($conn,"SELECT *FROM `procuct`") or die ('query failed');

			       if(mysqli_num_rows($select_product)>0){
			       	while ($procuct=mysqli_fetch_assoc($select_product)) {
			       	
			        

		 	     ?>
                    
                 <form class="box" action="" method="post" >
                 	   <img class="size" src="img/<?php echo $procuct['image']  ?>">
                 	   <div class="name"> <?php echo $procuct['name']  ?> </div>
                 	    <div class="price"> <?php echo $procuct['price']  ?> </div>
                 	    <input type="number" min="1" name="procuct_quantity" value="1">
                 	    <input type="hidden" name="procuct_img" value="<?php echo $procuct['image']  ?>">

                 	     <input type="hidden" name="procuct_name" value="<?php echo $procuct['name']  ?>">
                 	      <input type="hidden" name="procuct_price" value="<?php echo $procuct['price']  ?>">

                 	     <input type="submit" name="add_cart" class="btn" value="Add to cart">


                 </form>

                 <?php 
                            	}


			       }   

                  ?>
		 </div>

	</div>
	<div class="Shoping-cart">
		<h3 align="center" class="heading">----Shoping cart----</h3>

		<table>
			<thead>
				
				<th>Image</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total price</th>


				
			</thead>
			<?php 
			                $craft_que = mysqli_query($conn,"SELECT *FROM `pro_craft` WHERE user_id='$id' ") or die ('query failed');
                        if(mysqli_num_rows($craft_que)>0){
			       	while ($total_craft=mysqli_fetch_assoc($craft_que)) {

			 ?>
			 <tr>
			 	<td> <img src="img/<?php echo $total_craft['image'] ?> " height="100">  </td>
			 	<td> <?php echo $total_craft['name'] ?> </td>
			 	<td> <?php echo $total_craft['price'] ?> </td>
			 	<td> 
			 		<form>
			 		<input type="hidden" name="cart-id" value="<?php echo $total_craft['id'] ?> ">
			 		<input type="number" min="1" name="cart-quantity" value="<?php echo $total_craft['quiantity'] ?>">
			 		<input type="submit" name="update-craft" value="update" class="btn">
                         </form>

			 	 </td>
			 	 <td>
			 	 	<?php
                         $total= number_format($total_craft['price']* $total_craft['quiantity'] );
                         echo $total;

			 	 	 ?>
			 	 </td>
			 </tr>

			 <?php
			}
		}
			   ?>
		</table>
	</div>


</body>
</html>