<?php if($_GET['type']=='status'): ?>
	<?php update_run($_GET['id'],$_GET['status']); ?>
<?php endif; ?>

<?php if($_GET['type']=='display_driver'): ?>
	<?php 

//à remodifier quand les vérifs marcheront
// $available=get_available_drivers(get_unavailable_drivers($_GET['min_date'].' '.$_GET['min_hour'], $_GET['max_date'].' '.$_GET['max_hour']));
$available = get_all_id_name_driver(1);	
echo '<option value=""></option>';
foreach($available as $a_available){

	echo '<option value="'.$a_available['id'].'">'.$a_available['first_name'].' '.$a_available['last_name'].'</option>';

}
?>
<?php endif; ?>

<?php if($_GET['type']=='display_car'): ?>
	<?php 
//echo get_unavailable_cars($_GET['min_date'].' '.$_GET['min_hour'], $_GET['max_date'].' '.$_GET['max_hour'])
//à remodifier quand les vérifs marcheront
//$available=get_available_cars(get_unavailable_cars($_GET['min_date'].' '.$_GET['min_hour'], $_GET['max_date'].' '.$_GET['max_hour']));
$available = get_all_id_name_car(1);	
echo '<option value=""></option>';
foreach($available as $a_available){

	echo '<option value="'.$a_available['id'].'">'.$a_available['model'].'</option>';

}
?>
<?php endif; ?>
