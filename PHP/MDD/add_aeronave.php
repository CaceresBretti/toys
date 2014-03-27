 
<!-- BEGIN INIT -->
<?php 
include ('bdd/sqlite.php');
include('lib/check.php');

$today = date("Y-m-d");

$capacidad=$_POST['capacidad'];
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$fecha_origen=$today . " " . $_POST['start-time'].":00";
$fecha_destino=$today . " " . $_POST['end-time'].":00";


if($capacidad == ""){
	header('Location: panel.php');
}

?>
<?php include('lib/init.php'); ?>

<!-- END INIT -->

<!-- BEGIN MENU  -->

<?php include('lib/menu.php'); ?>

<!-- END MENU -->

<!-- BEGIN CENTER -->
<center>

<?php

$aeronave= new Aeronave;
$aeronave->conn();

$aeronave->insert($capacidad,$origen,$destino,1,$fecha_origen,$fecha_destino);
echo "<div class='alert alert-success'><a href='#' class='alert-link'>La Aeronave ha sido agregada exitosamente.</a></div>"; 


?>
  

</center>
<!-- END CENTER -->

<!-- BEGIN FOOTER -->

<?php include('lib/footer.php'); ?>

<!-- END FOOTER -->


<!-- BEGIN BOOTSTRAP -->

<?php include('lib/bootstrap.php'); ?>

<!-- END BOOTSTRAP -->

</html>
