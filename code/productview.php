<?php
$conn = mysqli_connect("localhost","root","","miu_coffeeshop");
if (!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}	
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<link rel="stylesheet" href="css/productview.css">
	</head>
	<body>
		<?php
		$query1="SELECT * FROM `product`";
		$result = $conn->query($query1);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$Name=$row["Name"];
				$StandardPrice=$row["StandardPrice"];
				$Description=$row["Description"];
				$image=$row["image"];
		?>
		<form method="post" action="productview.php">		
			<div class="container">
				<div id="demo" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="card">
								<div class="row">
									<div class="col-md-6 text-center align-self-center"> 
										<!--el image tet7at hena mkan el src elly ta7t-->
										<?php
				print "<img src = 'images/$image' class = 'img-fluid;'>"
										?>
									</div>
									<div class="col-md-6 info">
										<div class="row title">
											<!--										esm el product hena-->
											<div class="col">
												<?php
					echo "<h1>$Name </h1>";
												?>
											</div>
										</div>
										<?php  
				echo "<h3>$Description </h3>"; 
				echo "<h1>Pick a cup size</h1>";
				$query1="SELECT * FROM `size` ";
				$result = $conn->query($query1);
				if ($result->num_rows > 0)
				{
										?>
										<div class="row price">	
											<?php
					// output data of each row
					while($row = $result->fetch_assoc())
					{
						$id=$row["Id"];
						$name=$row["SizeName"];
						$sizeprice=$row["Price"];
											?>
											<label class="radio">
												<input type="radio" name="size1" value="large"> 
												<span>
													<a <?php echo "id=".$id; ?>>
														<div class="row">
															<?php echo $name; ?>
														</div>
														<div class="row">
															<?php echo $sizeprice+$StandardPrice?>
														</div>
													</a>
												</span>
											</label>
											<?php
					}
											?>
										</div>
										<?php
				} 
				else
				{
					echo " ";
				}
										?>     
										<?php
				echo "<h3>Pick a milk <h3>";
				$query2="SELECT `id` ,`Type` FROM `milk_type` ";
				$result2 = $conn->query($query2);
				if ($result2->num_rows > 0) 
				{
					// output data of each row
										?>
										<div class="row price">	
											<?php
					while($row2 = $result2->fetch_assoc()) 
					{
						$id2=$row2["id"];
						$Typename=$row2["Type"];
											?>
											<label class="radio">
												<input type="radio" name="size1" value="large"> 
												<span>
													<a <?php echo "id=".$id2; ?>>
														<div class="row">
															<?php echo $Typename; ?>
														</div>
													</a>
												</span>
											</label>
											<?php
					}
											?>
										</div>
										<?php
				}
				else
				{
					echo "";
				}
										?>     


										<?php
				echo "<h3>Pick a flavors <h3>";
				$query3="SELECT `Id`, `FlavorName` FROM `flavors` ";
				$result3 = $conn->query($query3);
				if ($result3->num_rows > 0) 
				{
					// output data of each row
					while($row3 = $result3->fetch_assoc()) 
					{
										?>
										<div class="row price">

											<?php 
						$id3=$row3["Id"];
						$FlavorName=$row3["FlavorName"];
											?>
											<label class="radio">
												<input type="radio" name="size1" value="large"> 
												<span>
													<a <?php echo "id=".$id3; ?>>
														<div class="row">
															<?php echo $FlavorName; ?>
														</div>
													</a>
												</span>
											</label>

											<?php 
					}
											?>	
											>
										</div>
										<?php
				}
				else 
				{
					echo " ";
				}
										?> 
									</div>
								</div>
								<div class="row lower">
									<div class="col text-right align-self-center"> 
										<button class="btn" type="submit" name="submit">
											Add to cart
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
		}
		else 
		{
			echo " ";
		} 
			?>
		</form>

		<?php
		//		if(isset($_POST['submit']))
		//		{
		//			$product_name=$_POST['product_name'];
		//			$amount=$_POST['quantity'];  
		//			$description=$_POST['description'];
		//			$category_ID=$_POST['categories'];
		//			$price=$_POST['price'];
		//			$product_Image=$_FILES['product-image']['name'];
		//			$tmp=$_FILES['product-image']['tmp_name'];
		//			move_uploaded_file($tmp,"products/".$product_Image);	
		//			$sql="INSERT INTO `products`(`product_name`, `picture_path`, `price`, `amount`, `discription`, `category_id`) VALUES ('$product_name','$tmp','$price','$amount','$description','$category_ID')";
		//			mysqli_query($conn, $sql);
		//		}
		?>

	</body>
</html>