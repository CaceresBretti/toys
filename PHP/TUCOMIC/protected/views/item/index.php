<?php
/* @var $this ItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Items',
);

$this->menu=array(
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<h1>Mis Items</h1>

<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>

<?php
$nombre = Yii::app()->user->name;
$userx=Users::model()->findByAttributes(array('name'=>$nombre));
$criteria = new CDbCriteria;
$criteria->condition = 'id_user=:id_user';
$criteria->params=array(':id_user'=>$userx->id);
$results = Item::model()->findAll($criteria);
echo "<div>";
if (!empty ($results)){
	echo "<div>";
	foreach($results AS $model){
		echo "<div  style=\"float:left;\">";
			$foto =Foto::model()->findByAttributes(array('id_item'=>$model->id));
			//if(count($foto)){
			if ( !empty($foto)){
				//$archId = $this->archive($foto);
				//if(!count($archId)){
				$path = "protected/extensions/foto_upload/server/php/files/$model->id/$foto->nombre";
				//}
			}
			else{
				$path="files/img/comicbooks.png";
			}
			$link="index.php?r=item/view&id=$model->id";
			echo "<a href=\"$link\"><img style=\"width: 85px; height: 95px\" src=\"$path\"></a>";
		echo "</div>";
		echo "<div  style=\"float:left;\">";
			echo "<b>Nombre:</b> $model->nombre <br>";
			echo "<b>Precio:</b> $ $model->precio </br>";
			echo "<b>Genero:</b> $model->genero <br>";
			echo "<a href=\"$link\">ver</a>";
		echo "</div>";
		echo "<div  style=\"float:left;\">";
			echo $model->estado;
		echo "</div>";
		echo "<br><br><br><br><br>";
	}
	echo "</div>";
}else{
echo "No hay items";
}
?>
