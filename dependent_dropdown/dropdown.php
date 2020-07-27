<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head><?php include "connectdb.php";

$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $mysqli = new mysqli("localhost", "root", "", "ciboshop");
    $mysqli->set_charset("utf8mb4");
    $stmt = $mysqli->prepare("select * from categories");
    $stmt->execute();
    $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

foreach($arr as $row){
  array_push($dataPoints, array("x"=> $row['cat_id'], "y"=> $row['numofitems']));
    }
}
catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}
?>
<script>
function getItem(val) {
	$.ajax({
	type: "POST",
	url: "get_items.php",
	data:'category_id='+val,
	success: function(data){
		$("#items-list").html(data);
	}
	});
}

function showMsg()
{

	$("#msgC").html($("#category-list option:selected").text());
	$("#msgS").html($("#items-list option:selected").text());
	return false;
}
</script>
<body >
	<form>
	<label style="font-size:20px" >category:</label>
		<select name="country" id="category-list" class="demoInputBox"  onChange="getItem(this.value);">
		<option value="">Select category</option>
		<?php
		$sql1="SELECT * FROM categories";
         $results=$dbhandle->query($sql1);
		while($rs=$results->fetch_assoc()) {
		?>
		<option value="<?php echo $rs["cat_id"]; ?>"><?php echo $rs["categoryname"]; ?></option>
		<?php
		}
		?>
		</select>


		<label style="font-size:20px" >item:</label>
		<select id="items-list" name="state"  >
		<option value="">Select items</option>
		</select>
		<button value="submit" onclick="return showMsg()">Submit</button>
	</form>

		Selected category: <span id="msgC"></span><br>
		Selected item:  <span id="msgS"></span>
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
