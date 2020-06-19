<?php

$dataPoints = array();
$dataPoints1 = array();
$dataPoints2 = array();
$dataPoints3= array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost; dbname=your_database_name; charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );

    $handle = $link->prepare('select sum(price) price,DATE_FORMAT(date, "%W") date from orders group by date having sum(price)>=1');
    $handle1=$link->prepare('select sum(quan) quan,DATE_FORMAT(date, "%W") date from torder group by date having sum(quan)>=1');
    $handle2 = $link->prepare('select name,sum(quan) as quan from torder GROUP by name HAVING quan>=1');
    $handle3 = $link->prepare('select sum(quan) as quan,DATE_FORMAT(date, "%M") date from torder GROUP by DATE_FORMAT(date, "%M") HAVING quan>=1');
    $handle->execute();
    $handle1->execute();
    $handle2->execute();
    $handle3->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    $result1=$handle1->fetchAll(\PDO::FETCH_OBJ);
    $result2=$handle2->fetchAll(\PDO::FETCH_OBJ);
    $result3=$handle3->fetchAll(\PDO::FETCH_OBJ);
    $dataPoints=array(array("y"=>0,"label" =>'Sunday'),array("y"=>0,"label" =>'Monday'),array("y"=>0,"label" =>'Tuesday'),array("y"=>0,"label" =>'Wednesday'),array("y"=>0,"label" =>'Thrusday'));
    array_push($dataPoints,array("y"=> 0,"label" => 'Friday'));
    array_push($dataPoints,array("y"=> 0,"label" => 'Saturday'));
    foreach($result as $row){
      for($i=0;$i<count($dataPoints);$i++){
        if($row->date==$dataPoints[$i]['label']){
            $dataPoints[$i]['y']=$row->price;
          }
        }
    }
    $dataPoints1=array(array("y"=>0,"label" =>'Sunday'),array("y"=>0,"label" =>'Monday'),array("y"=>0,"label" =>'Tuesday'),array("y"=>0,"label" =>'Wednesday'),array("y"=>0,"label" =>'Thrusday'));
    array_push($dataPoints1,array("y"=> 0,"label" => 'Friday'));
    array_push($dataPoints1,array("y"=> 0,"label" => 'Saturday'));
    foreach($result1 as $row){
      for($i=0;$i<count($dataPoints1);$i++){
        if($row->date==$dataPoints1[$i]['label']){
            $dataPoints1[$i]['y']=$row->quan;
          }
        }
    }

    foreach($result2 as $row){
      array_push($dataPoints2,array("y"=> $row->quan,"label" => $row->name));
}


$dataPoints3=array(array("y"=>0,"label" =>'January'),array("y"=>0,"label" =>'February'),array("y"=>0,"label" =>'March'),array("y"=>0,"label" =>'April'),array("y"=>0,"label" =>'May'),
array("y"=>0,"label" =>'June'),array("y"=>0,"label" =>'July'),array("y"=>0,"label" =>'August'),array("y"=>0,"label" =>'September'),array("y"=>0,"label" =>'October'));
array_push($dataPoints3,array("y"=> 0,"label" => 'November'));
array_push($dataPoints3,array("y"=> 0,"label" => 'December'));
foreach($result3 as $row){
  for($i=0;$i<count($dataPoints3);$i++){
    if($row->date==$dataPoints3[$i]['label']){
        $dataPoints3[$i]['y']=$row->quan;
      }
    }
}


	$link = null;
}


catch(\PDOException $ex){
    print($ex->getMessage());
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
<!--<div id="chartContainer5" style="width: 100%; height: 300px;display: inline-block;"></div>-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
