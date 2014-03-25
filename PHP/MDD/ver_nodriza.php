<!-- BEGIN INIT -->
<?php session_start(); ?>
<?php include('lib/init.php'); ?>
<?php include('bdd/sqlite.php'); ?>

<!-- END INIT -->

<!-- BEGIN MENU  -->

<?php include('lib/menu.php'); ?>

<!-- END MENU -->

<!-- BEGIN CENTER -->
<?php
$id=$_GET['id'];
$nave_nodriza= new NaveNodriza;
$nave_nodriza->conn();
$nave_nodriza->get_datos($id);


echo "<center><h3>Aeronaves</h3></center>";
//INVOCAR AERONAVES QUE POSEEAN ID_ORIGEN $id

?>

<!-- END CENTER -->

<!-- BEGIN FOOTER -->

<?php include('lib/footer.php'); ?>

<!-- END FOOTER -->


<!-- BEGIN BOOTSTRAP -->

<?php include('lib/bootstrap.php'); ?>

<!-- END BOOTSTRAP -->

</html>
