<?php
/**
 * Feature name:  CARL 500 Loader
 * Description:   Chargement des fonctions et des fichiers
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

// Define the template path
if ( !defined( 'CARL500_TEMPLATE_PATH' ) )
	define( 'CARL500_TEMPLATE_PATH', 'C:/wamp/www/carl500/template/' );

// Define the fucntion path
if ( !defined( 'CARL500_FUNCTIONS_PATH' ) )
	define( 'CARL500_FUNCTIONS_PATH', 'C:/wamp/www/carl500/functions/' );

// Define the template path
if ( !defined( 'CARL500_CLASSES_PATH' ) )
	define( 'CARL500_CLASSES_PATH', 'C:/wamp/www/carl500/classes/' );


/** FUNCTIONS LOADER *******************************************************************/

// Load the run functions
require_once( CARL500_FUNCTIONS_PATH . 'run-functions.php');

// Load the way functions
require_once( CARL500_FUNCTIONS_PATH . 'way-functions.php');

// Load the driver functions
require_once( CARL500_FUNCTIONS_PATH . 'driver-functions.php');

// Load the people functions
require_once( CARL500_FUNCTIONS_PATH . 'people-functions.php');

// Load the band functions
require_once( CARL500_FUNCTIONS_PATH . 'band-functions.php');

// Load the location functions
require_once( CARL500_FUNCTIONS_PATH . 'location-functions.php');

// Load the car functions
require_once( CARL500_FUNCTIONS_PATH . 'car-functions.php');

// Load the timeline functions
require_once( CARL500_FUNCTIONS_PATH . 'timeline-functions.php');

// Load the distance functions
require_once( CARL500_FUNCTIONS_PATH . 'distance-functions.php');

// Load the check functions
require_once( CARL500_FUNCTIONS_PATH . 'check-functions.php');

// Load the indisponibility functions
require_once( CARL500_FUNCTIONS_PATH . 'indisponibility-functions.php');

/** CLASSES LOADER *********************************************************************/

// Load the connexion functions
require_once( CARL500_CLASSES_PATH . 'connexion-classes.php');

// Load the run classes
require_once( CARL500_CLASSES_PATH . 'run-classes.php');

// Load the location classes
require_once( CARL500_CLASSES_PATH . 'location-classes.php');

// Load the way classes
require_once( CARL500_CLASSES_PATH . 'way-classes.php');

// Load the band classes
require_once( CARL500_CLASSES_PATH . 'band-classes.php');

// Load the people classes
require_once( CARL500_CLASSES_PATH . 'people-classes.php');

// Load the car classes
require_once( CARL500_CLASSES_PATH . 'car-classes.php');

// Load the drive classes
require_once( CARL500_CLASSES_PATH . 'drive-classes.php');

// Load the distance classes
require_once( CARL500_CLASSES_PATH . 'distance-classes.php');

// Load the Date classes
require_once( CARL500_CLASSES_PATH . 'date-classes.php');

// Load the Indisponibility classes
require_once( CARL500_CLASSES_PATH . 'indisponibility-classes.php');


?>
