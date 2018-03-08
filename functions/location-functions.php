<?php 
/**
 * Feature name:  CARL 500 location-functions
 * Description:   Fonctions sur ou pour les objets location
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/**
*	@return all the location stocked in the data base
*/
function get_locations($query=0){
	$peoples=new Location();
	return $peoples->get_locations($query);
}

/**
*	@return all the location_type stocked in the data base
*/
function get_location_types(){
	$peoples=new Location();

	return $peoples->get_location_types();
}

/**
* 	This function create a object location and initialize it
*	@return all the bands stocked in the data base
*/
function init_location($name, $type, $adress, $town, $zip, $country, $phone, $fax, $web){
	$location = new Location();
	$location->init($name, $type, $adress, $town, $zip, $country, $phone, $fax, $web);

	return $location;
}

/**
*	@return all the location name stocked in the data base
*/
function select_all_locations(){
	$locs = get_locations();
	$i=0;
	foreach($locs as $loc){
		$locs[$i] = $loc['name'];
		$i++;
	}
	return $locs;
}

/**
*	@return the location_type corresponding to a location by giving its id
*/
function get_location_type_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_name_location_type();

	return $ret;
}

/**
*	echo the location_type corresponding to a location by giving its id
*/
function location_type_by_id($id_location){
	echo get_location_type_by_id($id_location);
}

/**
*	@return the name of a location by giving its id
*/
function get_location_name_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_name();

	return ucwords(strtolower($ret));
}

/**
*	echo the name of a location by giving its id
*/
function location_name_by_id($id_location){
	echo get_location_name_by_id($id_location);
}

/**
*	@return the adress of a location by giving its id
*/
function get_location_address_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_address();

	return $ret;
}

/**
*	echo the adress of a location by giving its id
*/
function location_address_by_id($id_location){
	echo get_location_address_by_id($id_location);
}

/**
*	@return the town of a location by giving its id
*/
function get_location_town_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_town();

	return $ret;
}

/**
*	echo the town of a location by giving its id
*/
function location_town_by_id($id_location){
	echo get_location_town_by_id($id_location);
}

/**
*	@return the zip of a location by giving its id
*/
function get_location_zip_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_zip();

	return $ret;
}

/**
*	echo the zip of a location by giving its id
*/
function location_zip_by_id($id_location){
	echo get_location_zip_by_id($id_location);
}

/**
*	@return the country of a location by giving its id
*/
function get_location_country_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_country();

	return $ret;
}

/**
*	echo the country of a location by giving its id
*/
function location_country_by_id($id_location){
	echo get_location_country_by_id($id_location);
}

/**
*	@return the phone number of a location by giving its id
*/
function get_location_phone_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_phone();

	return $ret;
}

/**
*	echo the phone number of a location by giving its id
*/
function location_phone_by_id($id_location){
	echo get_location_phone_by_id($id_location);
}

/**
*	@return the fax number of a location by giving its id
*/
function get_location_fax_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_fax();

	return $ret;
}

/**
*	echo the fax number of a location by giving its id
*/
function location_fax_by_id($id_location){
	echo get_location_fax_by_id($id_location);
}

/**
*	@return the web site of a location by giving its id
*/
function get_location_web_by_id($id_location){
	$location=new Location($id_location);
	$ret=$location->get_web();

	return $ret;
}

/**
*	echo the web site of a location by giving its id
*/
function location_web_by_id($id_location){
	echo get_location_web_by_id($id_location);
}

/**
*	@return the id of the location by giving its name
*/
function get_location_id_by_name($name_location){
	$locations = get_locations();
	foreach($locations as $location){
		if($location['name'] == $name_location){
			$ret = $location['id'];
		}
	}
	return $ret;
}

/**
* 	This function modify the location corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the location
*/
function modif_the_location($id, $type, $name, $adress, $town, $zip, $country, $phone, $fax, $web){
	$location = new Location($id);
	$location->set_id_location_type($type);
	$location->set_address($adress);
	$location->set_name($name);
	$location->set_town($town);
	$location->set_zip($zip);
	$location->set_country($country);
	$location->set_phone($phone);
	$location->set_fax($fax);
	$location->set_web($web);

	return $location;
}

function get_all_id_name_location(){
	$location = new Location();
	$data = $location->get_all_id_name_location();
	return $data;		
}
?>
