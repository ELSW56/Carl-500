<?php 
/**
 * Feature name:  CARL 500 run-functions
 * Description:   Fonctions sur ou pour les objets run
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/**
 * Get an array of run
 *
 * @param status and calle
 * @return array of run
 */
function get_runs($day=0,$status=0,$cale=0, $query=0){
	$runs=new Run();
	$result=$runs->get_runs($day, $status, $cale, $query);

	return $result;
}

/**
*	@return all the drives ids corresponding to a run by giving its id
*	optimized version
*/
function get_drives_by_id_run($id_run){
	$drive=new Drive();
	$all_drives=$drive->get_drives_by_run_id($id_run);
	if (count($all_drives)>0) {
		foreach($all_drives as $a_drive){
			$drive_ok[]=$a_drive['id'];
		}	
		return $drive_ok;
	}
}

/**
 * Get an array of date when they are runs
 *
 * @return array of date
 */
function get_runs_days(){
	$the_days=array();
	$ways=get_ways();
	$the_days[]=get_run_date_dep_by_run_id($ways[0]['id_run']);

	foreach(get_ways() as $a_way){
		$the_date=get_run_date_dep_by_run_id($a_way['id_run']);

		$new_date='false';
		foreach($the_days as $a_day){
			if($the_date==$a_day){
				$new_date='true';
			}	
		}
		if($new_date=='false'){
			$the_days[]=$the_date;
		}
	}
	asort($the_days);
	return $the_days;
}

function get_days() {
	$the_days=array();
	$day = new Day();
	$days=$day->get_days();
	foreach($days as $a_day) {
		$date = date_create($a_day['libelle']);
		$the_days[]=date_format($date, 'd/m/Y');
	}
	return $the_days;
}	

/**
 * Get an array of date when they are runs
 *
 * @return array of date
 */
function runs_days(){
	echo get_runs_days();
}
/**
 * Get the name of the class css
 *
 * @param $a_run
 * @return css class
 */
function get_run_class_css($a_run){
	if($a_run['calle']==1){
		$class_css='calles';
	}
	if($a_run['calle']==0){
		$class_css='non_calles';
	}
	if($a_run['status']==1){
		$class_css='termine';
	}
	return $class_css;
}

/**
 * Display the name of the class CSS (calle, non_calle, terminee)
 *
 * @param $a_run
 * @use get_run_class_css()
 */
function run_class_css($a_run){
	echo get_run_class_css($a_run);
}

/**
 * Get the name of the group
 *
 * @param $a_run
 * @return a name of group
 */
function get_run_name_group($a_run){
	$id_band=$a_run['id_band'];
	$band=new Band($id_band);
	$name=$band->get_band_name();
	return $name;
}

/**
 * Display the name of the group
 *
 * @param $a_run
 * @use get_run_name_group()
 */
function run_name_group($a_run){
	echo get_run_name_group($a_run);
}

/**
 * Get the date of depart of a run
 *
 * @param $a_run
 * @return date of depart
 */
function get_run_date_dep($a_run){
	$way=new Way();
	$date_dep=$way->get_min_date_by_run_id($a_run['id']);

	$date = date_create($date_dep);
	return date_format($date, 'd/m/Y');
}

/**
 * Display the date of depart of a run
 *
 * @param $a_run
 * @use get_run_date_dep()
 */
function run_date_dep($a_run){
	echo get_run_date_dep($a_run);
}

/**
 * Get the hour of depart of a run
 *
 * @param $a_run
 * @return hour of depart
 */
function get_run_hour_dep($a_run){
	$way=new Way();
	$date_dep=$way->get_min_date_by_run_id($a_run['id']);

	$date = date_create($date_dep);
	return date_format($date, 'H:i');
}

/**
 * Display the hour of depart of a run
 *
 * @param $a_run
 * @use get_run_hour_dep()
 */
function run_hour_dep($a_run){
	echo get_run_hour_dep($a_run);
}

/**
 * Get the location of depart of a run
 *
 * @param $a_run
 * @return location of depart
 */
function get_run_location_dep($a_run){
	return $location_dep;
}

/**
 * Display the location of depart of a run
 *
 * @param $a_run
 * @use get_run_location_dep()
 */
