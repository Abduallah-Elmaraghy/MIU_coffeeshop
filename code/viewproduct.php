<?php
$conn = mysqli_connect("localhost","root","","miu_coffeeshop");
if (!$conn) 
{
	die("Connection failed: " . mysqli_connect_error());
}
?>
<html>
	<head>
		<style>

			body
			{

				background-color:#c1c1c1;
			}
			.form123
			{
				font-size: 15;
				font-family: "Times New Roman", Times, serif;
				margin-top:  150px;
				margin-left: 850px;
				line-height: 1.6;

			}
			.form123  input[type=submit] 
			{
				background-color:red;
				margin-left: 950px;
				border: none;
				color: white;
				padding: 16px 32px;
				text-decoration: none;
				margin: 4px 2px;
				cursor: pointer;
			}

			.form input[type=number]
			{
				background-color:#c1c1c1;
				margin-left: 950px;
				border: none;
				color: white;
				padding: 16px 32px;
				text-decoration: none;
				margin: 4px 2px;
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<div class="form123">
			<form method="post" action="viewproduct.php">
				<?php
				echo "<img src = 'images/1.jpg' style = 'border-radius: 5%; width: 160px; height: 160px; margin-top: -5px; margin-left: 800px; padding-top: 0px; margin-buttom:200px;'>";
				echo "<h3>choose your size <h3>";
				$query1="SELECT `id` ,`SizeName` FROM `size` ";
				$result = $conn->query($query1);
				if ($result->num_rows > 0) 
				{
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						$id=$row["id"];
						$name=$row["SizeName"];
						echo   "<label for='A' ><input type='radio' class=test value='$id' name='staff2'> $name<br />";
					}
				} 
				else 
				{
					echo "0 results";
				}
				echo "<h3>choose your milk <h3>";
				$query2="SELECT `id` ,`Type` FROM `milk_type` ";
				$result2 = $conn->query($query2);
				if ($result2->num_rows > 0) 
				{
					// output data of each row
					while($row2 = $result2->fetch_assoc()) 
					{
						$id2=$row2["id"];
						$Typename=$row2["Type"];
						echo "<label for='B' ><input type='radio' value='$id2' name='staff2'> $Typename<br />";
					}
				} 
				else 
				{
					echo "0 results";
				}
				echo "<h3>choose your flavors <h3>";
				$query3="SELECT `Id`, `FlavorName` FROM `flavors` ";
				$result3 = $conn->query($query3);
				if ($result3->num_rows > 0) 
				{
					// output data of each row
					while($row3 = $result3->fetch_assoc()) 
					{
						$id3=$row3["Id"];
						$FlavorName=$row3["FlavorName"];
						echo "<label for='C' ><input type='radio' value='$id3' name='staff3'> $FlavorName<br />";
					}
				}
				else
				{
					echo "0 results";
				}
				?>
				<?php
				echo "<h3>choose your beverages <h3>";
				$query4="SELECT `DrinkId`, `DrinkType` FROM `beverages` ";
				$result4 = $conn->query($query4);
				if ($result4->num_rows > 0) 
				{
					// output data of each row
					while($row4 = $result4->fetch_assoc()) 
					{
						$id4=$row4["DrinkId"];
						$beverages=$row4["DrinkType"];
						echo " <label for='D' > <input  type='radio'  value='$id4' name='staff4'>  $beverages <br />";
					}
				}
				else 
				{
					echo "0 results";
				}
				?>
				<br>
				<input type="number" name="quantity"placeholder="quantity">
				<br>
				<br>
				<input type="submit" value="add to card" >
			</form>
		</div>
	</body>
</html>