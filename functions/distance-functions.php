<?php 

	function get_distances($query = 0){
		$distance = new Distance();
		return $distance->get_distances($query);
	}

	function get_distance($location1, $location2){
		$distance = new Distance();
		$time = $distance->get_time_distance($location1, $location2);
		return $time;
	}

	function init_distance($location1, $location2, $the_distance, $time){
		$distance = new Distance();
		$distance->init($location1, $location2, $the_distance, $time);
		return $distance;
	}

	function modif_the_distance($id, $location1, $location2, $the_distance, $time){
		$distance = new Distance($id);
		$distance->set_location1($location1);
		$distance->set_location2($location2);
		$distance->set_distance($the_distance);
		$distance->set_time($time);
		return $distance;
	}

	function get_location1_by_id($id_distance){
		$distance = new Distance($id_distance);
		return get_location_name_by_id($distance->get_location1());
	}

	function distance_location1_by_id($id_distance){
		echo get_location1_by_id($id_distance);
	}

	function get_location2_by_id($id_distance){
		$distance = new Distance($id_distance);
		return get_location_name_by_id($distance->get_location2());
	}

	function distance_location2_by_id($id_distance){
		echo get_location2_by_id($id_distance);
	}

	function get_distance_by_id($id_distance){
		$distance = new Distance($id_distance);
		return $distance->get_distance();
	}

	function distance_distance_by_id($id_distance){
		echo get_distance_by_id($id_distance);
	}

	function get_time_by_id($id_distance){
		$distance = new Distance($id_distance);
		return $distance->get_time();
	}

	function distance_time_by_id($id_distance){
		echo get_time_by_id($id_distance);
	}
?>