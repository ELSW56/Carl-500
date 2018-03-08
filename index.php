<?php
/**
 * Feature name:  CARL 500
 * Description:   Application de gestion du transport des artistes
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

/** Load all of Carl500 ********************************************************************/
require_once('loader.php');


/** Include the header of application ******************************************************/
if(isset($_GET['page'])&& isset($_GET['option'])&&($_GET['option']!='no_header_footer')){include( CARL500_TEMPLATE_PATH . 'header.php');}
if(!isset($_GET['page'])||!isset($_GET['option'])){include( CARL500_TEMPLATE_PATH . 'header.php');}
	
	/** Feature HOME ****************************************************************************/
	
	//if(!isset($_GET['page'])){ include( CARL500_TEMPLATE_PATH . 'home-template.php'); } 
	if(!isset($_GET['page'])){ include( CARL500_TEMPLATE_PATH . 'home-template.php'); } 
	else {
	


	/** Feature CHECK ****************************************************************************/
	
	if($_GET['page']=='check'){
	
		//Add check
		if($_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'check/check-add-template.php'); } 

		//Modify check
		if($_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'check/check-modify-template.php'); } 
	
	}

	/** Feature AJAX ****************************************************************************/
	
	if($_GET['page']=='ajax'){ include( CARL500_TEMPLATE_PATH . 'home-ajax-template.php'); } 



	/** Feature RUN ****************************************************************************/

	if($_GET['page']=='run'){

		//Index of run
		if (isset($_GET['action'])) {
			if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'run/run-template.php'); } 
		
			//Add run
			if($_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'run/run-add-template.php'); } 
		
			//Modify run
			if($_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'run/run-modify-template.php'); } 

			//Display run
			if($_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'run/run-display-template.php'); } 

			//Search run
			if($_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'run/run-search-template.php'); } 

			//Ajax run
			if($_GET['action']=='ajax'){ include( CARL500_TEMPLATE_PATH . 'run/run-ajax-template.php'); } 
		}
		else {
			include( CARL500_TEMPLATE_PATH . 'run/run-template.php');
		}
	}	
	
	/** Feature DRIVER ****************************************************************************/
	
	if($_GET['page']=='driver'){

		//Index of driver
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'driver/driver-template.php'); } 
	
		//Add driver
		if($_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'driver/driver-add-template.php'); } 
	
		//Modify driver
		if($_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'driver/driver-modify-template.php'); } 

		//Display driver
		if($_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'driver/driver-display-template.php'); } 

	}
	
	/** Feature CAR ****************************************************************************/
	
	if($_GET['page']=='car'){

		//Index of car
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'car/car-template.php'); } 
	
		//Add car
		if(isset($_GET['action']) && $_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'car/car-add-template.php'); } 
	
		//Modify car
		if(isset($_GET['action']) && $_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'car/car-modify-template.php'); } 

		//Display car
		if(isset($_GET['action']) && $_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'car/car-display-template.php'); } 

		//Search car
		if(isset($_GET['action']) && $_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'car/car-search-template.php'); } 

		//Import car
		if(isset($_GET['action']) && $_GET['action']=='import'){ include( CARL500_TEMPLATE_PATH . 'car/car-import-template.php'); } 
	
	}
	
	/** Feature BAND ****************************************************************************/
	
	if($_GET['page']=='band'){

		//Index of band
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'band/band-template.php'); } 
		
		//Add band
		if(isset($_GET['action']) && $_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'band/band-add-template.php'); } 
		
		//Modify band
		if(isset($_GET['action']) && $_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'band/band-modify-template.php'); } 

		//Display band
		if(isset($_GET['action']) && $_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'band/band-display-template.php'); } 

		//Search band
		if(isset($_GET['action']) && $_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'band/band-search-template.php'); } 

		//Import band
		if(isset($_GET['action']) && $_GET['action']=='import'){ include( CARL500_TEMPLATE_PATH . 'band/band-import-template.php'); } 
	
	}	
	
	/** Feature PEOPLE ****************************************************************************/
	
	if($_GET['page']=='people'){

		//Index of people
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'people/people-template.php'); } 
	
		//Add people
		if(isset($_GET['action']) && $_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'people/people-add-template.php'); } 
	
		//Modify people
		if(isset($_GET['action']) && $_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'people/people-modify-template.php'); } 

		//Display people
		if(isset($_GET['action']) && $_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'people/people-display-template.php'); } 

		//Search run
		if(isset($_GET['action']) && $_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'people/people-search-template.php'); } 

		//Import people
		if(isset($_GET['action']) && $_GET['action']=='import'){ include( CARL500_TEMPLATE_PATH . 'people/people-import-template.php'); } 

	}		
	
	/** Feature LOCATION ****************************************************************************/
	
	if($_GET['page']=='location'){

		//Index of location
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'location/location-template.php'); } 
		
		//Add location
		if(isset($_GET['action']) && $_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'location/location-add-template.php'); } 
		
		//Modify location
		if(isset($_GET['action']) && $_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'location/location-modify-template.php'); } 

		//Display location
		if(isset($_GET['action']) && $_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'location/location-display-template.php'); } 

		//Search run
		if(isset($_GET['action']) && $_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'location/location-search-template.php'); } 

		//Import location
		if(isset($_GET['action']) && $_GET['action']=='import'){ include( CARL500_TEMPLATE_PATH . 'location/location-import-template.php'); } 

	}	


	/** Feature DISTANCE ****************************************************************************/

	if($_GET['page']=='distance'){

		//Index of disatnce
		if((empty($_GET['action']))||($_GET['action']=='delete')){ include( CARL500_TEMPLATE_PATH . 'distance/distance-template.php'); } 
	
		//Add distance
		if(isset($_GET['action']) && $_GET['action']=='add'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-add-template.php'); } 
	
		//Modify distance
		if(isset($_GET['action']) && $_GET['action']=='modify'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-modify-template.php'); }
 
		//Modify run
		if(isset($_GET['action']) && $_GET['action']=='search'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-search-template.php'); } 

		//Calculate distance
		if(isset($_GET['action']) && $_GET['action']=='calculate'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-calculate-template.php'); } 

		//Import distance
		if(isset($_GET['action']) && $_GET['action']=='import'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-import-template.php'); } 

		//Display distance
		if(isset($_GET['action']) && $_GET['action']=='display'){ include( CARL500_TEMPLATE_PATH . 'distance/distance-display-template.php'); } 

	}	


/** Include the footer of application ******************************************************/
	if (isset($_GET['page'])&&isset($_GET['option'])) {
		if(($_GET['page']!='check')&&($_GET['option']!='no_header_footer')){
		include( CARL500_TEMPLATE_PATH . 'footer.php');
		}
	}
	else {
		include( CARL500_TEMPLATE_PATH . 'footer.php');
	}
}
?>