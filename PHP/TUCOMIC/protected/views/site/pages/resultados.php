<?php
$query=$_GET["consulta"];
$datos=explode("!",$query);


$criteria=new CDbCriteria();
$criteria->condition='UPPER(nombre) LIKE UPPER(:nombre) AND UPPER(saga) LIKE UPPER(:saga) AND UPPER(numero) LIKE UPPER(:numero) AND UPPER(editorial) LIKE UPPER(:editorial) AND UPPER(escritor) LIKE UPPER(:escritor) AND UPPER(dibujante) LIKE UPPER(:dibujante) AND UPPER(genero) LIKE UPPER(:genero) AND UPPER(idioma) LIKE UPPER(:idioma) AND precio > :desde AND precio < :hasta AND estado = :estado'; 
$criteria->params=array(':nombre' => "%$datos[0]%", ':saga' => "%$datos[1]%",':numero' => "%$datos[2]%", ':editorial' => "%$datos[3]%",':escritor' => "%$datos[4]%", ':dibujante' => "%$datos[5]%", ':genero' => "%$datos[6]%", ':idioma' => "%$datos[7]%", ':desde' => "$datos[8]", ':hasta' => "$datos[9]", ':estado' => "$datos[10]") ;
$results = Item::model()->findAll($criteria);
      foreach($results AS $model ){
			//array_push($sumas, (int)$model->contador);
                        //array_push($fechas, $model->fecha);
                        $foto = Foto::model()->findByAttributes(array('id_item'=>$model->id));
                        $estado = Estados::model()->findByAttributes(array('id'=>$model->estado));
                        if ( !empty($foto)){
	                        $path = "protected/extensions/foto_upload/server/php/files/".$model->id."/".$foto->nombre;
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