function run_location_dep($a_run){
	$way=new Way();
	$location_dep=$way->get_location_dep_by_run_id($a_run['id']);

	echo $location_dep;
}

/**
 * Get the hour of arrival of a run
 *
 * @param $a_run
 * @return hour of arrival
 */
function get_run_hour_arr($a_run){
	$way=new Way();
	$date_arr=$way->get_max_date_by_run_id($a_run['id']);

	$date = date_create($date_arr);
	return date_format($date, 'H:i');}

/**
 * Display the hour of arrival of a run
 *
 * @param $a_run
 * @use get_run_hour_arr()
 */
function run_hour_arr($a_run){
	echo get_run_hour_arr($a_run);
}

/**
 * Get the location of arrival of a run
 *
 * @param $a_run
 * @return location of arrival
 */
function get_run_location_arr($a_run){
	$way=new Way();
	$location_arr=$way->get_location_arr_by_run_id($a_run['id']);

	echo $location_arr;
}

/**
 * Display the location of arrival of a run
 *
 * @param $a_run
 * @use get_run_location_arr()
 */
function run_location_arr($a_run){
	echo get_run_location_arr($a_run);
}

/**
*	echo the name of the dep location by giving a run id
*/
function get_name_location_dep($a_run){
	$way= new Way();
	$location = new Location($way->get_location_dep_by_run_id($a_run['id']));
	echo $location->get_name();
}

/**
*	echo the name of the dep location by giving a run id
*/
function get_name_location_arr($a_run){
	$way= new Way();
	$location = new Location($way->get_location_arr_by_run_id($a_run['id']));
	echo $location->get_name();
}

/**
 * Get the number of person
 *
 * @param $a_run
 * @return number of person
 */
function get_run_number_person($a_run){
	$number_person=$a_run['nb_people'];
	return $number_person;
}

/**
 * Display the number of person
 *
 * @param $a_run
 * @use get_run_number_person()
 */
function run_number_person($a_run){
	echo get_run_number_person($a_run);
}

/**
 * Get the date of depart of a run
 *
 * @param $id_run
 * @return date of depart
 */
function get_run_date_dep_by_run_id($id_run){
	$way=new Way();
	$date_dep=$way->get_min_date_by_run_id($id_run);

	$date = date_create($date_dep);
	return date_format($date, 'd/m/Y');
}

/**
 * Display the date of depart of a run
 *
 * @param $id_run
 * @use get_run_date_dep()
 */
function run_date_dep_by_run_id($id_run){
	echo get_run_date_dep_by_run_id($id_run);
}

/**
* Return an init run
*/
function init_run($id_run_type, $company, $band, $nb_people, $status, $calle, $comments){
	$run = new Run();
	$run->init($id_run_type, $company, $band, $nb_people, $status, $calle, $comments);
	return $run;
}

/**
*	@return the band's name corresponding to the run by giving its id
*/
function get_run_band($id_run){
	$run=new Run($id_run);
	$id_band=$run->get_id_band();

	$band=new Band($id_band);
	$name=$band->get_band_name();

	return $name;
}

/**
*	echo the band's name corresponding to the run by giving its id
*/
function run_band($id_run){
	echo get_run_band($id_run);
}

/**
*	@return the company name corresponding to the run by giving its id
*/
function get_run_company($id_run){
	$run=new Run($id_run);
	$name_company=$run->get_name_company();

	return $name_company;
}

/**
*	echo the company name corresponding to the run by giving its id
*/
function run_company($id_run){
	echo get_run_company($id_run);
}

/**
*	@return the number of person for the run by giving its id
*/
function get_run_number_persons($id_run){
	$run=new Run($id_run);
	$number_persons=$run->get_number_persons();

	return $number_persons;
}

/**
*	echo the number of person for the run by giving its id
*/
function run_number_persons($id_run){
	echo get_run_number_persons($id_run);
}

