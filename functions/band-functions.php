<?php 

/**
 * Feature name:  CARL 500 band-functions
 * Description:   Fonctions sur ou pour les objets band
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */


/**
*	@return all the bands stocked in the data base
*/
function get_bands($query=0){
	$bands=new Band();

	return $bands->get_bands($query);
}

/**
*	@return the date of the band's show
*/
function get_band_day_pass($date_hour){
	$date = date_create($date_hour);

	return date_format($date, 'd/m/Y');
}

/**
*	echo the date of the band's show
*/
function band_day_pass($date_hour){
	echo get_band_day_pass($date_hour);
}

/**
*	@return the hour of the band's show
*/
function get_band_hour_pass($date_hour){
	$date = date_create($date_hour);

	return date_format($date, 'H:i');
}

/**
*	echo the hour of the band's show
*/
function band_hour_pass($date_hour){
	echo get_band_hour_pass($date_hour);
}

/**
*	This function create and initialize a new band with the values
*/
function init_band($group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments){
	$band = new Band();
	$band->init($group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments);
	return $band;
}

/**
*	@return the name of the band by giving the id
*/
function get_band_name_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_band_name();

	return $ret;
}

/**
*	echo the name of the band by giving the id
*/
function band_name_by_id($id_band){
	echo get_band_name_by_id($id_band);
}


/**
*	@return the number of person in the band by giving the id
*/
function get_band_number_persons_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_number_persons();

	return $ret;
}

/**
*	echo the number of person in the band by giving the id
*/
function band_number_persons_by_id($id_band){
	echo get_band_number_persons_by_id($id_band);
}

/**
*	@return the hosting of the band by giving the id
*/
function get_band_hebergement_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_hebergement();

	return $ret;
}

/**
*	echo the hosting of the band by giving the id
*/
function band_hebergement_by_id($id_band){
	echo get_band_hebergement_by_id($id_band);
}

/**
*	@return if the band is checked
*/
function get_band_check_yes_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_check();
	
	if($check==0){
		$ret='checked';
	}	

	return $ret;
}

/**
*	echo if the band is checked
*/
function band_check_yes_by_id($id_band){
	echo get_band_check_yes_by_id($id_band);
}

/**
*	@return if the band isn't checked
*/
function get_band_check_no_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_check();
	
	if($check==0){
		$ret='checked';
	}	

	return $ret;
}

/**
*	echo if the band isn't checked
*/
function band_check_no_by_id($id_band){
	echo get_band_check_no_by_id($id_band);
}

/**
*	@return the start_scenario of the band by giving the id
*/
function get_band_start_scenario_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_start_scenario();

	return $ret;
}

/**
*	echo the start_scenario of the band by giving the id
*/
function band_start_scenario_by_id($id_band){
	$texte = get_band_start_scenario_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="start_scenario" style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px" disabled="disabled">'.$texte.'</textarea>';
}

/**
*	echo the start_scenario of the band to be modified by giving the id
*/
function band_start_scenario_by_id_modify($id_band){
	$texte = get_band_start_scenario_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="start_scenario" style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px">'.$texte.'</textarea>';
}

/**
*	@return the end_scenario of the band by giving the id
*/
function get_band_end_scenario_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_end_scenario();

	return $ret;
}

/**
*	echo the end_scenario of the band by giving the id
*/
function band_end_scenario_by_id($id_band){
	$texte = get_band_end_scenario_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="end_scenario" style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px" disabled="disabled">'.$texte.'</textarea>';
}

/**
*	echo the end_scenario of the band to be modified by giving the id
*/
function band_end_scenario_by_id_modify($id_band){
	$texte = get_band_end_scenario_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="end_scenario"  style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px">'.$texte.'</textarea>';
}

/**
*	@return the date of the band's show by giving the id
*/
function get_band_date_show_by_id($id_band){
	$band=new Band($id_band);
	$date_dep=$band->get_date_show();

	$date = date_create($date_dep);
	return date_format($date, 'd/m/Y');
}

/**
*	echo the date of the band's show by giving the id
*/
function band_date_show_by_id($id_band){
	echo get_band_date_show_by_id($id_band);
}

