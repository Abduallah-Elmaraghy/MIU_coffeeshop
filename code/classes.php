<?php
class DB 
{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "miu_coffeeshop";
	public $conn;

	function __construct() 
	{
		$this->conn = $this->connectDB();
	}

	function connectDB() 
	{
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
}

class Product 
{
	public $id;
	public $name;
	public $image;
	public $milk_type;
	public $drink_type;
	public $size;
	public $price;
	public $description;
	function __construct($id) 
	{
		$db_handle = new DB();
		if($id!="")
		{
			$sql = "SELECT * FROM product WHERE id=".$id;
			$product = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($product))
			{
				$this->id=$row["id"];
				$this->name=$row["Name"];
				$this->price=$row["StandardPrice"];
				$this->description=$row["Descroption"];
//				$this->image=$row["image"];
			}
			//////milk Type Id//////
			$milk_id = row["MilkTypeId"];
			//////Drink Type Id//////
			$drink_id = row["DrinkTypeId"];
			//////size Id//////
			$size_id = row["SizeId"];
			///////////// get milk type /////////////
			$sql = "SELECT Type FROM `milk_type`WHERE milk_type.Id =".$milk_id;
			$type = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($type))
			{
				$this->milk_type = $row["Type"];
			}
			///////////// get drink type /////////////
			$sql = "SELECT Type FROM `beverages`WHERE beverages.DrinkId =".$drink_id;
			$type = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($type))
			{
				$this->drink_type = $row["DrinkType"];
			}
			///////////// get size name /////////////
			$sql = "SELECT SizeName FROM `size`WHERE size.Id =".$size_id;
			$type = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($type))
			{
				$this->milk_type = $row["SizeName"];
			}
			$sql = "SELECT Type FROM `beverages`WHERE beverages.DrinkId =".$drink_id;
			$type = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($type))
			{
				$this->$size = $row["DrinkType"];
			}
		}
	}
}

class Beverages
{
	public $DrinkType;
	public $DrinkId;
	function __construct($id)
	{
		$db_handle = new DB();
		if($id!="")
		{
			$sql = "SELECT * FROM beverages WHERE id=".$id;
			$product = mysqli_query($db_handle->connectDB(),$sql);
			if($row = mysqli_fetch_array($product))
			{
				$this->DrinkType=$row["DrinkType"];
				$this->DrinkId=$row["DrinkId"];
			}
		}
	}
	static function getbeverages()
	{
		$db_handle = new DB();
		$sql = "SELECT * FROM beverages";
		$categories = mysqli_query($db_handle->connectDB(),$sql);
		$count = 0;
		$beverages;
		while($row = mysqli_fetch_array($categories))
		{
			$beverage = new Beverage($row["id"]);
			$beverages[$count] = $product;
			$count++;
		}
		return $beverages;
	}
}
class Menu
{
	static function viewProducts()
	{
		$db_handle = new DB();
		$sql = "SELECT * FROM product";
		$products = mysqli_query($db_handle->connectDB(),$sql);
		$count = 0;
		$Products_array;
		while($row = mysqli_fetch_array($products))
		{
			$product = new Product($row["id"]);
			$Products_array[$count] = $product;
			$count++;
		}
		return $Products_array;
	}
	static function getCategories()
	{
		$beverages=Beverages::getbeverages();
		return $beverages;
	}
}


class Cart
{
	public $order;
	public $total_price;
	public $amount;
	
	protected $items = array();

	function __construct()
	{
		$this->order = array();
	}

	function addProduct($items)
	{		
		$id = $item->getId();
		// Throw an exception if there's no id:
		if (!$id) throw new Exception('The cart requires items with unique ID values.');
		// Add or update:
		if (isset($this->items[$id])) {
			$this->updateItem($item, $this->items[$item]['qty'] + 1);
		} else {
			$this->items[$id] = array('item' => $item, 'qty' => 1);
		}
	}

	public function updateItem(Item $item, $qty) {
		// Need the unique item id:
		$id = $item->getId();
		// Delete or update accordingly:
		if ($qty === 0) {
			$this->deleteItem($item);
		} elseif ( ($qty > 0) && ($qty != $this->items[$id]['qty'])) {
			$this->items[$id]['qty'] = $qty;
		}
	} // End of updateItem() method.

	public function deleteItem(Item $item) {
		$id = $item->getId();
		if (isset($this->items[$id])) {
				unset($this->items[$id]);
		}
	}
	function isEmpty(){
		return (empty($this->items));
	}
}

class order
{
	
}
?>