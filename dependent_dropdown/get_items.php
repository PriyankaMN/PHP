<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<body>
<?php
require_once("connectdb.php");
	$query ="SELECT * FROM items WHERE category_id = '" . $_POST["category_id"] . "'";
	$results = $dbhandle->query($query);
?>
	<option value="">Select items</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["id"]; ?>"><?php echo $rs["item"]; ?></option>
<?php

}
?>
</body>
</html>