/**
*	@return the comment of the run by giving its id
*/
function run_comments($id_run){
	$run=new Run($id_run);
	$comments=$run->get_comments();
	$nbligne = 1+ substr_count($comments,"\n");
	echo '<textarea name="comments" style="width:90%; height:'.($nbligne*20).'px" disabled="disabled">'.$comments.'</textarea>';
}
/**
*	@return the comment of the run to be modified by giving its id
*/
function run_comments_modify($id_run){
	$run=new Run($id_run);
	$comments=$run->get_comments();
	$nbligne = 1+ substr_count($comments,"\n");
	echo '<textarea name="comments" style="width:90%; height:'.($nbligne*20).'px">'.$comments.'</textarea>';
}

/**
*	echo the status of the run by giving its id
*/
function run_status($id_run){
	$run=new Run($id_run);
	$status=$run->get_status();

	if($status==1){
		echo '<div style="height: 25px; color: green; padding-left: 10px;"> <b>Terminé</b> </div>';
	}
	else{
		echo '<div style="height: 25px; color: red; padding-left: 10px;"> <b>Non terminé</b> </div>';
	}
}

/**
*	echo a new div which give if the run is "callé" or not by giving its id
*/
function run_calle($id_run){
	$run=new Run($id_run);
	$calle=$run->get_calle();

	if($calle==1){
		echo '<div style="height: 25px; color: green; padding-left: 10px;"> <b>Calé</b> </div>';
	}
	else{
		echo '<div style="height: 25px; color: red; padding-left: 10px;"> <b>Non Calé</b> </div>';
	}
}

/**
*	This function create an object run_car and initialize it
*	@return the run_car
*/
function init_drive($id_run, $id_car, $id_driver,$start,$end){
	$drive = new Drive();
	$drive->init($id_car, $id_run, $id_driver,$start,$end);
	return $drive;
}


/**
*	@return the run's driver of the run car by giving its id
*/
function get_run_driver_by_id($a_drive){
	$drive=new Drive($a_drive);
	$id_driver=$drive->get_id_driver();
	$driver=new People($id_driver);
	$name_driver=$driver->get_first_name().' '.$driver->get_last_name();
	
	return $name_driver;
}

/**
*	echo the run's driver of the run car by giving its id
*/
function run_driver($id_drive){
	echo get_run_driver_by_id($id_drive);
}

/**
*	@return the run's driver's last_name of the run car by giving its id
*/
function get_run_driver_last_name($id_drive){
	$run_car=new Run_car($id_drive);
    $id_driver=$run_car->get_id_driver();

	$driver=new People($id_driver);
	$name_driver=$driver->get_last_name();
	
	return $name_driver;
}

/**
*	echo the run's driver's last_name of the run car by giving its id
*/
function run_driver_last_name($id_run_car){
	echo get_run_driver_last_name($id_run_car);
}

/**
*	@return the run's driver's first_name of the run car by giving its id
*/
function get_run_driver_first_name($id_run_car){
	$run_car=new Run_car($id_run_car);
    $id_driver=$run_car->get_id_driver();

	$driver=new People($id_driver);
	$name_driver=$driver->get_first_name();
	
	return $name_driver;
}

/**
*	echo the run's driver's first_name of the run car by giving its id
*/
function run_driver_first_name($a_drive){
	echo get_run_driver_first_name($a_drive);
}

/**
*	@return the car of the drive by giving its id
*/
function get_run_car_by_id($id_drive){
	$drive=new Drive($id_drive);
    $id_car=$drive->get_id_car();

	$car=new Car($id_car);
	$name_car=$car->get_manufacturer();
	$name_car.=' '.$car->get_model();

	return $name_car;
}

function run_car($id_drive){
	echo get_run_car_by_id($id_drive);
}


/**
*	@return if the run is checked by giving its id 
*/
function get_checked_run_calle($id_run){
	$run=new Run($id_run);
	$calle=$run->get_calle();

	if($calle==1){
		$ret='checked';
	}
	else{
		$ret=' ';
	}
	return $ret;
}

/**
*	echo if the run is checked by giving its id 
*/
function checked_run_calle($id_run){
	echo get_checked_run_calle($id_run);
}

/**
*	@return if the run is not checked by giving its id 
*/
function get_checked_run_non_calle($id_run){
	$run=new Run($id_run);
	$calle=$run->get_calle();

	if($calle==1){
		$ret=' ';
	}
	else{
		$ret='checked';
	}
	return $ret;
}

