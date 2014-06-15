<?php
/* @var $this CondicionController */
/* @var $model Condicion */

$this->breadcrumbs=array(
	'Condicions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Condicion', 'url'=>array('index')),
	array('label'=>'Create Condicion', 'url'=>array('create')),
	array('label'=>'View Condicion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Condicion', 'url'=>array('admin')),
);
?>

<h1>Update Condicion <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>