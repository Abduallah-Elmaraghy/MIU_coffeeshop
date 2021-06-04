<?php
require_once("classes.php");
$allProducts=Menu::viewProducts();
?>
<html>
	<style>
		*{

		}
		.main{
			position: relative;
			margin-left: 10px;
			background-color: #eeebdd;
			padding: 20px;
			margin-top: 30px;
			border-radius: 50px;
		}

		button:hover{
			background-color: grey;
		}

	</style>	
	<body>
		<h1 style="border-radius: 50px; text-align: center; padding: 15px; margin: 0px; background-color: grey; ">
			<!--  <img src="miu-logo.jpg">Menu</h1> -->
			<p style=" background-color:  #F72323; padding: 15px;border-radius: 50px; " img src="miu-logo.jpg">Menu</p>
			<img style=" margin-top: -90px; margin-right:1000px; width: 100px;height: 50.5px;" src="miu-logo.jpg">
			</body>
		<?php	
		foreach ($allProducts as $product ) {?>

		<form method="post" action="menu.php?action=add&id=<?php echo$row["id"];?>">
			<?php 

											 echo"<div class='main'> ";
											 echo"Drink name: ";
											 echo $product->name;echo"<br>";
											 echo"Drink price: ";echo $product->StandardPrice;echo"<br>";	
											 echo"Drink description: ";echo $product->Description;	
											 echo"<br><br>";
											 echo "<img style='width: 150px; height: 150.5px; border-radius: 50px;  margin-top: -150px; margin-left:-450px; position:absolute; ' src= '$product->pic' >";


											 echo"<button style=' border-radius: 50px; padding: 10px; margin-top: -30px; margin-left:-40px; position:absolute; ' type='submit' name='addtocart'>Add to cart</button>";
											 echo"</div>";
											}

			?>
		</form>
		</div>

</html>  

