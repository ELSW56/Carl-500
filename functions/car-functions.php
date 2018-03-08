<?php

/**
 * Feature name:  CARL 500 car-functions
 * Description:   Fonctions sur ou pour les objets car
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/**
*	@return all the cars stocked in the data base
*/
function get_cars($query=0){
	$cars=new Car();

	return $cars->get_cars($query);
}

/**
*	This function create and initialize a new band with the values
*	@return the car
*/
function init_car($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments){
	$car = new Car();
	$car->init($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);
	return $car;
}


/**
*	@return all the cars' registration number stored in the data base
*/
function select_all_immats(){
	$cars = get_cars();
	foreach($cars as $car){
		$immats[] = $car['immat'];
	}
	return $immats;
}


/**
*	@return the car type of a car by giving its id
*/
function get_car_type_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_type();

	return $ret;
}

/**
*	echo the car type of a car by giving its id
*/
function people_car_type_by_id($id_car){
	echo get_car_type_by_id($id_car);
}

/**
*	@return the registration number of a car by giving its id
*/
function get_car_immat_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_immat();

	return $ret;
}

/**
*	echo the registration number of a car by giving its id
*/
function people_car_immat_by_id($id_car){
	echo get_car_immat_by_id($id_car);
}

/**
*	@return the manufacturer of a car by giving its id
*/
function get_car_manufacturer_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_manufacturer();

	return $ret;
}

/**
*	echo the manufacturer of a car by giving its id
*/
function people_car_manufacturer_by_id($id_car){
	echo get_car_manufacturer_by_id($id_car);
}

/**
*	@return the model of a car by giving its id
*/
function get_car_model_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_model();

	return $ret;
}

/**
*	echo the model of a car by giving its id
*/
function people_car_model_by_id($id_car){
	echo get_car_model_by_id($id_car);
}

/**
*	@return the capacity of a car by giving its id
*/
function get_car_capacity_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_capacity();

	return $ret;
}

/**
*	echo the capacity of a car by giving its id
*/
function people_car_capacity_by_id($id_car){
	echo get_car_capacity_by_id($id_car);
}

/**
*	@return the color of a car by giving its id
*/
function get_car_color_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_color();

	return $ret;
}

/**
*	echo the color of a car by giving its id
*/
function people_car_color_by_id($id_car){
	echo get_car_color_by_id($id_car);
}

/**
*	@return the oil consumption of a car by giving its id
*/
function get_car_conso_essence_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_conso_essence();

	return $ret;
}

/**
*	echo the oil consumption of a car by giving its id
*/
function people_car_conso_essence_by_id($id_car){
	echo get_car_conso_essence_by_id($id_car);
}

/**
*	@return the CO2 consumption of a car by giving its id
*/
function get_car_CO2_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_CO2();

	return $ret;
}

/**
*	echo the CO2 consumption of a car by giving its id
*/
function people_car_CO2_by_id($id_car){
	echo get_car_CO2_by_id($id_car);
}

/**
*	@return the comments for a car by giving its id
*/
function get_car_comments_by_id($id_car){
	$car=new Car($id_car);
	$ret=$car->get_comments();

	return $ret;
}

/**
*	echo the comments for a car by giving its id
*/
function people_car_comments_by_id($id_car){
	echo get_car_comments_by_id($id_car);
}

/**
* 	This function modify the car corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the car
*/
function modif_the_car($id, $type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments){
	$car = new Car($id);
	$car->set_type($type);
	$car->set_immat($immat);
	$car->set_manufacturer($manufacturer);
	$car->set_model($model);
	$car->set_capacity($capacity);
	$car->set_color($color);
	$car->set_conso_essence($conso_essence);
	$car->set_CO2($CO2);
	$car->set_comments($comments);
	return $car;
}

function get_all_id_name_car($tri){
	$car = new Car();
	$data = $car->get_all_id_name_car($tri);
	return $data;
}

/**
*	@return all the cars' types stored in the data base
*/
function get_all_car_types(){
	$car = new Car();
	$data = $car->get_all_car_types();
	return $data;
}

?>