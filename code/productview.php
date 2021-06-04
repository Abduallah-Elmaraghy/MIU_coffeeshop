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
					echo "<h2>$Name <h2>";
												?>
											</div>
										</div>
										<?php  echo "<p>$Description <p>";  ?>
										<?php echo "<h3>choose your size <h3>";
				$query1="SELECT `id` ,`SizeName` FROM `size` ";
				$result = $conn->query($query1);
				if ($result->num_rows > 0)
				{
					// output data of each row
					while($row = $result->fetch_assoc())
					{
						$id=$row["id"];
						$name=$row["SizeName"];
										?>
										<div class="size">
											<label class="radio1">
												<span>
													<a><div class="row">
														<big>
															<b>
																<?php
						echo   "<label for='A' ><input type='radio' class=test value='$id' name='staff1'> $name<br />";
					}
				} 
				else
				{
					echo "0 results";
				}
																?>     
															</b>
														</big>
														</div>
													</a>
												</span> 
											</label>
										</div>
										<?php
				echo "<h3>choose your milk <h3>";
				$query2="SELECT `id` ,`Type` FROM `milk_type` ";
				$result2 = $conn->query($query2);
				if ($result2->num_rows > 0) {
					// output data of each row
					while($row2 = $result2->fetch_assoc()) 
					{
						$id2=$row2["id"];
						$Typename=$row2["Type"];
										?>
										<div class="milk">
											<label class="radio">
												<span>
													<a><div class="row">
														<big><b>
															<?php
						echo "<label for='B' ><input type='radio' value='$id2' name='staff2'> $Typename<br />";
					}
				}
				else
				{
					echo "";
				}
															?>     
															</b></big>
														</div>
													</a>
												</span> 
											</label>
										</div>
										<?php
				echo "<h3>choose your flavors <h3>";
				$query3="SELECT `Id`, `FlavorName` FROM `flavors` ";
				$result3 = $conn->query($query3);
				if ($result3->num_rows > 0) 
				{
					// output data of each row
										?>
										<div class="row price">
											<label class="radio">
												<?php 
					while($row3 = $result3->fetch_assoc()) 
					{
						$id3=$row3["Id"];
						$FlavorName=$row3["FlavorName"];
												?>
												<input type="radio" name="" value="large"> 
												<span>
													<a id='.<?php echo $id3;?>.'>
														<div class="row">
															<big>
																<b>
																	<?php
						echo $FlavorName;
																	?>
																</b>
															</big>
														</div>
													</a>
												</span>

												<?php 
					}
												?>	
											</label>
										</div>
										<?php
				}
				else 
				{
					echo " ";
				}
										?> 
										<div class="row price">
											<label class="radio">
												<input type="radio" name="size1" value="small" checked>
												<span>
													<a>
														<div class="row">
															<big>
																<b>1.5 oz.</b>
															</big>
														</div>
														<div class="row">
															$12.95
														</div>
													</a>
												</span> 
											</label>
											<label class="radio">
												<input type="radio" name="size1" value="large"> 
												<span>
													<a>
														<div class="row">
															<big><b>4.4 oz.</b></big>
														</div>
														<div class="row">
															$21.95
														</div>
													</a>
												</span>
											</label>
										</div>
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
		if(isset($_POST['submit']))
		{
			$product_name=$_POST['product_name'];
			$amount=$_POST['quantity'];  
			$description=$_POST['description'];
			$category_ID=$_POST['categories'];
			$price=$_POST['price'];
			$product_Image=$_FILES['product-image']['name'];
			$tmp=$_FILES['product-image']['tmp_name'];
			move_uploaded_file($tmp,"products/".$product_Image);	
			$sql="INSERT INTO `products`(`product_name`, `picture_path`, `price`, `amount`, `discription`, `category_id`) VALUES ('$product_name','$tmp','$price','$amount','$description','$category_ID')";
			mysqli_query($conn, $sql);
		}
		?>
	</body>
</html>