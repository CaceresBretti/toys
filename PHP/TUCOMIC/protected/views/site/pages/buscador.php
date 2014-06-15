<?php
$query=$_GET["consulta"];
echo "consulta: " .$query."<br>";

$criteria=new CDbCriteria();
$criteria->condition='UPPER(nombre) LIKE UPPER(:nombre) '; // Pasa a mayusculas query y valor en db
$criteria->params=array(':nombre' => "%$query%") ;
$criteria->limit = 4; //otra cond
$results = Item::model()->findAll($criteria); // ejecuta SQL
      foreach($results AS $model ){
                        //array_push($sumas, (int)$model->contador);
                        //array_push($fechas, $model->fecha);
                        $foto = Foto::model()->findByAttributes(array('id_item'=>$model->id));
                        $estado = Estados::model()->findByAttributes(array('id'=>$model->estado));
                        if ( !empty($foto)){
	                        $path = "foto_upload/server/php/files/".$model->id."/".$foto->nombre;
                        }
                        else{
        	                $path="files/img/comicbooks.png";
                        }
                        echo "<div id= "."contenedor>";
                        echo "<div id="."buscavendereserva".">".$estado->nombre."</div>";
                        echo "<div id="."Foto".">"."<"."img style= "."float:left;"."width='100' height='100'"." src=".$path.">"."</div>";
                        echo "<div id="."Nombre".">"."<A HREF="."index.php?r=item/view&id=".$model->id.">".$model->nombre." </A></div>"."\n";
                        echo "<div id="."Editorial".">Editorial: ".$model->editorial."</div>"."\n";
                        echo "<div id="."Precio".">Precio: ".$model->precio."</div>"."\n";
                        echo "</div>";
                }
?>
