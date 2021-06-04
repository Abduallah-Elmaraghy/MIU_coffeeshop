<?php
session_start();
$con = mysqli_connect("localhost","root","","miu_coffeeshop");
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
}

$status="";
if (isset($_POST['Code']) && $_POST['Code']!=""){
	$Code = $_POST['Code'];
	$result = mysqli_query(
		$con,
		"SELECT * FROM `product` WHERE `Code`='$Code'"
	);
	$row = mysqli_fetch_assoc($result);
	$Name = $row['Name'];
	$Code = $row['Code'];
	$StandardPrice = $row['StandardPrice'];
	$Image = $row['Image'];

	$cartArray = array(
		$Code=>array(
			'Name'=>$Name,
			'Code'=>$Code,
			'StandardPrice'=>$StandardPrice,
			'quantity'=>1,
			'Image'=>$Image)
	);

	if(empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		$status = "<div class='box'>Product is added to your cart!</div>";
	}else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($Code,$array_keys)) {
			$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
		} else {
			$_SESSION["shopping_cart"] = array_merge(
				$_SESSION["shopping_cart"],
				$cartArray
			);
			$status = "<div class='box'>Product is added to your cart!</div>";
		}

	}
}
?>
<?php
if(!empty($_SESSION["shopping_cart"])) {
	$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
	<a href="cart.php"><img src="cart-icon.png" /> Cart<span>
		<?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>

<?php
$result = mysqli_query($con,"SELECT * FROM `product`");
while($row = mysqli_fetch_assoc($result)){
	echo "<div class='product_wrapper'>
    <form method='post' action=''>
    <input type='hidden' Name='Code' value=".$row['Code']." />
    <div class='Image'><img src='".$row['Image']."' /></div>
    <div class='Name'>".$row['Name']."</div>
    <div class='StandardPrice'>$".$row['StandardPrice']."</div>
    <button type='submit' class='buy'>Buy Now</button>
    </form>
    </div>";
}
mysqli_close($con);
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
	<?php echo $status; ?>
</div>