<?php
/* @var $this FotoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fotos',
);

$this->menu=array(
	array('label'=>'Create Foto', 'url'=>array('create')),
	array('label'=>'Manage Foto', 'url'=>array('admin')),
);
?>

<h1>Fotos</h1>

<?php /*  $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/  ?>
<?php
if ( empty($_GET['id_item'])){
        throw new CHttpException(1, 'acceso invalido a la URL');
}
else{
	$nombre = Yii::app()->user->name;
	$userx=Users::model()->findByAttributes(array('name'=>$nombre));
	//VERIFICAR QUE EL USUARIO QUE ESTA LOGEADO SEA EL DUEÑO DEL ITEM

        $criteria = new CDbCriteria;
        $criteria->select = 'COUNT(id) as id';
	$criteria->condition='id_user=:id_user';
	$criteria->params=array(':id_user'=>$userx->id);
        $results = Item::model()->findAll($criteria);
	$cont=0;
        foreach($results AS $model ){
		$cont = (int)$model->id;
        }

	if($cont !=0){
		$id_item= $_GET['id_item'];
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_item=:id_item';
		$criteria->params=array(':id_item'=>$id_item);
		$results = Foto::model()->findAll($criteria);
		foreach($results AS $model){
			echo "<div>";
			$path = "protected/extensions/foto_upload/server/php/files/$id_item/$model->nombre";
		        	echo "<div  style=\"float:left;\">";
					echo "<a href=\"$path\"><img style=\"width: 85px; height: 95px\" src=\"$path\"></a>";
				echo "</div>";
		        	echo "<div  style=\"float:left;\">";
					echo "<b>Nombre :</b>";
					echo "<a href=\"index.php?r=foto/view&id=$model->id\">Editar</a>";
				echo "</div>";
			echo "</div>";
			echo "<br><br><br><br><br><br>";
		}
	}
	else{
		throw new CHttpException(300, 'Usted no tiene acceso a este sitio');
	}
}
?>
