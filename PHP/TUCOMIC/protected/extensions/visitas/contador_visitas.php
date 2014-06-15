<?php

function contador_visitas($url){

	//VER SI EXISTE LA URL EN LA FECHA

	$fecha = date("Y-m-d");
	$urlx=Visitas::model()->findByAttributes(array('pagina'=>$url, 'fecha'=>$fecha));

	if(!$urlx){//NO SE HA VISITADO LA PAG EN LA FECHA

		//SE CREA LA VISITA

		$vista= new VISITAS;

		$vista->fecha=$fecha;

		$vista->pagina=$url;

		$vista->contador=1; //ES PRIMERA VES Q SE VISTA EN EL DIA

		$vista->save();

	}

	else{//CONTADOR DENTRO DEL DIA

		//update
                $visita = Visitas::model()->findByPK($urlx->id);
                $visita->contador += 1;
                $visita->update(array('contador'));
	}

}

?>
