<?php
function get_indisponibilities($type){
	$indispo = new Indisponibility();
	$data = $indispo->indisponibilities($type);
	return $data;
}

function get_date_dep_indisponibility_timeline($a_driver_indisponibility){
	$date_begin=$a_driver_indisponibility['begin_date'];

	$date = new DateTime($date_begin);
	$date->modify('-1 month');
	$result= date_format($date, 'Y,m,d,H,i');

	return $result;
}

function date_dep_indisponibility_timeline($a_driver_indisponibility){
	echo get_date_dep_indisponibility_timeline($a_driver_indisponibility);
}


function get_date_arr_indisponibility_timeline($a_driver_indisponibility){
	$date_begin=$a_driver_indisponibility['end_date'];

	$date = new DateTime($date_begin);
	$date->modify('-1 month');
	$result= date_format($date, 'Y,m,d,H,i');

	return $result;
}

function date_arr_indisponibility_timeline($a_driver_indisponibility){
	echo get_date_arr_indisponibility_timeline($a_driver_indisponibility);
}

function get_item_indisponibility_timeline($a_driver_indisponibility){
	if($a_driver_indisponibility['id_item_type']==0){
		$people=new People($a_driver_indisponibility['id_item']);
		$result=$people->get_first_name();
		$result.=' '.$people->get_last_name();
	}
	if($a_driver_indisponibility['id_item_type']==1){
		$car=new Car($a_driver_indisponibility['id_item']);
		$result=$car->get_manufacturer();
		$result.=' '.$car->get_model();
	}
	return $result;
}

function item_indisponibility_timeline($a_driver_indisponibility){
		echo get_item_indisponibility_timeline($a_driver_indisponibility);
}


function add_indisponibility($type,$id_item,$begin_date, $end_date){

	$indisponibility=new Indisponibility();
	$indisponibility->init($id_item, $type, $begin_date, $end_date );
	$id=$indisponibility->save();

	return $id;
}

function delete_indisponibility($id){

	$indisponibility=new Indisponibility($id);
	$indisponibility->delete();

}


function update_indisponibility($id,$item,$start,$end){

	$indisponibility=new Indisponibility($id);
	$indisponibility->set_begin_date($start);
	$indisponibility->set_end_date($end);
	$indisponibility->set_id_item($item);
	$indisponibility->save();

}


?>