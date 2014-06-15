<?php
//$query=$_GET["consulta"];
//echo "consulta $query";

$var1 = "super lala";//primer string hasta un espacio
$var2 = "panini";//editorial
echo "hola";
$criteria=new CDbCriteria();
echo "hola";
$criteria->condition='nombre=:nombre and editorial=:edit'; // where
$criteria->params=array(':nombre'=>$var1, ':edit'=>$var2); //pasa los valores
$criteria->limit = 4; //otra cond
$results = Item::model()->findAll($criteria); // ejecuta SQL
       foreach($results AS $model ){
				echo $model->id;
                echo $model->nombre;
                echo $model->precio;
        }
echo "chao";

?>
