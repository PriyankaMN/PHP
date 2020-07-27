<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","ciboshop");

$msg=" ";
$dbhandle =new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die("Unable to connect to MySQL");
if ($dbhandle->connect_error) {
    die("Connection failed: " . $dbhandle->connect_error);
}
?>
<body>
</body>
</html>