/**
*	@return the hour of the band's show by giving the id
*/
function get_band_hour_show_by_id($id_band){
	$band=new Band($id_band);
	$date_dep=$band->get_date_show();

	$date = date_create($date_dep);
	return date_format($date, 'H:i');
}

/**
*	echo the hour of the band's show by giving the id
*/
function band_hour_show_by_id($id_band){
	echo get_band_hour_show_by_id($id_band);
}

/**
*	@return if the band need a rappel by giving the id
*/
function get_band_rappel_yes_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_rappel();
	$ret='unchecked';
	if($check==1){
		$ret='checked';
	}	

	return $ret;
}

/**
*	echo if the band need a rappel by giving the id
*/
function band_rappel_yes_by_id($id_band){
	echo get_band_rappel_yes_by_id($id_band);
}

/**
*	@return if the band doesn't need a rappel by giving the id
*/
function get_band_rappel_no_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_rappel();
	$ret='';
	if($check==0){
		$ret='checked';
	}	

	return $ret;
}

/**
*	echo if the band doesn't need a rappel by giving the id
*/
function band_rappel_no_by_id($id_band){
	echo get_band_rappel_no_by_id($id_band);
}


/**
*	@return the comment's on the band by giving the id
*/
function get_band_comments_by_id($id_band){
	$band=new Band($id_band);
	$ret=$band->get_comments();

	return $ret;
}

/**
*	echo the comment's on the band by giving the id
*/
function band_comments_by_id($id_band){
	$texte = get_band_comments_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="comments"  style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px" disabled="disabled">'.$texte.'</textarea>';
}
/**
*	displays for update the comment's on the band by giving the id
*/
function band_comments_by_id_modify($id_band){
	$texte = get_band_comments_by_id($id_band);
	$nbligne = 1+ substr_count($texte,"\n");
	echo '<textarea name="comments"  style="width: 99%; margin-top: 5px; height:'.($nbligne*20).'px">'.$texte.'</textarea>';
}

/**
*	@return the check for the band by giving the id
*/
function get_band_check_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_check();
	
	if($check==1){
		$ret='Oui';
	}	
	else{
		$ret='Non';
	}

	return $ret;
}

/**
*	echo the check for the band by giving the id
*/
function band_check_by_id($id_band){
	echo get_band_check_by_id($id_band);
}

/**
*	@return the rappel for the band by giving the id
*/
function get_band_rappel_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_rappel();

	if($check==1){
		$ret='Oui';
	}	
	else{
		$ret='Non';
	}

	return $ret;
}
/**
*	echo the rappel for the band by giving the id
*/
function band_rappel_by_id($id_band){
	echo get_band_rappel_by_id($id_band);
}

/**
*	@return if the band need a rappel by giving the id
*/
function get_band_validation_by_id($id_band){
	$band=new Band($id_band);
	$check=$band->get_validation();
	$ret='unchecked';
	if($check==1){
		$ret='checked';
	}	

	return $ret;
}

/** 
*	echo the list of runs already defined for the band by giving the id
**/
function band_runs_by_id($id_band){
	$runs=new Run();
	$results=$runs->get_runs_by_band($id_band);

	return $results;
}
/**
*	echo if the band need a rappel by giving the id
*/
function band_validation_by_id($id_band){
	echo get_band_validation_by_id($id_band);
}

/**
* 	This function modify the band corresponding to the id in the parameters
*	Set all attributes with the new values
*	@return the band
*/
function modif_the_band($id, $group_name, $number_persons, $hebergement, $check, $day_passage, $rappel, $start_scenario, $end_scenario, $validation, $comments){
	$band = new Band($id);
	$band->set_band_name($group_name);
	$band->set_number_persons($number_persons);
	$band->set_hebergement($hebergement);
	$band->set_check($check);
	$band->set_date_show($day_passage);
	$band->set_rappel($rappel);
	$band->set_start_scenario($start_scenario);
	$band->set_end_scenario($end_scenario);
	$band->set_validation($validation);
	$band->set_comments($comments);
	return $band;
}

function get_all_id_name_band(){
	$band = new Band();
	$data = $band->get_all_id_name_band();
	return $data;		
}
?>