<?php
/* @var $this FotoController */
/* @var $model Foto */

$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Foto', 'url'=>array('index')),
	array('label'=>'Create Foto', 'url'=>array('create')),
	array('label'=>'Update Foto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Foto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Foto', 'url'=>array('admin')),
);
?>

<h1>View Foto #<?php echo $model->id; ?></h1>

<center>
<?php
echo "<img style=\"width: 250px;\" src=\"files/img/$model->id_item/$model->nombre\">";
?>
</center>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_item',
		'nombre',
	),
)); ?>