/**
*	echo if the run is not checked or not by giving its id 
*/
function checked_run_non_calle($id_run){
	echo get_checked_run_non_calle($id_run);
}

/**
*	@return the status of the run by giving its id
*/
function get_run_checked_status($id_run){
	$run=new Run($id_run);
	$status=$run->get_status();

	if($status==1){
		$ret='checked';
	}
	else{
		$ret='';
	}
	return $ret;
}

/**
*	echo the status of the run by giving its id
*/
function run_checked_status($id_run){
	echo get_run_checked_status($id_run);
}

/**
*	@return all the car's id of the run_car by giving its id
*/
function get_run_car_id($id_run_car){
	$run_car=new Run_car($id_run_car);
    $id_car=$run_car->get_id_car();

	return $id_car;
}


/**
* 	This function modify the run corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the run
*/
function modif_the_run($id_run, $id_run_type, $company, $band, $nb_people, $status, $calle, $comments){
	$run = new Run($id_run);
	$run->set_id_run_type($id_run_type);
	$run->set_id_company($company);
	$run->set_id_band($band);
	$run->set_number_persons($nb_people);
	$run->set_status($status);
	$run->set_calle($calle);
	$run->set_comments($comments);
	return $run;
}

/**
* 	This function modify the run_car corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the run_car
*/
function modif_run_car($id_run_car, $id_location, $id_band, $id_car, $id_driver){
	$run_car = new Run_car($id_run_car);
	$run_car->set_id_run_type($id_location);
	$run_car->set_company($id_band);
	$run_car->set_band($id_car);
	$run_car->set_nb_people($id_driver);
	return $run_car;
}

/**
*	@return the drive corresponding to a run by giving its id
*/
function get_drive_by_run_id($id_run){
	$drive=new Drive();
	$all_drives=$drive->get_drives();
	if (count($all_drives)>0) {
		foreach($all_drives as $a_drive){
			if($a_drive['id_run']==$id_run){
				$drive_ok=$a_drive['id'];
			}
		}
		return $drive_ok;
	}
	else {
		return 0;
	}
}


function get_run_by_drive_id($id_drive){
	$drive = New Drive($id_drive);
	$run = $drive->get_id_run();
	// foreach($all_drives as $a_drive){
		// $expl=explode ( ',' ,$a_drive['id_run_car'] );
		// $run=explode ( ',' ,$a_drive['id_run'] );

		// foreach($expl as $a){
			// if($a==$id_run_car){
				// $drive_ok=$run;
			
			// }
		// }
	// }	
	return $run;
//MODIFIER LES NOM DES VARIABLES
}

/**
* 	This function modify the drive corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the drive
*/
function modif_the_drive($id_drive, $id_car, $id_run, $id_driver){
	$drive = new Drive($id_drive);
	$drive->set_id_car($id_car);
	$drive->set_id_run($id_run);
	$drive->set_id_driver($id_driver);
	return $drive;
}

function update_run($id,$calle){
	$run=new Run($id);
	$run->set_calle($calle);
	$run->save();
}

function run_checked_calle($a_run){
	if($a_run['calle']==1){
		$class_css='checked="checked"';
	}
	if($a_run['calle']==0){
		$class_css='';
	}
	echo $class_css;
}


