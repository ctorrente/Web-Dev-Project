<?php 
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'dcs_project';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$result = mysqli_query($db, "SELECT * FROM EVENT ORDER BY event_id DESC"); 
$events = array();
while($row = mysqli_fetch_array($result)) {
	if ($row['event_status'] == 0) {
		$events[] = array(
			"id"=>$row['event_id'],
			"title" => $row['event_title'],
			"desc" => $row['event_desc'],
			"start" => $row['event_start'],
			"end" => $row['event_end'],
			"color"=>$row['event_color'],
			"sub_by"=>$row['event_sub_by']
		);
	}
 }
echo json_encode($events);
?>