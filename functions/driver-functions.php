<?php 

function get_drivers(){
	$peoples=new People();
	$drivers=$peoples->get_peoples(4);

	return $drivers;
}

function init_driver($gender, $last_name, $first_name, $phone, $email){
	$driver = new People();
	$driver->init(4, $gender, $last_name, $first_name, $phone, $email);
	return $driver;
}
?>