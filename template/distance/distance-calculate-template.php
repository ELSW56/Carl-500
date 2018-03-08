<?php 

if($_GET['type']=="date"){
	$location1 = get_location_id_by_name($_GET['location1']);
	$location2 = get_location_id_by_name($_GET['location2']);
	$time = get_distance($location1, $location2);
	$my_date = explode("/", $_GET['date']);
	$my_time = explode(":", $_GET['time']);
	$datetime = date_create($time);
	if($time != null){
		$time_hour = date_format($datetime, 'H');
		$time_min = date_format($datetime, 'i');

		$date = new DateTime($my_date[2].'-'.$my_date[1].'-'.$my_date[0].' '.$my_time[0].':'.$my_time[1]);
		$date->modify('+'.$time_hour.'hours');
		$date->modify('+'.$time_min.'minutes');
		
		echo date_format($date, "d/m/Y");
	}else{echo null;}	
}

if($_GET['type']=="time"){
	$location1 = get_location_id_by_name($_GET['location1']);
	$location2 = get_location_id_by_name($_GET['location2']);
	$time = get_distance($location1, $location2);
	$my_date = explode("/", $_GET['date']);
	$my_time = explode(":", $_GET['time']);
	$datetime = date_create($time);
	if($time != null){
		$time_hour = date_format($datetime, 'H');
		$time_min = date_format($datetime, 'i');

		$date = new DateTime($my_date[2].'-'.$my_date[1].'-'.$my_date[0].' '.$my_time[0].':'.$my_time[1]);
		$date->modify('+'.$time_hour.'hours');
		$date->modify('+'.$time_min.'minutes');
		
		echo date_format($date, "H:i");
	}else{echo null;}	
}

if($_GET['type']=="location2"){
	$location1 = get_location_id_by_name($_GET['location1']);
	$location2 = get_location_id_by_name($_GET['location2']);
	$time = get_distance($location1, $location2);
	$my_date = explode("/", $_GET['date']);
	$my_time = explode(":", $_GET['time']);
	$datetime = date_create($time);
	if($time != null){
		$time_hour = date_format($datetime, 'H');
		$time_min = date_format($datetime, 'i');

		$date = new DateTime($my_date[2].'-'.$my_date[1].'-'.$my_date[0].' '.$my_time[0].':'.$my_time[1]);
		$date->modify('+'.$time_hour.'hours');
		$date->modify('+'.$time_min.'minutes');
		
		echo date_format($date, "H:i");
	}else{echo null;}	
}

?>