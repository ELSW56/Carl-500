<?php
/**
 * Feature name:  CARL 500 check-modify-template
 * Description:   Page de vérification des informations, de modification et d'update d'objets
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

if($_GET['action']=='modify'){
	$verif=true;

	if($_GET['check']=='run'){

		$id_run = $_POST['id_run'];
		
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
		$first_date = $_POST['departure_date1'];

		//DATES ARRIVEE
		$a_dates = array();
		$i=1;
		while(isset($_POST['arrival_date'.$i])){
			array_push($a_dates, $_POST['arrival_date'.$i]);
			$i++;
		}
		$last_date = $_POST['arrival_date'.($i-1)];

		//HEURES DEPART
		$d_times = array();
		$i=1;
		while(isset($_POST['departure_time'.$i])){
			array_push($d_times, $_POST['departure_time'.$i]);
			$i++;
		}
		$first_time = $_POST['departure_time1'];

		//HEURES ARRIVEE
		$a_times = array();
		$i=1;
		while(isset($_POST['arrival_time'.$i])){
			array_push($a_times, $_POST['arrival_time'.$i]);
			$i++;
		}
		$last_time = $_POST['arrival_time'.($i-1)];

		//CONDUCTEURS
		$drivers = array();
		$i=1;
		while(isset($_POST['driver'.$i]) && !empty($_POST['driver'.$i])){
			array_push($drivers, $_POST['driver'.$i]);
			$i++;
		}

		//VEHICULES
		$cars = array();
		$i=1;
		while(isset($_POST['car'.$i]) && !empty($_POST['car'.$i])){
			array_push($cars, $_POST['car'.$i]);
			$i++;
		}
		
		//Nombre de Drives à prévoir
		if(isset($_POST['nbDrives'])) {$nbDrives = $_POST['nbDrives'];} else 	{$nbDrives = 1;}
		
		//Nombre de Drives déjà existants
		if(isset($_POST['nbDrivesBefore'])) {$nbDrivesBefore = $_POST['nbDrivesBefore'];} else 	{$nbDrivesBefore = 1;}

		if(isset($_POST['finished']) &&  $_POST['finished']== 1){$status = 1;} else{$status = 0;}

		if(isset($_POST['calle'])) {$calle = $_POST['calle'];} else 	{$calle = 0;}
		$comments = init_comment($_POST['comments']);


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_run($band, $company, $nb_people);

		if($verif == true){
			// Mise à jour des drives existants
			$all_drives = get_drives_by_id_run($id_run);
			foreach ($all_drives as $a_drive_id) {
				$drive = new Drive($a_drive_id);
				$drive->set_start(create_date($first_date, $first_time));
				$drive->set_end(create_date($last_date, $last_time));
				$drive->save();
			}
			//modif_all_drives($all_drives, $id_run, $cars, $drivers);
			// création des drives manquants
			for ($i=0;$i<$nbDrives - nbDrivesBefore;$i++) {
				$drive = new Drive();
				$drive->init($id_run, 0,0, create_date($first_date, $first_time), create_date($last_date, $last_time));
				$drive->save();
			}
			
			//Mise à jour des trajets
			$ways_id = get_id_way_by_id_run($id_run);
			modif_way($ways_id, $departures, $arrivals, $d_dates, $d_times, $a_dates, $a_times, $id_run);
			
			//Mise à jour du run
			modif_run($id_run, 1, $company, $band, $nb_people, $status, $calle, $comments);

			header("Location: /carl500/?page=run&action=display&id=".$id_run);
			exit;
		}
		else{
			header("Location: /carl500/?page=run&action=modify&id=".$id_run."&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='band'){
		$id = $_POST['id'];
		$group_name = $_POST['group_name'];
		$number_persons = $_POST['number_persons'];
		$hebergement = $_POST['hebergement'];
		$check = $_POST['check'];
		$rappel = $_POST['rappel'];
		$start_scenario = $_POST['start_scenario'];
		$end_scenario = $_POST['end_scenario'];
		$validation = $_POST['validation'];
		$comments = init_comment($_POST['comments']);


		//BAND'S CREATION AND VARIABLES' VERIFICATIONS
		
		if(verif_var($_POST['day_passage']) && verif_var($_POST['hour_passage'])){
			$day_passage = create_date($_POST['day_passage'], $_POST['hour_passage']);
		}

		$verif = verif_variables_band($group_name, $number_persons);

		if($verif == true){

			$band = modif_band($id, $group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments);

			header("Location: /carl500/?page=band&action=display&id=".$id."&nbp=".$number_persons);
			exit;
		}
		else{
			header("Location: /carl500/?page=band&action=modify&id=".$id."&error=error");
			exit;
		}

	}

	elseif($_GET['check']=='car'){
		$id = $_POST['id'];
		$type = $_POST['type'];
		$immat = $_POST['immat'];
		$manufacturer = $_POST['manufacturer'];
		$model = $_POST['model'];
		$capacity = $_POST['capacity'];
		$color = $_POST['color'];
		$conso_essence = $_POST['conso_essence'];
		$CO2 = $_POST['CO2'];
		$comments = init_comment($_POST['comments']);


		//CAR'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_car($type, 555, $manufacturer, $model, $capacity, $color);

		if($verif == true){
			$car = modif_car($id, $type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);

			header("Location: /carl500/?page=car&action=display&id=".$id);
			exit;
		}
		else{
			header("Location: /carl500/?page=car&action=modify&id=".$id."&error=error");
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

			echo "<pre>";
			print_r($driver);
			echo "</pre>";
			//header("Location: /carl500/?page=driver&action=driver&id=".$id");
			//exit;
		}
		else{
			header("Location: /carl500/?page=driver&action=modify&id=".$id."&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='location'){
		$id = $_POST['id'];
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
		
			$location = modif_a_location($id, $type, $name, $adress, $town, $zip, $country, $phone, $fax, $web);
			header("Location: /carl500/?page=location&action=display&id=".$id);
			exit;
		}
		else{
			header("Location: /carl500/?page=location&action=modify&id=".$id."&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='people'){
		$id = $_POST['id'];
		$gender = $_POST['gender'];
		$id_people_type = $_POST['type'];
		$last_name = $_POST['last_name'];
		$first_name = $_POST['first_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];


		//RUN'S CREATION AND VARIABLES' VERIFICATIONS

		$verif = verif_variables_people($id_people_type, $gender, $last_name, $first_name);

		if($verif == true){

			$people = modif_people($id, $id_people_type, $gender, $last_name, $first_name, $phone, $email);

			header("Location: /carl500/?page=people&action=display&id=".$id);
			exit;
		}
		else{
			header("Location: /carl500/?page=people&action=modify&id=".$id."&error=error");
			exit;
		}
	}

	elseif($_GET['check']=='distance'){
		$id = $_POST['id'];
		$location1 = get_the_id_location_by_name($_POST['start']);
		$location2 = get_the_id_location_by_name($_POST['end']);
		$the_distance = $_POST['kms'];
		$time = $_POST['time'];

		$verif = verif_variables_distance($location1, $location2, $the_distance, $time);


		if($verif == true){
			$distance = modif_distance($id, $location1, $location2, $the_distance, $time);

			header("Location: /carl500/?page=distance&action=display&id=".$id);
			exit;
		}
		else{
			header("Location: /carl500/?page=driver&action=modify&id=".$id."&error=error");
			exit;
		}
	}
}
?>