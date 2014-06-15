<?php
/* @var $this CondicionController */
/* @var $model Condicion */

$this->breadcrumbs=array(
	'Condicions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Condicion', 'url'=>array('index')),
	array('label'=>'Create Condicion', 'url'=>array('create')),
	array('label'=>'Update Condicion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Condicion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Condicion', 'url'=>array('admin')),
);
?>

<h1>View Condicion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