function get_unavailable_drivers($date1, $date2){
	$way = new Way();

	$people = new People();
	$drivers = get_peoples_drivers();

	// foreach($peoples as $id_driver){
		// $a_driver = new People($id_driver[id]);
		// if($a_driver->get_id_people_type() == 4){
			// $drivers[] = $a_driver;
		// }
	// }
	foreach($drivers as $driver){ //pour chaque chauffeur
		foreach($people->get_drive_ids_by_driver_id($driver[id]) as $drive){ //pour chaque drive du chauffeur
			$id_run = get_run_by_drive_id($drive[id]); // on récupère l'identifiant du run
			if($id_run != null){
				$min_date = new DateTime($way->get_min_date_by_run_id($id_run));
				$min_date = date_format($min_date, 'd/m/Y H:i:s');
				$max_date = new DateTime($way->get_max_date_by_run_id($id_run));
				$max_date = date_format($max_date, 'd/m/Y H:i:s');
				if(!(($date1 < $min_date && $date2 <= $min_date) || ($date1 >= $max_date && $date2 > $max_date))){
					if(empty($unv_drivers) || !test_id_already_exists($unv_drivers, $driver[id])){
						$unv_drivers[] = $driver[id];
						break 1;
					}
				}
			}	
		}
	}
		$indisponibilities = get_indisponibilities(0);

		foreach($indisponibilities as $indispo){
			$ind = new Indisponibility($indispo[id]);
			$min_date = new DateTime($ind->get_begin_date());
			$min_date = date_format($min_date, 'd/m/Y H:i:s');
			$max_date = new DateTime($ind->get_end_date());
			$max_date = date_format($max_date, 'd/m/Y H:i:s');

			if(!(($date1 < $min_date && $date2 <= $min_date) || ($date1 >= $max_date && $date2 > $max_date))){
				if(empty($unv_drivers) || !test_id_already_exists($unv_drivers, $ind->get_id_item())){
					$unv_drivers[] = $ind->get_id_item();
				}
			}


		}
	return $unv_drivers;
}

function get_unavailable_drivers_v1($date1, $date2){
	$way0 = New Way();
	$ways = $way0->get_ways();

	foreach($ways as $way){
		$dep = $way->get_date_depart();
		$dep = date_format($dep, 'd/m/Y H:i:s');
		$arr = $way->get_date_arrivee();
		$arr = date_format($arr, 'd/m/Y H:i:s');
		if(!(($date1 < $dep && $date2 <= $dep) || ($date1>=$arr && $date2 > $arr))){
			if(empty($runs) || !test_id_already_exists($runs, $way->get_id_run())){
				$runs[] = $way->get_id_run();
			}
		}
	}
	foreach($runs as $run_id){
		$drives = get_drives_by_id_run($run_id);
		foreach($drives as $drive_id){
			$drive = New Drive($drive_id);
				if(empty($unv_drivers) || !test_id_already_exists($unv_drivers, $drive->get_id())){
					$unv_drivers[] = $drive->get_id_driver();
				}
			}	
	}

	$indisponibilities = get_indisponibilities(0);
		foreach($indisponibilities as $indispo){
			$ind = new Indisponibility($indispo[id]);
			$min_date = new DateTime($ind->get_begin_date());
			$min_date = date_format($min_date, 'd/m/Y H:i:s');
			$max_date = new DateTime($ind->get_end_date());
			$max_date = date_format($max_date, 'd/m/Y H:i:s');

			if(!(($date1 < $min_date && $date2 <= $min_date) || ($date1 >= $max_date && $date2 > $max_date))){
				if(empty($unv_drivers) || !test_id_already_exists($unv_drivers, $ind->get_id_item())){
					$unv_drivers[] = $ind->get_id_item();
				}
			}
		}
	return $unv_drivers;
}

function get_unavailable_cars($date1, $date2){
	$way = new Way();

	$_car = new Car();
	$_cars = get_cars();

	$drive=new Drive();
	$all_drives=$drive->get_drives();

	$indisponibilities = get_indisponibilities(1);

	foreach($_cars as $id_car){
		$a_car = new Car($id_car[id]);
		$cars[] = $a_car;
	}
	foreach($cars as $car){
		$run_cars=$_car->get_run_car_by_id_car($car->get_id());
		if(!empty($run_cars)){
			foreach($run_cars as $run_car){
				$id_run = get_run_by_drive_id($run_car[id]);
				if($id_run[0] != null){
					$min_date = new DateTime($way->get_min_date_by_run_id($id_run[0]));
					$min_date = date_format($min_date, 'd/m/Y H:i:s');
					$max_date = new DateTime($way->get_max_date_by_run_id($id_run[0]));
					$max_date = date_format($max_date, 'd/m/Y H:i:s');
					if(!(($date1 < $min_date && $date2 <= $min_date) || ($date1 >= $max_date && $date2 > $max_date))){
						if(empty($unv_cars) || !test_id_already_exists($unv_cars, $car->get_id())){
							$unv_cars[] = $car->get_id();
						}
					}
				}	
			}
			foreach($indisponibilities as $indispo){
				$ind = new Indisponibility($indispo[id]);
				$min_date = new DateTime($ind->get_begin_date());
				$min_date = date_format($min_date, 'd/m/Y H:i:s');
				$max_date = new DateTime($ind->get_end_date());
				$max_date = date_format($max_date, 'd/m/Y H:i:s');

				if(!(($date1 < $min_date && $date2 <= $min_date) || ($date1 >= $max_date && $date2 > $max_date))){
					if(empty($unv_cars) || !test_id_already_exists($unv_cars, $ind->get_id_item())){
						$unv_cars[] = $ind->get_id_item();
					}
				}

			}
		}
	}
	return $unv_cars;
}

