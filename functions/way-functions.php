<?php 
/**
 * Feature name:  CARL 500 way-functions
 * Description:   Fonctions sur ou pour les objets way
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/**
*	@return all the ways stocked in the data base
*/
function get_ways($a_date){
	$way=new Way();
	$result=$way->get_ways($a_date);
	
	return $result;
}

/**
*	@return all the ways corresponding to a run by giving its id
*/
function get_ways_by_id_run($id_run){
	$way=new Way();
	$result=$way->get_ways_by_id_run($id_run);
	
	return $result;
}

/**
* 	This function create an object way and initialize it
*	@return the way
*/
function init_way($id_departure, $id_arrival, $date_departure, $date_arrival, $id_run){
	$way = new Way();
	$way->init($id_departure, $id_arrival, $date_departure, $date_arrival, $id_run);
	return $way;
}

/**
*	@return the departure location of a way by giving its id
*/
function get_way_location_dep_by_id_run($id_way){
	$way=new Way($id_way);
	$id_location=$way-> get_id_location_depart();
	
	$location = new Location($id_location);
	$name_location=$location->get_name();

	return $name_location;
}

/**
*	@return the departure location address of a way by giving its id
*/
function get_way_location_dep_address_by_id_run($id_way){
	$way=new Way($id_way);
	$id_location=$way-> get_id_location_depart();
	
	$location = new Location($id_location);
	$address_location=$location->get_complete_address();

	return $address_location;
}

/**
*	echo the departure location of a way by giving its id
*/
function way_location_dep_by_id_run($id_way){
	echo get_way_location_dep_by_id_run($id_way);
}

/**
*	echo the departure location address of a way by giving its id
*/
function way_location_dep_address_by_id_run($id_way){
	echo get_way_location_dep_address_by_id_run($id_way);
}

/**
*	@return the arrival location of a way by giving its id
*/
function get_way_location_arr_by_id_run($id_way){
	$way=new Way($id_way);
	$id_location=$way->get_id_location_arrivee();

	$location = new Location($id_location);
	$name_location=$location->get_name();

	return $name_location;
}

/**
*	@return the arrival location address of a way by giving its id
*/
function get_way_location_arr_address_by_id_run($id_way){
	$way=new Way($id_way);
	$id_location=$way->get_id_location_arrivee();

	$location = new Location($id_location);
	$name_location=$location->get_complete_address();

	return $name_location;
}

/**
*	echo the arrival location of a way by giving its id
*/
function way_location_arr_by_id_run($id_way){
	echo get_way_location_arr_by_id_run($id_way);
}

/**
*	echo the arrival location address of a way by giving its id
*/
function way_location_arr_address_by_id_run($id_way){
	echo get_way_location_arr_address_by_id_run($id_way);
}

/**
*	@return the departure date of a way by giving its id
*/
function get_way_date_dep_by_id_run($id_way){
	$way=new Way($id_way);
	$date_hour=$way->get_date_depart();
	
	$date = date_create($date_hour);
	return date_format($date, 'd/m/Y');
}

/**
*	echo the departure date of a way by giving its id
*/
function way_date_dep_by_id_run($id_way){
	echo get_way_date_dep_by_id_run($id_way);
}

/**
*	@return the arrival date of a way by giving its id
*/
function get_way_date_arr_by_id_run($id_way){
	$way=new Way($id_way);
	$date_hour=$way->get_date_arrivee();
	
	$date = date_create($date_hour);
	return date_format($date, 'd/m/Y');
}

/**
*	echo the arrival date of a way by giving its id
*/
function way_date_arr_by_id_run($id_way){
	echo get_way_date_arr_by_id_run($id_way);
}

/**
*	@return the departure hour of a way by giving its id
*/
function get_way_hour_dep_by_id_run($id_way){
	$way=new Way($id_way);
	$date_hour=$way->get_date_depart();
	
	$date = date_create($date_hour);
	return date_format($date, 'H:i');
}

/**
*	echo the departure hour of a way by giving its id
*/
function way_hour_dep_by_id_run($id_way){
	echo get_way_hour_dep_by_id_run($id_way);
}

/**
*	@return the arrival hour of a way by giving its id
*/
function get_way_hour_arr_by_id_run($id_way){
	$way=new Way($id_way);
	$date_hour=$way->get_date_arrivee();
	
	$date = date_create($date_hour);
	return date_format($date, 'H:i');
}

/**
*	echo the arrival hour of a way by giving its id
*/
function way_hour_arr_by_id_run($id_way){
	echo get_way_hour_arr_by_id_run($id_way);
}

/**
*	@return the id of a way corresponding to a run by giving its id
*/
function get_id_way_by_id_run($id_run){
	$way=new Way();
	$result=$way->get_ways_by_id_run($id_run);

	foreach($result as $a_way){
		$id[] = $a_way['id'];
	}
	
	return $id;
}

/**
*	This function delete the way by giving its id
*/
function delete_way($id){
	$way = new Way($id);
	$way->delete();
}

?>