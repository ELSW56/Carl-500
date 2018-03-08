<?php
/**
 * Feature name:  CARL 500 check-add-template
 * Description:   Page de vérification des informations, de création et de sauvegarde d'objets
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */


ob_start();
if($_GET['action']=='add'){
	$verif=true;

	if($_GET['check']=='run'){

		$band = get_the_id_band_by_name($_POST['band']);
		$company = get_the_id_company_by_name($_POST['company']);
		$nb_people = $_POST['nb_people'];

		//INITAILISATION OF VARIABLES

		//LIEUX DEPART
		$departures = array();
		$i=1;
		while(isset($_POST['departure_location'.$i])){
			array_push($departures, get_the_id_location_by_name($_POST['departure_location'.$i]));
			$i++;
		}

		//LIEUX D'ARRIVEE
		$arrivals = array();	
		$i=1;
		while(isset($_POST['arrival_location'.$i])){
			array_push($arrivals, get_the_id_location_by_name($_POST['arrival_location'.$i]));
			$i++;
		}

		//DATES DEPART
		$d_dates = array();
		$i=1;
		while(isset($_POST['departure_date'.$i])){
			array_push($d_dates, $_POST['departure_date'.$i]);
			$i++;
		}

		//DATES ARRIVEE
		$a_dates = array();
		$i=1;
		while(isset($_POST['arrival_date'.$i])){
			array_push($a_dates, $_POST['arrival_date'.$i]);
			$i++;
		}

		//HEURES DEPART
		$d_times = array();
		$i=1;
		while(isset($_POST['departure_time'.$i])){
			array_push($d_times, $_POST['departure_time'.$i]);
			$i++;
		}

		//HEURES ARRIVEE
		$a_times = array();
		$i=1;
		while(isset($_POST['arrival_time'.$i])){
			array_push($a_times, $_POST['arrival_time'.$i]);
			$i++;
		}

		//CONDUCTEURS
		$drivers = array();
		$i=1;
		while(isset($_POST['driver'.$i])){
			array_push($drivers, $_POST['driver'.$i]);
			$i++;
		}

		//VEHICULES
		$cars = array();
		$i=1;
		while(isset($_POST['car'.$i])){
			array_push($cars, $_POST['car'.$i]);
			$i++;
		}

		if(isset($_POST['finished']) &&  $_POST['finished'] == 1){$status = 1;} else{$status = 0;}

		$calle = $_POST['calle'];
		$comments = init_comment($_POST['comments']);



		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_run($band, $company, $nb_people);

		if($verif == true){

			$run = save_run(1, $company, $band, $nb_people, $status, $calle, $comments);
					
			$id_run = $run->get_maximum_id();
			$id_run --;

			$drives = create_all_drives($id_run, $cars, $drivers);

			//save_drives($drives);

			save_way($departures, $arrivals, $d_dates, $d_times, $a_dates, $a_times, $id_run);


			header("Location: /carl500/?page=run&action=display&id=".$id_run);
			exit;
		}
		else{
			header("Location: /carl500/?page=run&action=add&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='band'){

		$group_name = $_POST['group_name'];
		$number_persons = $_POST['number_persons'];
		$hebergement = $_POST['hebergement'];
		$check = $_POST['check'];
		$rappel = $_POST['rappel'];
		$start_scenario = $_POST['start_scenario'];
		$end_scenario = $_POST['end_scenario'];
		$validation = $_POST['validation'];
		$comments = init_comment($_POST['comments']);


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS
		
		if(verif_var($_POST['day_passage']) && verif_var($_POST['hour_passage'])){
			$day_passage = create_date($_POST['day_passage'], $_POST['hour_passage']);
		}

		$verif = verif_variables_band($group_name, $number_persons);

		if($verif == true){

			$band = save_band($group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation,  $comments);

			header("Location: /carl500/?page=band");
			exit;
		}
		else{
			header("Location: /carl500/?page=band&action=add&error=error");
			exit;
		}

	}

	elseif($_GET['check']=='car'){
		$type = $_POST['type'];
		$immat = $_POST['immat'];
		$manufacturer = $_POST['manufacturer'];
		$model = $_POST['model'];
		$capacity = $_POST['capacity'];
		$color = $_POST['color'];
		$conso_essence = $_POST['conso_essence'];
		$CO2 = $_POST['CO2'];
		$comments = init_comment($_POST['comments']);


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_car($type, $immat, $manufacturer, $model, $capacity, $color);

		if($verif == true){

			$car = save_car($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);

			header("Location: /carl500/?page=car");
			exit;
		}
		else{
			header("Location: /carl500/?page=car&action=add&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='driver'){
		$gender = $_POST['gender'];
		$last_name = $_POST['last_name'];
		$first_name = $_POST['first_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_driver($gender, $last_name, $first_name);

		if($verif == true){

			$driver = save_driver($gender, $last_name, $first_name, $phone, $email);

			header("Location: /carl500/?page=driver");
			exit;
		}
		else{
			header("Location: /carl500/?page=driver&action=add&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='location'){
		$type = $_POST['type'];
		$name = $_POST['name'];
		$adress = $_POST['adress'];
		$town = $_POST['town'];
		$zip = $_POST['zip'];
		$country = $_POST['country'];
		$phone = $_POST['phone'];
		$fax = $_POST['fax'];
		$web = $_POST['web'];


		//LOCATION'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_location($type, $name, $adress, $town);

		if($verif == true){

			$location = save_location($name, $type, $adress, $town, $zip, $country, $phone, $fax, $web);

			header("Location: /carl500/?page=location");
			exit;
		}
		else{
			header("Location: /carl500/?page=location&action=add&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='people'){
		$gender = $_POST['gender'];
		$id_people_type = $_POST['type'];
		$last_name = $_POST['last_name'];
		$first_name = $_POST['first_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_people($id_people_type, $gender, $last_name, $first_name);

		if($verif == true){

			$people = save_people($id_people_type, $gender, $last_name, $first_name, $phone, $email);

			header("Location: /carl500/?page=people");
			exit;
		}
		else{
			header("Location: /carl500/?page=driver&action=add&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='distance'){
		$location1 = get_the_id_location_by_name($_POST['start']);
		$location2 = get_the_id_location_by_name($_POST['end']);
		$the_distance = $_POST['kms'];
		$time = $_POST['time'];

		$verif = verif_variables_distance($location1, $location2, $the_distance, $time);

		if($verif == true){
			$distance = save_distance($location1, $location2, $the_distance, $time);

			header("Location: /carl500/?page=distance");
			exit;
		}
		else{
			header("Location: /carl500/?page=distance&action=add&error=error");
			exit;
		}
	}
}
ob_end_flush();
?>