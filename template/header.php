<!doctype html>
<html>
<head>
    <title>Carl 500</title>
    <meta http-equiv="Content-Language" content="fr">
<meta http-equiv="content-type" content="text/html" charset="utf-8" />

 <link rel="stylesheet" href="/carl500/style/css/style.css" />
    <link rel="shortcut icon" href="/carl500/style/images/VC2015.jpg">
    
    <script src="/carl500/style/js/jquery-1.9.1.js" > </script>
   
    <script src="/carl500/style/js/bootstrap.js" > </script>
	
	<script src="/carl500/style/js/bootstrap-dropdown.js" > </script>
    
  <link rel="stylesheet" href="/carl500/style/css/jquery-ui.css" />


<link rel="stylesheet" href="/carl500/style/css/datepicker.css">
<!-- Import Javascript codes -->
<script src="/carl500/style/js/jquery-1.8.3.js"></script>
<script src="/carl500/style/js/jquery-ui.js"></script>
<script type="text/javascript" src="/carl500/style/js/jquery.ui.timepicker.js?v=0.3.1"></script>
<!--Datepicker and timepicker -->


	<script>
	$(document).ready(function(){
		$('.action').children().css({opacity: 0.3});
		$('.action').hover( function(){
					$('.action').children().css({opacity: 0.3});
			$(this).children().css({opacity: 1});
		});
	
	   	$(window).hover( function(e){
			if(!$(e.target).hasClass('child')){
				$('.action').children().css({opacity: 0.3});
	   	    }
		});
	});	
	</script>

 

<style type="text/css" media="print">
.non-printable { display: none; }         
</style>

</head>

<body>

    <div style="position: relative; width: 100%" class="non-printable">

        <center>
            <div class="navbar" style="width: 1200px" align= "center">

                <a class="logo_carl500"><img src="/carl500/style/images/carl500.png"/></a> 
                <ul id="menu">
                <li><a class="barlink" href="/carl500/">Accueil</a></li>

        <li>
                <a class="barlink" href="#">RUN</a>
                <ul>
                        <li><a href="/carl500/?page=run&action=add">Ajouter un RUN</a></li>
                        <li><a href="/carl500/?page=run">Liste des RUN</a></li>
                </ul>
        </li>

       

         <li>
                <a class="barlink" href="#">Véhicules</a>
                <ul>
                        <li><a href="/carl500/?page=car&action=add">Ajouter un Véhicule</a></li>
                        <li><a href="/carl500/?page=car">Liste des Véhicules</a></li>
                </ul>
        </li>

         <li>
                <a class="barlink" href="#">Groupes</a>
                <ul>
                        <li><a href="/carl500/?page=band&action=add">Ajouter un Groupe</a></li>
                        <li><a href="/carl500/?page=band">Liste des Groupes</a></li>
                </ul>
        </li>

         <li>
                <a class="barlink" href="#">Personnes</a>
                <ul>
                        <li><a href="/carl500/?page=people&action=add">Ajouter une Personne</a></li>
                        <li><a href="/carl500/?page=people">Liste des Personnes</a></li>
                </ul>
        </li>

         <li>
                <a class="barlink" href="#">Lieux</a>
                <ul>
                        <li><a href="/carl500/?page=location&action=add">Ajouter un Lieu</a></li>
                        <li><a href="/carl500/?page=location">Liste des Lieux</a></li>
                        <li><a href="/carl500/?page=distance">Distance</a></li>
                </ul>
        </li>
        
         
</ul>
</div>
</center>


    </div>

    <div id="container">