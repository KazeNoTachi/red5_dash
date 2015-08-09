<?php


$x_event=$_POST['x_event'];
$x_sname=$_POST['x_sname'];
$ip=$_POST['ip'];
$timestamp=$_POST['timestamp'];
$cs_bytes=$_POST['cs_bytes'];
$sc_bytes=$_POST['sc_bytes'];
$city_name=$_POST['city_name'];
$region_name=$_POST['region_name'];
$country_name=$_POST['country_name'];



$link = mysqli_connect('localhost', 'root', '4rfv5tgb','logstash');

if (!$link) {
    die('Could not connect: ' . mysql_error());
}



if ($x_event == "play"){
	$r = mysqli_query($link,"SELECT ip FROM logStash_clients WHERE ip = '$ip'");

	if(mysqli_num_rows($r)){
	}
	else{
		mysqli_query($link,"INSERT INTO logStash_clients(ip,city_name,region_name,country_name) VALUES ('$ip','$city_name','$region_name','$country_name')");
	}

		mysqli_query($link,"INSERT INTO logStash_sessions(ip,starttime,x_sname,connected) VALUES ('$ip','$timestamp','$x_sname','Y')");

}


if ($x_event == "stop"){
	mysqli_query($link,"UPDATE logStash_sessions SET endtime='$timestamp', cs_bytes=$cs_bytes, sc_bytes=$sc_bytes, connected='N' WHERE x_sname='$x_sname'");

}

if ($x_event == "publish"){

mysqli_query($link,"INSERT INTO logStash_streams(x_sname, starttime ) VALUES ('$x_sname', '$timestamp')");

}

if ($x_event == "unpublish"){

mysqli_query($link,"UPDATE logStash_streams SET endtime='$timestamp', cs_bytes=$cs_bytes, sc_bytes=$sc_bytes WHERE x_sname='$x_sname'");

}


mysqli_close($link);
 

?>