function test_id_already_exists($array, $id){
	$verif = false;
	foreach($array as $row){
		if($id == $row){
			$verif = true;
			break;
		}
	}
	return $verif;
}



function get_available_drivers($unavailable){

	$drivers=get_peoples_drivers();

	foreach($drivers as $a_driver){
		$is_avai=true;
		if(!empty($unavailable)){
			foreach($unavailable as $a_unavailable){
				if($a_driver[id]==$a_unavailable){
					$is_avai=false;
				}
			}
		}
		if($is_avai){
			$available[]=$a_driver;
		}
	}
	return $available;
}

function get_available_cars($unavailable){

	$cars=get_cars();

	foreach($cars as $a_car){
		$is_unavai=false;
		if(!empty($unavailable)){
			foreach($unavailable as $a_unavailable){
				if($a_car[id]==$a_unavailable){
					$is_unavai=true;
				}
			}
		}
		if(!$is_unavai){
			$available[]=$a_car;
		}
	}
	return $available;
}

function run_date_dep_timeline($a_run_id){
	$way=new Way();
	$date_dep=$way->get_min_date_by_run_id($a_run_id);

	$date = date_create($date_dep);
	echo date_format($date, 'd/m/Y');
}

function run_hour_dep_timeline($a_run_id){
	$way=new Way();
	$date_dep=$way->get_min_date_by_run_id($a_run_id);

	$date = date_create($date_dep);
	echo date_format($date, 'H:i');
}

function run_hour_arr_timeline($a_run_id){
	$way=new Way();
	$date_arr=$way->get_max_date_by_run_id($a_run_id);

	$date = date_create($date_arr);
	echo date_format($date, 'H:i');
}

function run_destination_timeline($a_run_id){
	$way=new Way();
	$destinations=$way->get_ways_by_id_run($a_run_id);
	$i=0;
	$loc="";
	foreach ($destinations as $dest)
	{
		if ($i==0) {
			$fleche = ""; 
			$i=1;
		}  else {
			$fleche = " &rarr; ";
		}
		$loc=$loc.$fleche.get_location_name_by_id($dest['id_location_depart']);
	}
	echo $loc.$fleche.get_location_name_by_id($dest['id_location_arrivee']);
}

function update_drive ($item_id, $groupe, $type, $start, $end) {
	$drive = New Drive($item_id);
	if ($type==0) {
		$theDriver = $drive->get_id_driver();
		if ($theDriver == $groupe) {
			// On reste sur le même chauffeur : on va alors changer l'horaire
			$drive->set_start($start);
			$drive->set_end($end);
		}
		else {
			// Il s'agit d'un changement de chauffeur : on n'accepte pas de changement d'horaire simultané
			$drive->set_id_driver($groupe);
		}
	} else {
		$theCar = $drive->get_id_car();
		if ($theCar == $groupe) {
			// On reste sur le même véhicule : on va alors changer l'horaire
			$drive->set_start($start);
			$drive->set_end($end);
		}
		else {
			// Il s'agit d'un changement de véhicule : on n'accepte pas de changement d'horaire simultané
			$drive->set_id_car($groupe);
		}
	}
	$drive->save();
}

function delete_a_drive ($id) {
	$drive = New Drive($id);
	$drive->delete();
}

function drive_mark_finished ($id) {
	$drive = New Drive($id);
	$drive->set_status(1);
	$drive->save();
}
?>
