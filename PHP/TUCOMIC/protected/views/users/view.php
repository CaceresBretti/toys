<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);
$nombre = Yii::app()->user->name;
//echo $nombre;
if ($nombre != "Guest"){
	$userx=Users::model()->findByAttributes(array('name'=>$nombre));
	if($userx->rol==1){
		$this->menu=array(
		array('label'=>'List Users', 'url'=>array('index')),
		array('label'=>'Create Users', 'url'=>array('create')),
		array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want todelete this item?')),
		array('label'=>'Manage Users', 'url'=>array('admin')),
		);
	}
}
?>

<h1>View Users #<?php echo $model->id; ?></h1>
<?php
	if($model->foto!="none"){
		$path="files/users/$model->id/$model->foto";
	}
	else{
		$path="files/img/user.png";
	}
?>
<center>
<img src="<?php echo $path; ?>" width="200">
</center>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'name',
		/*'password',
		'facebook',
		'rol',*/
		'email',
		'telefono',
		'reputacion',
		/*'foto',*/
	),
)); ?>
