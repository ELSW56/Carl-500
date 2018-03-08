<?php 
/**
 * Feature name:  CARL 500 timeline-functions
 * Description:   Fonctions sur ou pour la timeline sur la page d'accueil
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 /* Last Modified: 2015-07-02 by ELSW
 * Object : function runs_timeline added to retreive all the information needed for the timeline at once from the DB 
*/

/**
*	@return all the run's drivers stored in the data base
*/
function get_all_drives(){
	$drive=new Drive();
	$result=$drive->get_drives();

	return $result;
}

/* function get_id_run_by_id_run_car($id_run_car){
	$id=$id_run_car;
	$drive_ok=0;
	$drive=new Drive();
	$all_drives=$drive->get_drives();
	foreach($all_drives as $a_drive){
		if($a_drive['id_run_car']==$id){
			$drive_ok=$a_drive;
		}
	}
	return $id_run=$drive_ok['id_run'];
}
 */
/**
*	
*/
function get_date_dep_run_timeline($a_run_driver){
	
	$id_run=$a_run_driver['id_run'];
	$result=0;
	if(!empty($id_run)){
		$way=new Way();
		$date_dep=$way->get_min_date_by_run_id($id_run);

		$date = new DateTime($date_dep);
		$date->modify('-1 month');
		$result= date_format($date, 'Y,m,d,H,i,s');
	}

	return $result;
}

/**
*	
*/
function get_date_arr_run_timeline($a_run_driver){
	$id_run=$a_run_driver['id_run'];
	if(!empty($id_run)){
		$way=new Way();
		$date_dep=$way->get_max_date_by_run_id($id_run);

		$date = new DateTime($date_dep);
		$date->modify('-1 month');
		$result= date_format($date, 'Y,m,d,H,i,s');
	}

	return $result;
}

/**
*	
*/
function get_name_run_timeline($a_drive){
	$id_run=$a_drive['id_run'];
	$run=new Run($id_run);
	$id_band=$run->get_id_band();	

	$band=new Band($id_band);
	$name=$band->get_band_name();
	return $name;
}

/**
*	
*/
function name_run_timeline($a_run_driver){
	echo get_name_run_timeline($a_run_driver);
}

/**
*	
*/
function get_driver_run_timeline($a_drive){
	$id_driver=$a_drive['id_driver'];
	$driver=new People($id_driver);
	$name_driver=$driver->get_full_name();
	
	return $name_driver;
}

/**
*	
*/
function get_car_run_timeline($a_car){
	$id_car=$a_car['id_car'];
	$car=new Car($id_car);
	$name_car=$car->get_manufacturer();
	$name_car.=' '.$car->get_model();

	return $name_car;
}

/**
*	
*/
function car_run_timeline($a_car){
	echo get_car_run_timeline($a_car);
}



/**
*	@return if the run is not checked by giving its id 
*/
function get_timeline_background($id_run){
	$run=new Run($id_run);
	$calle=$run->get_calle();
	$status=$run->get_status();

	if($calle==1){
		$ret='#9CFFAF';
	}
	else{
		$ret='#FF9C9C';
	}
	if($status==1){
		$ret='white';
	}

	return $ret;
}

/**
*	echo if the run is checked or not by giving its id 
*/
function timeline_background($id_run){
	echo get_timeline_background($id_run);
}

function get_start_timeline(){
	$min = new DateTime("01/31/2100");
	$day = new Day();
	$days=$day->get_days();	
	foreach ($days as $a_day){
		$the_day_parts = explode('-',$a_day['libelle']);
		$the_day = new DateTime($the_day_parts[1].'/'.$the_day_parts[2].'/'.$the_day_parts[0]);
		if ($the_day < $min) {
			$min = $the_day;
		}
	}	
	$min->modify('-1 month');
	return date_format($min, 'Y,m,d');
}

function start_timeline(){
	echo get_start_timeline();
}

function get_end_timeline(){
	$max = new DateTime("01/01/2000");
	$day = new Day();
	$days=$day->get_days();	
	foreach ($days as $a_day){
		$the_day_parts = explode('-',$a_day['libelle']);
		$the_day = new DateTime($the_day_parts[1].'/'.$the_day_parts[2].'/'.$the_day_parts[0]);
		if ($the_day > $max) {
			$max = $the_day;
		}
	}	
	$max->modify('-1 month');
	$max->modify('+1 day');
	return date_format($max, 'Y,m,d');
}

function runs_timeline () {
$run = new Run();
return $run->get_runs_for_timeline();
}
function end_timeline(){
	echo get_end_timeline();
}
?>