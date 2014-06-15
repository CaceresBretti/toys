<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
$nombre = Yii::app()->user->name;
//echo $nombre;
if ($nombre != "Guest"){
	$userx=Users::model()->findByAttributes(array('name'=>$nombre));
	if($userx->rol==1){
		$this->menu=array(
			array('label'=>'List Users', 'url'=>array('index')),
			array('label'=>'Manage Users', 'url'=>array('admin')),
		);
	}
}
?>

<h1>Create Users</h1>
	<h3>Regístrate con facebook</h3>
	<p>Regístrate con tu cuanta de facebook</p>
       <?php 
            $cc = Yii::app()->crugeconnector;
            foreach($cc->enabledClients as $key=>$config){
                $image = CHtml::image($cc->getClientDefaultImage($key));
                echo "<li>".CHtml::link($image,
                    $cc->getClientLoginUrl($key))."</li>";
            }
        ?>
	<br><br>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
