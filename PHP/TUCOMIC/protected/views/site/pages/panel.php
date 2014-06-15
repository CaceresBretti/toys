<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Panel';
$this->breadcrumbs=array(
	'Panel',
);


$nombre = Yii::app()->user->name;
$userx=Users::model()->findByAttributes(array('name'=>$nombre));

?>
<link href="protected/extensions/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<h1>Panel</h1>
<div>
  <div>
  <?php
        $foto="files/img/user.png";
	    if($userx->foto != "none"){
		    $foto="files/users/$userx->id/$userx->foto";
        }
	echo "<img style=\"width: 135px; height:135px\" src=\"$foto\">";
?>
  </div>
</div>

<div>
	<h3>Reputación :</h3>
	<?php 
	if ($userx->reputacion >= 0 && $userx->reputacion <0.2){
		echo "<font color=\"red\">Mala</font>";
	}
	if ($userx->reputacion >= 0.2 && $userx->reputacion <=0.5){
		echo "<font color=\"orange\">Regular</font>";
	}
	if ($userx->reputacion > 0.5 && $userx->reputacion <=0.7){
		echo "<font color=\"blue\">Buena</font>";
	}
	if ($userx->reputacion > 0.7 && $userx->reputacion <=1){
		echo "<font color=\"green\">Muy Buena</font>";
	}
	?>
	<br><br>
</div>

<div  >
        <h3>Publicaciones :</h3><br>
	<table class="table table-striped">
	<tr><td><b>Nombre</b></td><td><b>Precio:</b></td><td><b>Estado:</b></td><td></td></tr>
        <?php
	//PUBLICACIONES
        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'id DESC';
        $criteria->condition = 'id_user=:iduser';
        $criteria->params=array(':iduser'=>$userx->id);
        $results = Item::model()->findAll($criteria);
        foreach($results AS $model ){
		$edo=Estados::model()->findByAttributes(array('id'=>$model->estado));
                echo "<tr><td> $model->nombre </b></td><td> $model->precio </td><td> $edo->nombre </td><td><a href=\"index.php?r=item/view&id=$model->id\">Editar</a></td></tr>";
        }
        ?>
	</table>
</div>


<div>
<?php
//VERIFICA QUE EL USUARIO ESTE LOGEADO
if(!empty($userx)){
	//PANEL USER ADMIN
	if(!Yii::app()->user->isGuest && $userx->rol ==1){
		//GRAFICO DE VISITAS
		echo "<br><br><br><br><br><br><br><br>";
	        $criteria = new CDbCriteria;
	        $criteria->select = 'sum(contador) as contador, id,fecha';
	        $criteria->limit = 4;
	        $criteria->group = 'fecha, id';
	        $criteria->order = 'id DESC';
	        $results = Visitas::model()->findAll($criteria);
	        $sumas= array(0);
	        $fechas=array('2013-11-08');
	        foreach($results AS $model ){
	                array_push($sumas, (int)$model->contador);
	                array_push($fechas, $model->fecha);
	        }

	        $this->widget('ext.highcharts.HighchartsWidget', array(
	           'options'=>array(
        	      'chart' => array('width'=>700),
	              'title' => array('text' => 'Vistas del sitio web'),
	              'xAxis' => array(
	                 'categories' => $fechas
	              ),
	              'yAxis' => array(
	                 'title' => array('text' => 'Numero de Visitas')
	              ),
	              'series' => array(
	                 array('name' => 'MeteRuido.cl', 'data' => $sumas)
	              )
	           )
	        ));
	        ?>
	</div>
	<?php
	}
	//PANEL USER NORMAL
	else {
		//echo "hola";
	}
//SI EL USUARIO NO ESTA LOGEADO
}
else {
               throw new CHttpException(300, 'Usted no tiene acceso a este sitio');
}

?>

