<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
	if(!empty($_SESSION["shopping_cart"])) {
		foreach($_SESSION["shopping_cart"] as $key => $value) {
			if($_POST["Code"] == $key){
				unset($_SESSION["shopping_cart"][$key]);
				$status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
			}
			if(empty($_SESSION["shopping_cart"]))
				unset($_SESSION["shopping_cart"]);
		}		
	}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
	foreach($_SESSION["shopping_cart"] as &$value){
		if($value['Code'] === $_POST["Code"]){
			$value['quantity'] = $_POST["quantity"];
			break; // Stop the loop after we've found the product
		}
	}

}
?>

<style>
	.product_wrapper {
		float:left;
		padding: 10px;
		text-align: center;
	}
	.product_wrapper:hover {
		box-shadow: 0 0 0 2px #e5e5e5;
		cursor:pointer;
	}
	.product_wrapper .name {
		font-weight:bold;
	}
	.product_wrapper .buy {
		text-transform: uppercase;
		background: #F68B1E;
		border: 1px solid #F68B1E;
		cursor: pointer;
		color: #fff;
		padding: 8px 40px;
		margin-top: 10px;
	}
	.product_wrapper .buy:hover {
		background: #f17e0a;
		border-color: #f17e0a;
	}
	.message_box .box{
		margin: 10px 0px;
		border: 1px solid #2b772e;
		text-align: center;
		font-weight: bold;
		color: #2b772e;
	}
	.table td {
		border-bottom: #F0F0F0 1px solid;
		padding: 10px;
	}
	.cart_div {
		float:right;
		font-weight:bold;
		position:relative;
	}
	.cart_div a {
		color:#000;
	}	
	.cart_div span {
		font-size: 12px;
		line-height: 14px;
		background: #F68B1E;
		padding: 2px;
		border: 2px solid #fff;
		border-radius: 50%;
		position: absolute;
		top: -1px;
		left: 13px;
		color: #fff;
		width: 20px;
		height: 20px;
		text-align: center;
	}
	.cart .remove {
		background: none;
		border: none;
		color: #0067ab;
		cursor: pointer;
		padding: 0px;
	}
	.cart .remove:hover {
		text-decoration:underline;
	}
</style>

<div class="cart">
	<?php
	if(isset($_SESSION["shopping_cart"])){
		$total_price = 0;
	?>	
	<table class="table">
		<tbody>
			<tr>
				<td></td>
				<td>ITEM NAME</td>
				<td>QUANTITY</td>
				<td>UNIT PRICE</td>
				<td>ITEMS TOTAL</td>
			</tr>	
			<?php		
		foreach ($_SESSION["shopping_cart"] as $product){
			?>
			<tr>
				<td>
					<img src='<?php echo $product["Image"]; ?>' width="50" height="40" />
				</td>
				<td><?php echo $product["Name"]; ?><br />
					<form method='post' action=''>
						<input type='hidden' name='Code' value="<?php echo $product["Code"]; ?>" />
						<input type='hidden' name='action' value="remove" />
						<button type='submit' class='remove'>Remove Item</button>
					</form>
				</td>
				<td>
					<form method='post' action=''>
						<input type='hidden' name='Code' value="<?php echo $product["Code"]; ?>" />
						<input type='hidden' name='action' value="change" />
						<select name='quantity' class='quantity' onChange="this.form.submit()">
							<option <?php if($product["quantity"]==1) echo "selected";?>
									value="1">1</option>
							<option <?php if($product["quantity"]==2) echo "selected";?>
									value="2">2</option>
							<option <?php if($product["quantity"]==3) echo "selected";?>
									value="3">3</option>
							<option <?php if($product["quantity"]==4) echo "selected";?>
									value="4">4</option>
							<option <?php if($product["quantity"]==5) echo "selected";?>
									value="5">5</option>
						</select>
					</form>
				</td>
				<td><?php echo "$".$product["StandardPrice"]; ?></td>
				<td><?php echo "$".$product["StandardPrice"]*$product["quantity"]; ?></td>
			</tr>
			<?php
			$total_price += ($product["StandardPrice"]*$product["quantity"]);
		}
			?>
			<tr>
				<td colspan="5" align="right">
					<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
				</td>
			</tr>
		</tbody>
	</table>		
	<?php
	}else{
		echo "<h3>Your cart is empty!</h3>";
	}
	?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
	<?php echo $status; ?>
</div>