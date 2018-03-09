<?php
/**
 * Feature name:  CARL 500 check-functions
 * Description:   Fonctions de traitement des données envoyés par les formulaires et création/modification/sauvegarde des objets de classes
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

	//VERIF FUNCTIONS

	/**
	*	This fonction tests the array
	*	@return : false if one of the row is empty, true if there is no empty row
	*/
	function verif_arrays($the_array){

		$verif = true;
		foreach ($the_array as $row) {
			$verif = verif_var($row);
			if($verif == false){
				return false;
				break;
			}
		}
		return $verif;
	}

	/**
	*	This fonction tests any var
	*	@return : false if it is empty, true if it is not
	*/
	function verif_var($var){
		if(empty($var)){
			return false;
		}
		else{
			return true;
		}
	}

	/**
	*	This fonction tests the registration number
	*	@return : false if it is empty, true if it is not
	*/
	function verif_immat($immat){
		if(verif_var($immat)){
			$all_immats = select_all_immats();
			foreach($all_immats as $an_immat){
				if($an_immat == $immat){
					header("Location: /carl500/?page=car&action=add&error=immat");
					exit;
				}
			}
		}
		return true;
	}

	/**
	*	This fonction tests all the needed var to create a run
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_run($band, $company, $nb_people){
		$final_verif = true;

		$verifs[0] = verif_var($band);
		$verifs[1] = verif_var($company);
		$verifs[2] = verif_var($nb_people);

		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}

	/**
	*	This fonction tests all the needed var to create a band
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_band($group_name, $number_persons){
		
		$final_verif = true;

		$verifs[0] = verif_var($group_name);
		$verifs[1] = verif_var($number_persons);


		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}

	/**
	*	This fonction tests all the needed var to create a car
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_car($type, $immat, $manufacturer, $model, $capacity, $color){
		
		$final_verif = true;

		$verifs[0] = verif_var($type);
		$verifs[1] = verif_immat($immat);
		$verifs[2] = verif_var($manufacturer);
		$verifs[3] = verif_var($model);
		$verifs[4] = verif_var($capacity);
		$verifs[4] = verif_var($color);


		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}

	/**
	*	THIS FUNCTION IS NOT USED YET
	*	This fonction tests all the needed var to create a driver
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_driver($gender, $last_name, $first_name){
		
		$final_verif = true;

		$verifs[0] = verif_var($gender);
		$verifs[1] = verif_var($last_name);
		$verifs[2] = verif_var($first_name);

		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}

	/**
	*	This fonction tests all the needed var to create a distance
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_distance($location1, $location2, $distance, $time){
		
		$final_verif = true;

		$verifs[0] = verif_var($location1);
		$verifs[1] = verif_var($location2);
		$verifs[2] = verif_var($distance);
		$verifs[3] = verif_var($time);

		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}

	/**
	*	This fonction tests all the needed var to create a location
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_location($type, $name, $adress, $town){
		
		$final_verif = true;

		$verifs[0] = verif_var($type);
		$verifs[1] = verif_var($name);
		$verifs[2] = verif_var($adress);
		$verifs[3] = verif_var($town);

		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}


	/**
	*	This fonction tests all the needed var to create a people
	*	@return : false if one of them is missed, true if not
	*/
	function verif_variables_people($type, $gender, $last_name, $first_name){
		
		$final_verif = true;

		$verifs[0] = verif_var($type);
		$verifs[1] = verif_var($gender);
		$verifs[2] = verif_var($last_name);
		$verifs[3] = verif_var($first_name);

		foreach($verifs as $verif){
			if($verif == false){
				$final_verif = false;
				break;
			}
		}
		return $final_verif;
	}



	//INIT FUNCTIONS

	/**
	*	This function initialize the comment if it was empty
	*	@return the comment initialized
	*/
	function init_comment($comments){
		if(empty($comments)){
			$comments="Pas de commentaire";
		}
		return $comments;
	}

	/**
	*	This fonction create a date object by assiociate a date to a hour 
	*	@return : the date with the format AAAA-MM-DD HH:II:SS
	*/
	function create_date($date, $time){
		if(!empty($date) && !empty($time)){
			$my_date = explode("/", $date);
			$my_time = explode(":", $time);
			$my_date[0] = substr($my_date[0], strlen($my_date[0])-2, 2);
			$the_date = new DateTime($my_date[2].'-'.$my_date[1].'-'.$my_date[0].' '.$my_time[0].':'.$my_time[1]);
			return date_format($the_date, 'Y-m-d H:i:s');
		}
		else{
			return null;
		}
		
	}




	//SAVE FUNCTION

	/**
	*	This fonction create a run and save it
	*	@return : the run
	*/
	function save_run($id_run_type, $company, $band, $nb_people, $status, $calle, $comments){
		$run = init_run($id_run_type, $company, $band, $nb_people, $status, $calle, $comments);
		if($run->get_status()==1){
			$run->set_calle(1);
		}
		$run->save();
		return $run;
	}

	/**
	*	This fonction initialized all the run_car and create them
	*	@return : the run cars
	*/
	function create_all_drives($run, $d_date, $d_time, $a_date, $a_time, $nbDrives){
		$start = create_date($d_date, $d_time);
		$end = create_date($a_date, $a_time);

		for($i=0; $i<$nbDrives; $i++){
			$drives[$i] = init_drive($run, 0, 0, $start, $end);
		}
		save_drives($drives);
	}

	/**
	*	This function saves all the run_car and return ids in a list
	*	Check if the run car already has an id. If it doesn't, the function pick the maximum id in the data base.
	*	This id is stocked in the list returned.
	*	@return : an array of all run cars' id
	*/
	function save_drives($drives){
		$all_id = "";
		for($i=0;$i<count($drives);$i++){
			if($drives[$i]->get_id() != null){
				$id = $drives[$i]->get_id();
				$drives[$i]->save();
			}
			else{
				//$id --;
				$drives[$i]->save();
				$id = $drives[$i]->get_pdo()->lastInsertId();
			}

			if((count($drives)-1)>$i){
				$all_id .= $id.",";
			}
			else{
				$all_id .= $id."";
			}	
		}
		return $all_id;
	}
	
	/**
	*	This fonction create all way and save them
	*/
	function save_way($departures, $arrivals, $d_dates, $d_times, $a_dates, $a_times, $id_run){
		for($i=0; $i<count($d_dates); $i++){
			$id_departure = $departures[$i];
			$id_arrival = $arrivals[$i];
			$date_departure = create_date($d_dates[$i], $d_times[$i]);
			$date_arrival = create_date($a_dates[$i], $a_times[$i]);

			$way = init_way($id_departure, $id_arrival, $date_departure, $date_arrival, $id_run);

			$way->save();
		}
	}

	/**
	*	This fonction create a band and save it
	*	@return : the band
	*/
	function save_band($group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments){
		$band= init_band($group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments);
		$band->save();
		return $band;
	}

	/**
	*	This fonction create a car and save it
	*	@return : the car
	*/
	function save_car($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments){
		$car= init_car($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);
		$car->save();
		return $car;
	}

	/**
	*	THIS FUNCTION IS NOT USED YET
	*	This fonction create a driver and save it
	*	@return : the run
	*/
	function save_driver($gender, $last_name, $first_name, $phone, $email){
		$driver= init_driver($gender, $last_name, $first_name, $phone, $email);
		$driver->save();
		return $driver;
	}

	/**
	*	This fonction create a location and save it
	*	@return : the location
	*/
	function save_location($name, $type, $adress, $town, $zip, $country, $phone, $fax, $web){
		$location= init_location($name, $type, $adress, $town, $zip, $country, $phone, $fax, $web);
		$location->save();
		return $location;
	}

	/**
	*	This fonction create a people and save it
	*	@return : the people
	*/
	function save_people($id_people_type, $gender, $last_name, $first_name, $phone, $email){
		$people= init_people($id_people_type, $gender, $last_name, $first_name, $phone, $email);
		$people->save();
		return $people;
	}

	/**
	*	This fonction create a drive and save it
	*	@return : the drive
	*/
	function save_drive($id_run_car, $id_run){
		$drive = init_drive($id_run_car, $id_run);
		$drive->save();
		return $drive;
	}

	/**
	*	This fonction create a distance and save it
	*	@return : the distance
	*/
	function save_distance($location1, $location2, $the_distance, $time){
		$distance = init_distance($location1, $location2, $the_distance, $time);
		$distance->save();
		return $distance;
	}



	//MODIF FUNCTION

	/**
	*	This fonction modify the run corresponding to the id in parameters and update it whith the new values
	*	@return : the run
	*/
	function modif_run($id_run, $id_run_type, $company, $band, $nb_people, $status, $calle, $comments){
		$run = modif_the_run($id_run, $id_run_type, $company, $band, $nb_people, $status, $calle, $comments);
		if($run->get_status()==1){
			$run->set_calle(1);
		}
		$run->save();
		return $run;
	}


	/**
	*	This function modifies the drives corresponding to the ids in parameters and updates it with the new values
	*	Check if the drive already has an id to recreate it. If it doesn't, the function creates a new drive and initializes it.
	*	@return : the drive
	*/
	function modif_all_drives($all_drives, $id_run, $cars, $drivers){
		$boucle = count($cars);
		if (count($drivers)>$boucle) {$boucle=count($drivers);}
		for($i=0;$i<$boucle;$i++){
			if(!empty($all_drives[$i])){
				$drives[$i] = new Drive($all_drives[$i]);
				$drives[$i]->set_id_run($id_run);
				$drives[$i]->set_id_car($cars[$i]);
				$drives[$i]->set_id_driver($drivers[$i]);	
			}
			else{
				$drives[$i] = new Drive();
				$drives[$i]->init($cars[$i], $id_run, $drivers[$i]);
			}
		}
		if ($boucle<count($all_drives)) {
			for ($i=$boucle;$i<count($all_drives);$i++) {
				$deleted_drive=new Drive($all_drives[$i]);
				$deleted_drive->delete();
			}
		}
		
		save_drives($drives);
	}

	/**
	*	This function modifies the drive corresponding to the id in parameters and updates it with the new values
	*	@return : the drive
	*/
	function modif_drive($id_drive, $id_car, $id_run, $id_driver){
		$drive = modif_the_drive($id_drive, $id_car, $id_run, $id_driver);
		$drive->save();
		return $drive;
	}

	/**
	*	This fonction modify all the way corresponding to the ids in parameters and update them whith the new values
	*	Check if the way car already has an id to recreate it. If it doesn't, the function create a new way and initialize it.
	*/
	function modif_way($ways_id, $departures, $arrivals, $d_dates, $d_times, $a_dates, $a_times, $id_run){
		for($i=0;$i<count($departures);$i++){
			$date_departure = create_date($d_dates[$i], $d_times[$i]);
			$date_arrival = create_date($a_dates[$i], $a_times[$i]);
			if(!empty($ways_id[$i])){
				$ways[$i] = new Way($ways_id[$i]);
				$ways[$i]->set_id_location_depart($departures[$i]);
				$ways[$i]->set_id_location_arrivee($arrivals[$i]);
				$ways[$i]->set_date_heure_depart($date_departure);
				$ways[$i]->set_date_heure_arrivee($date_arrival);
				$ways[$i]->set_id_run($id_run);
				$ways[$i]->save();
			}
			else{
				$ways[$i] = new Way();
				$ways[$i]->init($departures[$i], $arrivals[$i], $date_departure, $date_arrival, $id_run);
				$ways[$i]->save();
			}
		}
	}

	/**
	*	This fonction modify the band corresponding to the id in parameters and update it whith the new values
	*	@return : the band
	*/
	function modif_band($id, $group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments){
		$band= modif_the_band($id, $group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments);
		$band->save();
		return $band;
	}

	/**
	*	This fonction modify the car corresponding to the id in parameters and update it whith the new values
	*	@return : the car
	*/
	function modif_car($id, $type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments){
		$car= modif_the_car($id, $type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);
		$car->save();
		return $car;
	}

	/**
	*	This fonction modify the location corresponding to the id in parameters and update it with the new values
	*	@return : the location
	*/
	function modif_a_location($id, $type, $name, $adress, $town, $zip, $country, $phone, $fax, $web){
		$location= modif_the_location($id, $type, $name, $adress, $town, $zip, $country, $phone, $fax, $web);
		$location->save();
		return $location;
	}

	/**
	*	This fonction modify the people corresponding to the id in parameters and update it whith the new values
	*	@return : the people
	*/
	function modif_people($id, $id_people_type, $gender, $last_name, $first_name, $phone, $email){
		$people= modif_the_people($id, $id_people_type, $gender, $last_name, $first_name, $phone, $email);
		$people->save();
		return $people;
	}

	/**
	*	This fonction modify the distance and corresponding to the id in parameters and update it whith the new values
	*	@return : the distance
	*/
	function modif_distance($id, $location1, $location2, $the_distance, $time){
		$distance = modif_the_distance($id, $location1, $location2, $the_distance, $time);
		$distance->save();
		return $distance;
	}

	//DELETE FUNCTIONS

	/**
	*	This function delete the way corresponding to the id in parameters
	*/
	function delete_ways($ways_id){
		foreach($ways_id as $way){
			delete_way($way);
		}
	}

	/**
	*	This function delete the drive corresponding to the id in parameters
	*/
	function delete_drive($id_drive){
		if (!empty($id_drive)) {
			foreach ($id_drive as $id) {
				$drive = new Drive($id);
				$drive->delete();
			}
		}
	}

	/**
	*	This function delete the run_car corresponding to the id in parameters
	*/
	function delete_run_car($all_run_car){
		foreach($all_run_car as $id){
			$run_car = new Run_car($id);
			$run_car->delete();
		}
	}

	/**
	*	This function delete the run corresponding to the id in parameters
	*/
	function delete_run($id_run){
		$run = new Run($id_run);
		$run->delete();
	}

	/**
	*	This function is the main function used to delete the run.
	*	It called the others delete functions in the order for foreign keys of the data base
	*/
	function delete_run_by_id($id_run){
		$id_drive = get_drives_by_id_run($id_run);
		//$id_drive = get_drive_by_run_id($id_run);
		$ways_id = get_id_way_by_id_run($id_run);

		delete_ways($ways_id);
		delete_drive($id_drive);
		//delete_run_car($all_run_car);
		delete_run($id_run);
	}

	/**
	*	This function is the main function used to delete the car.
	*/
	function delete_car_by_id($id_car){
		$car = new Car($id_car);
		$car->delete();
	}

	/**
	*	This function is the main function used to delete the band.
	*/
	function delete_band_by_id($id_band){
		$band = new Band($id_band);
		$band->delete();
	}

	/**
	*	This function is the main function used to delete the people.
	*/
	function delete_people_by_id($id_people){
		$people = new People($id_people);
		$people->delete();
	}


	/**
	*	This function is the main function used to delete the location.
	*/
	function delete_location_by_id($id_location){
		$location = new Location($id_location);
		$location->delete();
	}

	/**
	*	This function is the main function used to delete the distance
	*/
	function delete_distance_by_id($id_distance){
		$distance = new Distance($id_distance);
		$distance->delete();
	}

	//GETTERS

	/**
	*	This function returns the id of a location found with its name
	*	@return the id
	*/
	function get_the_id_location_by_name($name){
		$location = new Location();
		$id=$location->get_id_location_by_name($name);
		return $id['id'];
	}

	/**
	*	This function returns the id of a band found with its name
	*	@return the id
	*/
	function get_the_id_band_by_name($name){
		$band = new Band();
		$id=$band->get_id_band_by_name($name);
		return $id['id'];
	}

	/**
	*	This function returns the id of a company found with its name
	*	@return the id
	*/
	function get_the_id_company_by_name($name){
		$people = new People();
		$id=$people->get_id_company_by_name($name);
		return $id['id'];
	}
?>