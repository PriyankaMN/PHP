<?php

$dataPoints = array();
$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3= array();

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("localhost", "root", "", "your_database_name");
  $mysqli->set_charset("utf8mb4");

$stmt = $mysqli->prepare("select sum(price) price,DATE_FORMAT(date, '%W') date from orders group by date having sum(price)>=1");
$stmt1 = $mysqli->prepare("select sum(quan) quan,DATE_FORMAT(date, '%W') date from torder group by date having sum(quan)>=1");
$stmt2 = $mysqli->prepare("select name,sum(quan) as quan from torder GROUP by name HAVING quan>=1");
$stmt3 = $mysqli->prepare("select sum(quan) as quan,DATE_FORMAT(date, '%M') date from torder GROUP by DATE_FORMAT(date, '%M') HAVING quan>=1");

//$stmt->bind_param("si", $_POST['price'], $_SESSION['date']);
$stmt->execute();
$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr) exit('No rows');
//var_export($arr);
$dataPoints=array(array("y"=>0,"label" =>'Sunday'),array("y"=>0,"label" =>'Monday'),array("y"=>0,"label" =>'Tuesday'),array("y"=>0,"label" =>'Wednesday'),array("y"=>0,"label" =>'Thrusday'));
array_push($dataPoints,array("y"=> 0,"label" => 'Friday'));
array_push($dataPoints,array("y"=> 0,"label" => 'Saturday'));
foreach($arr as $row){
  for($i=0;$i<count($dataPoints);$i++){
    if($row['date']==$dataPoints[$i]['label']){
        $dataPoints[$i]['y']=$row['price'];
      }
    }
}

$stmt1->execute();
$arr1 = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr1) exit('No rows');
$dataPoints1=array(array("y"=>0,"label" =>'Sunday'),array("y"=>0,"label" =>'Monday'),array("y"=>0,"label" =>'Tuesday'),array("y"=>0,"label" =>'Wednesday'),array("y"=>0,"label" =>'Thrusday'));
array_push($dataPoints1,array("y"=> 0,"label" => 'Friday'));
array_push($dataPoints1,array("y"=> 0,"label" => 'Saturday'));
foreach($arr1 as $row){
  for($i=0;$i<count($dataPoints1);$i++){
    if($row['date']==$dataPoints1[$i]['label']){
        $dataPoints1[$i]['y']=$row['quan'];
      }
    }
}


$stmt2->execute();
$arr2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr2) exit('No rows');
foreach($arr2 as $row){
  array_push($dataPoints2,array("y"=> $row['quan'],"label" => $row['name']));
  }

  $stmt3->execute();
  $arr3 = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
  if(!$arr3) exit('No rows');
  $dataPoints3=array(array("y"=>0,"label" =>'January'),array("y"=>0,"label" =>'February'),array("y"=>0,"label" =>'March'),array("y"=>0,"label" =>'April'),array("y"=>0,"label" =>'May'),
  array("y"=>0,"label" =>'June'),array("y"=>0,"label" =>'July'),array("y"=>0,"label" =>'August'),array("y"=>0,"label" =>'September'),array("y"=>0,"label" =>'October'));
  array_push($dataPoints3,array("y"=> 0,"label" => 'November'));
  array_push($dataPoints3,array("y"=> 0,"label" => 'December'));
  foreach($arr3 as $row){
    for($i=0;$i<count($dataPoints3);$i++){
      if($row['date']==$dataPoints3[$i]['label']){
          $dataPoints3[$i]['y']=$row['quan'];
        }
      }
  }
}

catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Total Revenue"
	},
  axisY: {
    title: "Price",
    prefix: "Rs.",
    crosshair: {
			enabled: true,
			snapToDataPoint: true
		},
				labelFontSize: 20,
				labelFontColor: "dimGrey"
			},
      axisX: {
        title: "days",
        crosshair: {
			enabled: true,
			snapToDataPoint: true,
		},
				//labelAngle: -30
        labelFontColor: "dimGrey"
			},
	data: [{
		type: "line", //change type to bar, line, area, pie, column ,spline , stepLine etc
    //indexLabel: "{j}",
    color: "rgba(54,158,173,.9)",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "total orders"
	},
	axisY: {
		title: "Number of orders",
    crosshair: {
      enabled: true,
      snapToDataPoint: true
    },
        //labelFontSize: 20,
        labelFontColor: "dimGrey"
	},
  axisX: {
    title: "days",
    crosshair: {
      enabled: true,
      snapToDataPoint: true
    },
        //labelFontSize: 20,
        labelFontColor: "dimGrey"
  },
	data: [{
		type: "area",
    color: "rgba(54,158,173,.9)",
    //indexLabel: "{j}",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title:{
		text: "Food Orders"
	},
	axisY: {
		title: "Number of orders",
    labelFontColor: "dimGrey",
		//valueFormatString: "#0,,.",
		//suffix: "mn",
		//prefix: "Rs."
	},
  axisX: {
    title:"items",
    labelFontColor: "dimGrey"
  },
	data: [{
		type: "column",
		color: "rgba(54,158,173,.9)",
    //color: "rgba(54,15,17,.7)",
		markerSize: 5,
		//indexLabel: "{j}",
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();


var chart = new CanvasJS.Chart("chartContainer4", {
	animationEnabled: true,
  zoomEnabled: true,
      zoomType: "y",
	title:{
		text: "Monthly Orders"
	},
	axisY: {
		title: "Number of orders",
    labelFontColor: "dimGrey"
		//valueFormatString: "#0,,.",
		//suffix: "mn",
		//prefix: "Rs."
	},
  axisX: {
    title:"Month",
    labelFontColor: "dimGrey"
    //interval: 3,
   //intervalType: "month"
  // labelAngle: -50
  },
	data: [{
		type: "area",
    color: "rgba(54,158,173,.9)",
	//	markerSize: 5,
		//indexLabel: "{j}",
    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="width: 45%; height: 300px;display: inline-block;"></div>
<div id="chartContainer1" style="width: 45%; height: 300px;display: inline-block;"></div>
<div id="chartContainer3" style="width: 45%; height: 300px;display: inline-block;"></div>
<div id="chartContainer4" style="width: 45%; height: 300px;display: inline-block;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
