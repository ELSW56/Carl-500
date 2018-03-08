<?php
/**
 * Feature name:  CARL 500 people-functions
 * Description:   Fonctions sur ou pour les objets people
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/**
*	@return all the people stocked in the data base
*/
function get_peoples($query=0){
	$peoples=new People();

	return $peoples->get_peoples($query);
}

function get_peoples_drivers(){
	$peoples=new People();

	return $peoples->get_drivers();
}


/**
*	@return all the people_type stocked in the data base
*/
function get_people_types(){
	$peoples=new People();

	return $peoples->get_people_types();
}

/**
*	@return the people_type corresponding to the id
*/
function get_type_people($id_people_type){
	$peoples=new People();
	$type_people=$peoples->get_type_people($id_people_type);

	return $type_people[0]['type'];
}

/**
*	This fonction create an object people and initialize it	
*	@return the people
*/
function init_people($id_people_type, $gender, $last_name, $first_name, $phone, $email){
	$driver = new People();
	$driver->init($id_people_type, $gender, $last_name, $first_name, $phone, $email);
	return $driver;
}

/**
*	@return the people gender of the people by giving its id
*/
function get_people_gender_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_gender();

	return $ret;
}

/**
*	echo the people gender of the people by giving its id
*/
function people_gender_by_id($id_people){
	echo get_people_gender_by_id($id_people);
}

/**
*	@return the people_type of the people by giving its id
*/
function get_people_type_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_id_people_type();

	return get_type_people($ret);
}

/**
*	echo the people_type of the people by giving its id
*/
function people_type_by_id($id_people){
	echo get_people_type_by_id($id_people);
}

/**
*	@return the first name of the people by giving its id
*/
function get_people_first_name_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_first_name();

	return $ret;
}

/**
*	echo the first name of the people by giving its id
*/
function people_first_name_by_id($id_people){
	echo get_people_first_name_by_id($id_people);
}

/**
*	@return the last name of the people by giving its id
*/
function get_people_last_name_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_last_name();

	return $ret;
}

/**
*	echo the last name of the people by giving its id
*/
function people_last_name_by_id($id_people){
	echo get_people_last_name_by_id($id_people);
}

/**
*	@return the phone of the people by giving its id
*/
function get_people_phone_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_phone();

	return $ret;
}

/**
*	echo the phone of the people by giving its id
*/
function people_phone_by_id($id_people){
	echo get_people_phone_by_id($id_people);
}

/**
*	@return the email of the people by giving its id
*/
function get_people_email_by_id($id_people){
	$people=new People($id_people);
	$ret=$people->get_email();

	return $ret;
}

/**
*	echo the email of the people by giving its id
*/
function people_email_by_id($id_people){
	echo get_people_email_by_id($id_people);
}

/**
* 	This function modify the people corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the people
*/

function modif_the_people($id, $id_people_type, $gender, $last_name, $first_name, $phone, $email){
	$people = new People($id);
	$people->set_id_people_type($id_people_type);
	$people->set_gender($gender);
	$people->set_last_name($last_name);
	$people->set_first_name($first_name);
	$people->set_phone($phone);
	$people->set_email($email);

	return $people;
}

function get_all_id_name_company(){
	$people = new People();
	$data = $people->get_all_id_name_company();
	return $data;		
}

function get_all_id_name_driver($tri){
	$people = new People();
	$data = $people->get_all_id_name_driver($tri);
	return $data;
}

function get_all_id_name_driver_with_run($tri){
	$people = new People();
	$data = $people->get_all_id_name_driver_with_run($tri);
	return $data;
}
?>
