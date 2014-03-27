<?php

/**
* @Conexion con la Base de datos
*/
class DB extends SQLite3 {
  function __construct( $file ) {
    $this->open( $file, SQLITE3_OPEN_READWRITE );
   }
}

function db_connect() {
    $db = new DB('bdd/mdd.db');
    if ($db->lastErrorMsg() != 'not an error') {
        print "Database Error: " . $db->lastErrorMsg() . "<br />"; //Does not get triggered
    }
    return $db;
}


/**
* @Modelo para tabla Usuarios
*/
class Usuarios{
    var $DB;
    function conn(){
        $this->DB= db_connect();
    }

    function get_nombre($id){
        try{
            $query = "select nombre from usuarios where id=$id";
            $result = $this->DB->query($query);
            if ($res = $result->fetchArray(SQLITE3_ASSOC)){
                return $res['nombre'];
            }
            else{
    	        return "None";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

  function get_id($nombre){
    try{
      $query = "select id from usuarios where nombre='$nombre'";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['id'];
      }
      else{
	    return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }

  function login($nombre, $passwd){
      try{
          $pass=sha1($passwd);
          $query = "select rol from usuarios where nombre='$nombre' and passwd='$pass'";
          $result = $this->DB->query($query);
          if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    //echo "id".$res['id'];
    	    return $res['rol'];
          }
          else{
	    //echo "null";
    	    return 0;
          }
        }
        catch (Exception $e){
    	    echo $e->getMessage();
        }
    $this->DB->close();
  }

  function get_rol($id){
    try{
      $query = "select rol from usuarios where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['rol'];
      }
      else{
    	return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }

  function rol($nombre){
    try{
      $query = "select rol from usuarios where nombre=$nombre";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['rol'];
      }
      else{
    	return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }  

	function listar_rol(){
        try{
            $result = $this->DB->query("select * from rol order by id;");          
			
			echo "<select name='rol'>";
			while ($res = $result->fetchArray(SQLITE3_ASSOC)){
				$id = $res['id'];
				$rol = $res['nombre'];

				echo "<option value='$id'>$rol</option>";
			}
			echo "</select>";
			
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }
  
	function listar_usuarios(){
        try{
            $result = $this->DB->query("select rol.nombre as rol, usuarios.nombre as nombre from usuarios, rol where usuarios.rol = rol.id order by rol;");          
			
			echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ROL </b></td> <td><b> Usuario</b> </td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			$rol = $res['rol'];
			$nombre = $res['nombre'];
			echo "<tr>";
			echo "<td> $rol </td>"; 
			echo "<td> $nombre </td>";
			echo "</tr>";
		    }
	   	    echo "</table></center>";		
			
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }  

  function listar_form_delete(){
		try{
		    $result = $this->DB->query("select rol.nombre as rol, usuarios.nombre as nombre, usuarios.id as id from usuarios, rol where usuarios.rol = rol.id order by rol;");          
			
	        echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ROL </b></td> <td><b> Usuario </b> </td><td><b>Borrar</b></td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
				$rol = $res['rol'];
				$nombre = $res['nombre'];
				$id = $res['id'];
				echo "<form action='borrar_usuario.php' method='post'>";
				echo "<tr>";
				echo "<td> $rol </td>"; 
				echo "<td> $nombre </td>";
				echo "<input type='hidden' name='nombre' value='$nombre'>";				
				echo "<input type='hidden' name='id' value='$id'>";				
				echo "<td><button type='submit' name='delete_user' class='btn btn-danger'>Borrar</button></td>";
				echo "</tr></form>";
		    }
	   	    echo "</table></center>";
		
		}
		catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  
  }
  
  function insert($nombre, $rol, $passwd){
    $pass = sha1($passwd);
    $query =  $this->DB->exec("INSERT INTO usuarios(nombre,rol, passwd) VALUES ('$nombre', $rol, '$pass');");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
    $this->DB->close();
  }

  
  
  function delete($id){
    $query =  $this->DB->exec("DELETE FROM usuarios WHERE id='$id';");
        /*if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }*/
    $this->DB->close();
  }  
  
    function update_nombre($id, $nombre){
        $query =  $this->DB->exec("update usuarios set nombre='$nombre' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();

    }

    function update_rol($id, $rol){
        $query =  $this->DB->exec("update usuarios set rol=$rol where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();

    }

    function update_passwd($id, $passwd){
        $pass = sha1($passwd);
        $query =  $this->DB->exec("update usuarios set passwd='$pass' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }
}


/**
* @Modelo para tabla Aeronave
*/
class Aeronave{
    var $DB;
    function conn(){
        $this->DB= db_connect();
    }

    function get_limite_pasajeros($id){
        try{
            $query = "select limite_pasajeros from aeronave where id=$id";
            $result = $this->DB->query($query);
            if ($res = $result->fetchArray(SQLITE3_ASSOC)){
                return $res['limite_pasajeros'];
            }
            else{
                return "None";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

  function get_id_nave_origen($id){
    try{
      $query = "select id_nave_origen from aeronave where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
        return $res['id_nave_origen'];
      }
      else{
        return 0;
      }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();
  }
  
  function get_id_nave_destino($id){
    try{
      $query = "select id_nave_destino from aeronave where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
        return $res['id_nave_destino'];
      }
      else{
        return 0;
      }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();
  }

  function get_id_estado($id){
    try{
      $query = "select id_estado from aeronave where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
        return $res['id_estado'];
      }
      else{
        return 0;
      }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();
  }

  function get_fecha_origen($id){
    try{
      $query = "select fecha_origen from aeronave where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
        return $res['fecha_origen'];
      }
      else{
        return 0;
      }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();
  }


  function get_fecha_destino($id){
    try{
      $query = "select fecha_destino from aeronave where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
        return $res['fecha_destino'];
      }
      else{
        return 0;
      }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();
  }

  //Lista de aeronave de una nodriza, con la opción de abordarla.
  function tomar_aeronave($id_nave, $id_pasajero,$caso){
    if($caso == 0){
        try{
		$result = $this->DB->query("select * from aeronave where id_nave_origen=$id_nave"); 	
		echo "<center><table style=\"width:600px\" class=\"table table-striped\">";
		echo "<tr><td><b> ID </b></td> <td><b> Capacidad </b> <td><b>Origen</b></td> <td><b>Destino</b></td> <td><b> Fecha de origen </b> <td><b> Fecha de llegada</b> </td><td><b>Abordar</b></td></tr> ";
		while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			echo "<tr>";
			echo "<td><a href='ver_aeronave.php?id=".$res['id']."'>Nave ".$res['id']."</a></td>"; 
			echo "<td> ".$res['limite_pasajeros']." </td>";
			  $query = "select nombre from nave_nodriza where id='".$res['id_nave_origen']."'";
			  $result = $this->DB->query($query);
			  if ($res2 = $result->fetchArray(SQLITE3_ASSOC)){
			  echo "<td>".$res2['nombre']."</td>";
			  }
			  $query = "select nombre from nave_nodriza where id='".$res['id_nave_destino']."'";
			  $result = $this->DB->query($query);
			  if ($res3 = $result->fetchArray(SQLITE3_ASSOC)){
			  echo "<td>".$res3['nombre']."</td>";
			  }
			echo "<td> ".$res['fecha_origen']." </td>";
			echo "<td> ".$res['fecha_destino']." </td>";
			echo "<td><a href=\"do_tomar_nave.php?id=".$res['id']."&pj=$id_pasajero\" class=\"btn btn-primary\" role=\"button\">Abordar</a></td>";
			echo "</tr>";
		}
	   	echo "</table></center>";
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
    }
    else if ($caso == 1){
        $query =  $this->DB->exec("update pasajero set id_nave=$id_nave where id=$id_pasajero;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $query2 =  $this->DB->exec("update pasajero set tipo_nave=1 where id=$id_pasajero;");
        if (!$query2) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
	  $ticket="N$id_nave@".rand(0, 500);
	  $query3 =  $this->DB->exec("update pasajero set ticket='$ticket' where id=$id_pasajero;");
	  if (!$query3) {
	      die("Database transaction failed: " . $this->DB->lastErrorMsg() );
	  }
	  echo "<center>";
	  echo "<div style=\"width:500\" class='alert alert-success'><a href='#' class='alert-link'>El Pasajero esta en la Aeronave!.</a></div>";
	  echo "<a href=\"add_pasajero_form.php\" class=\"btn btn-primary\" role=\"button\">Volver</a>";
	  echo "</center>";
    $this->DB->close();
    }
  }  
  
	function listar_aeronave(){
        try{
            //$result = $this->DB->query("select * from aeronave order by id_nave_origen;");          
			$result = $this->DB->query("select aeronave.id as id, limite_pasajeros, a.nombre as origen, b.nombre as destino, fecha_origen, fecha_destino from aeronave JOIN nave_nodriza as a ON id_nave_origen = a.id JOIN nave_nodriza as b ON id_nave_destino = b.id order by aeronave.id;");          
			
			echo "<center><table style=\"width:600px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ID </b></td> <td><b> Capacidad </b> <td><b>Origen</b></td> <td><b>Destino</b></td> <td><b> Fecha de origen </b> <td><b> Fecha de llegada</b> </td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			$id = $res['id'];
			$capacidad = $res['limite_pasajeros'];
			$fecha_origen = $res['fecha_origen'];
			$fecha_destino = $res['fecha_destino'];
			$origen = $res['origen'];
			$destino = $res['destino'];
			
			
			echo "<tr>";
			echo "<td><a href='ver_aeronave.php?id=$id'>Nave $id </a></td>"; 
			echo "<td> $capacidad </td>";
			echo "<td> $origen </td>";
			echo "<td> $destino </td>";
			echo "<td> $fecha_origen </td>";
			echo "<td> $fecha_destino </td>";
			echo "</tr>";
		    }
	   	    echo "</table></center>";		
			
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }    
  
    //Imprime todos los datos de la nave nodriza
  function get_datos($id){
      echo "<center><h3>Aeronave</h3></center>";
      echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
      try{
        $query = "select * from aeronave where id='$id'";
        $result = $this->DB->query($query);
        if ($res = $result->fetchArray(SQLITE3_ASSOC)){
            echo "<tr>";
            echo "<td><b>ID</b></td><td>".$res['id']."</td>";
            echo "</tr><tr>";
            echo "<td><b>Limite Pasajeros</b></td><td>".$res['limite_pasajeros']."</td>";
            echo "</tr><tr>";
              $query = "select nombre from nave_nodriza where id='".$res['id_nave_origen']."'";
              $result = $this->DB->query($query);
	      if ($res2 = $result->fetchArray(SQLITE3_ASSOC)){
		echo "<td><b>Nave Origen</b></td><td>".$res2['nombre']."</td>";
	      }
            echo "</tr><tr>";
              $query = "select nombre from nave_nodriza where id='".$res['id_nave_destino']."'";
              $result = $this->DB->query($query);
	      if ($res3 = $result->fetchArray(SQLITE3_ASSOC)){
		echo "<td><b>Nave Origen</b></td><td>".$res3['nombre']."</td>";
	      }
            echo "</tr><tr>";
            echo "<td><b>Estado</b></td><td>".$res['id_estado']."</td>";
            echo "</tr><tr>";
            echo "<td><b>Fecha Oringe</b></td><td>".$res['fecha_origen']."</td>";
            echo "</tr><tr>";
            echo "<td><b>Fecha Destino</b></td><td>".$res['fecha_destino']."</td>";
            echo "</tr>";
        }
        else{
            echo "<tr>";
            echo "<td><b>No hay datos</b></td>";
            echo "</tr>";
        }
      echo "</table></center>";
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();

  }
  
	function listar_aeronave_en_nodriza($id_nodriza){
        try{
            $result = $this->DB->query("select * from aeronave where id_nave_origen='$id_nodriza' AND id_estado='1' order by id;");          
			
			echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ID </b></td> <td><b> Capacidad </b> </td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
				$id = $res['id'];
				$capacidad = $res['limite_pasajeros'];
				$fecha_origen = $res['fecha_origen'];
				$fecha_destino = $res['fecha_destino'];
				echo "<tr>";
				echo "<td><a href='ver_aeronave.php?id=$id'>Nave $id</a> </td>"; 
				echo "<td> $capacidad </td>";
				echo "</tr>";
		    }
	   	    echo "</table></center>";
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }
  
  
  function insert($limite_pasajeros, $id_nave_origen, $id_nave_destino, $id_estado, $fecha_origen, $fecha_destino){
    $query =  $this->DB->exec("INSERT INTO aeronave(limite_pasajeros, id_nave_origen, id_nave_destino, id_estado, fecha_origen, fecha_destino) VALUES ($limite_pasajeros, $id_nave_origen, $id_nave_destino, $id_estado, '$fecha_origen', '$fecha_destino');");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
    $this->DB->close();
  }

  function delete($id){
    $query =  $this->DB->exec("DELETE FROM aeronave WHERE id='$id';");
        /*if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }*/
    $this->DB->close();
  } 

  function listar_form_delete(){
		try{
		    $result = $this->DB->query("select aeronave.id as id, nave_nodriza.nombre as nombre, limite_pasajeros, fecha_origen, fecha_destino from aeronave, nave_nodriza where id_estado=1 and id_nave_origen = nave_nodriza.id order by nave_nodriza.nombre;");          
			
	        echo "<center><table style=\"width:600px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ID </b></td> <td><b> Nave Nodriza </b> </td> <td><b> Limite pasajeros </b></td> <td><b> Fecha origen </b></td> <td><b> Fecha salida </b></td> <td><b>Borrar</b></td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){				
				$nombre = $res['nombre'];
				$id = $res['id'];
				$capacidad = $res['limite_pasajeros'];
				$fecha_origen = $res['fecha_origen'];
				$fecha_destino = $res['fecha_destino'];
				echo "<form action='borrar_aeronave.php' method='post'>";
				echo "<tr>";
				echo "<td> $id </td>"; 
				echo "<td> $nombre </td>";
				echo "<td> $capacidad </td>";
				echo "<td> $fecha_origen </td>";
				echo "<td> $fecha_destino </td>";
				echo "<input type='hidden' name='id' value='$id'>";				
				echo "<td><button type='submit' name='delete_aeronave' class='btn btn-danger'>Borrar</button></td>";
				echo "</tr></form>";
		    }
	   	    echo "</table></center>";
		
		}
		catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  
  }
  
  
  
    function update_limite_pasajeros($id, $limite_pasajeros){
        $query =  $this->DB->exec("update aeronave set limite_pasajeros=$limite_pasajeros where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();

    }

    function update_id_nave_origen($id, $id_nave_origen){
        $query =  $this->DB->exec("update aeronave set id_nave_origen=$id_nave_origen where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();

    }

    function update_id_nave_destino($id, $id_nave_destino){
        $query =  $this->DB->exec("update aeronave set id_nave_destino=$id_nave_destino where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }

    function update_id_estado($id, $id_estado){
        $query =  $this->DB->exec("update aeronave set id_estado=$id_estado where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }

    function update_fecha_origen($id, $fecha_origen){
        $query =  $this->DB->exec("update aeronave set fecha_origen='$fecha_origen' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }

    function update_fecha_destino($id, $fecha_destino){
        $query =  $this->DB->exec("update aeronave set fecha_destino='$fecha_destino' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }
}

/**
* @Modelo para tabla Nave_Nodriza
*/
class NaveNodriza{
    var $DB;
    function conn(){
        $this->DB= db_connect();
    }
    
    
   function listar_nave_nodriza_box(){
        try{
            $result = $this->DB->query("select * from nave_nodriza order by id;");          
			
			echo "<select name='id_nave'>";
			while ($res = $result->fetchArray(SQLITE3_ASSOC)){
				$id = $res['id'];
				$rol = $res['nombre'];
				echo "<option value='$id'>$rol</option>";
			}
			echo "</select>";
			
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

    //COMENTAR FUNCION!!!!
    function get_count(){
        try{
            $query = "select count(*) as count from nave_nodriza;";
            $result = $this->DB->query($query);
            if ($res = $result->fetchArray(SQLITE3_ASSOC)){
                return $res['count'];
            }
            else{
    	        return "None";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
    }

    //Lista de naves nodrizas
    function get_listar($type){
        try{
            $result = $this->DB->query("select * from nave_nodriza order by id;");
           if($type == "1"){ //TABLE
	        echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
		    echo "<tr><td><b> ID </b></td> <td><b> Nave Nodriza</b> </td><td><b>Ver</b></td></tr> ";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			$id = $res['id'];
			$nombre = $res['nombre'];
			echo "<tr>";
			echo "<td><a href='ver_nodriza.php?id=$id'> $id </a></td>"; //link a la vista de la nave nod..
			echo "<td> $nombre</td>";
            echo "<td><a href=\"ver_nodriza.php?id=$id\" class=\"btn btn-primary\" role=\"button\">Ver</a></td>";
			echo "</tr>";
		    }
	   	    echo "</table></center>";
	     }
	    if($type == "2"){ //SELECT
		    echo "<select name='origen'>";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			$id = $res['id'];
			$nombre = $res['nombre'];

			echo "<option value='$id'>$nombre</option>";
		    }
		    echo "</select>";
           }
	    if($type == "3"){ //SELECT
		    echo "<select name='destino'>";
		    while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			$id = $res['id'];
			$nombre = $res['nombre'];

			echo "<option value='$id'>$nombre</option>";
		    }
		    echo "</select>";
           }

        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

    //Nombre de la nave nodriza
    function get_nombre($id){
        try{
            $query = "select nombre from nave_nodriza where  id=$id;";
            $result = $this->DB->query($query);
            if ($res = $result->fetchArray(SQLITE3_ASSOC)){
                return $res['nombre'];
            }
            else{
    	        return "None";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

  //Obtiene el id de la nave nodriza
  function get_id($nombre){
    try{
      $query = "select id from nave_nodriza where nombre='$nombre'";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['id'];
      }
      else{
	    return "None";
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }

  //Imprime todos los datos de la nave nodriza
  function get_datos($id){
      echo "<center><h3>Nave Nodriza</h3></center>";
      echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
      try{
        $query = "select * from nave_nodriza where id='$id'";
        $result = $this->DB->query($query);
        if ($res = $result->fetchArray(SQLITE3_ASSOC)){
            echo "<tr>";
            echo "<td><b>ID</b></td><td>".$res['id']."</td>";
            echo "</tr><tr>";
            echo "<td><b>Nombre</b></td><td>".$res['nombre']."</td>";
            echo "</tr>";
        }
        else{
            echo "<tr>";
            echo "<td><b>ID</b></td><td> - </td>";
            echo "<td><b>Nombre</b></td><td> - </td>";
            echo "</tr>";
        }
      echo "</table></center>";
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    $this->DB->close();

  }

  function insert($nombre){
    $query =  $this->DB->exec("insert into nave_nodriza(nombre) values ('$nombre')");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
    $this->DB->close();
  }

    function update_nombre($id, $nombre){
        $query =  $this->DB->exec("update nave_nodriza set nombre='$nombre' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }

}




/**
* @Modelo para tabla Pasajero
*/
class Pasajero{
    var $DB;
    function conn(){
        $this->DB= db_connect();
    }

    function get_nombre($id){
        try{
            $query = "select nombre from pasajero where id=$id";
            $result = $this->DB->query($query);
            if ($res = $result->fetchArray(SQLITE3_ASSOC)){
                return $res['nombre'];
            }
            else{
    	        return "None";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }

  function get_id($nombre){
    try{
      $query = "select id from usuarios where nombre='$nombre'";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['id'];
      }
      else{
	    return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }

  //Retorna el id de alguna aeronave (para saber en q nave esta el pasajero)
  function get_id_nave($id){//id del pasajero
    try{
      $query = "select id_nave from pasajero where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['id_nave'];
      }
      else{
    	return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }
  //Retorna pasajeros de una aeronave
  function get_pasajeros_nave($id_nave, $tipo_nave){//id del pasajero
    echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
    echo "<tr>";
      echo "<td><b>ID</b></td>";
      echo "<td><b>Nombre</b></td>";
      echo "<td><b>ID Aeronave</b></td>";
      echo "<td><b>Tiket</b></td>";
      echo "<td><b>Tipo Nave</b></td>";
      echo "<td><b>Tomar Vuelo</b></td>";
    echo "</tr>";
    try{
      $query = "select * from pasajero where id_nave=$id_nave and tipo_nave=$tipo_nave order by id";
      $result = $this->DB->query($query);
      while ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    echo "<tr>";
	      echo "<td>".$res['id']."</td>";
	      echo "<td>".$res['nombre']."</td>";
	      echo "<td>".$res['id_nave']."</td>";
	      echo "<td>".$res['ticket']."</td>";
	      //echo "<td>".$res['tipo_nave']."</td>";
	      
	      if ($res['tipo_nave']==1){
		echo "<td>Aeronave</td>";
	      }
	      if($res['tipo_nave']==0){
		echo "<td>Nave Nodriza</td>";
		echo "<td><a href=\"tomar_vuelo.php?id=".$res['id_nave']."&pj=".$res['id']."\" class=\"btn btn-default\" role=\"button\">Tomar Vuelo</a></td>";
	      }
	      
	      echo "</tr>";
      }
     
      echo "</table></center>";
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }
  
    //Retorna 0 el id_nave es de una nave nodriza, 1 el id_nave es de una aeronave
  function get_id_tipo_nave($id){//id del pasajero
    try{
      $query = "select tipo_nave from pasajero where id=$id";
      $result = $this->DB->query($query);
      if ($res = $result->fetchArray(SQLITE3_ASSOC)){
	    return $res['tipo_nave'];
      }
      else{
    	return 0;
      }
    }
    catch (Exception $e){
	    echo $e->getMessage();
    }
    $this->DB->close();
  }
    //Lista de TODOS los pasajeros
   function listar_pasajeros(){
        try{
            $result = $this->DB->query("select * from pasajero order by id DESC");          
			
		echo "<center><table style=\"width:650px\" class=\"table table-striped\">";
		echo "<tr><td><b> ID </b></td> <td><b> Nombre</b> </td><td><b>Nave</b></td><td><b>Tipo Nave</b></td><td><b>Ticket</b></td><td><b>Borrar</b></td><td><b>Tomar Vuelo</b></td></tr> ";
		while ($res = $result->fetchArray(SQLITE3_ASSOC)){
		
			echo "<tr>";
			echo "<td>".$res['id']." </td>"; 
			echo "<td>".$res['nombre']."</td>";
			echo "<td>".$res['id_nave']."</td>";
		
			if($res['tipo_nave']==0){
			  echo "<td>Nodriza - ";
		
			  $result2 = $this->DB->query("select nombre from nave_nodriza where id=".$res['id_nave'].";");
			  if ($res2 = $result2->fetchArray(SQLITE3_ASSOC)){
			    echo $res2['nombre'];
			  }
		
			  echo "</td>";
			}
			if($res['tipo_nave']==1){
			  echo "<td>Aeronave</td>";
			}
		
			echo "<td>".$res['ticket']."</td>";
			echo "<td><a href=\"del_pasajero.php\" class=\"btn btn-danger\" role=\"button\">Borrar</a></td>";
			if($res['tipo_nave']==0){
			 echo "<td><a href=\"tomar_vuelo.php?id=".$res['id_nave']."&pj=".$res['id']."\" class=\"btn btn-default\" role=\"button\">Tomar Vuelo</a></td>";
			}
			echo "</tr>";
		
		}
	        echo "</table></center>";		
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  }  
 //Lista de una cantidad determinada de pasajero
 function listar_pasajero_nave($id_nave){
        try{
            $result = $this->DB->query("select * from pasajero where id_nave=$id_nave order by id;");          
			
		echo "<center><table style=\"650x\" class=\"table table-striped\">";
		echo "<tr><td><b> ID </b></td> <td><b> Nombre</b> </td><td><b>Aeronave</b></td><td><b>Ticket</b></td></tr> ";
		while ($res = $result->fetchArray(SQLITE3_ASSOC)){
			echo "<tr>";
			echo "<td>".$res['id']." </td>"; 
			echo "<td>".$res['nombre']."</td>";
			echo "<td>".$res['id_nave']."</td>";
			echo "<td>".$res['ticket']."</td>";
			echo "</tr>";
		}
	        echo "</table></center>";		
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    $this->DB->close();
  } function update_ticket($id, $ticket){
        $query =  $this->DB->exec("update pasajero set ticket=$ticket where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }

    function update_id_nave($id, $id_nave){
        $pass = sha1($passwd);
        $query =  $this->DB->exec("update pasajero set id_nave='$id_nave' where id=$id;");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
        $this->DB->close();
    }
    

    function insert($nombre, $id_nave, $ticket, $tipo_nave){
    $query =  $this->DB->exec("insert into pasajero(nombre, id_nave, ticket, tipo_nave) values ('$nombre', $id_nave, '$ticket', $tipo_nave)");
        if (!$query) {
            die("Database transaction failed: " . $this->DB->lastErrorMsg() );
        }
    $this->DB->close();
  }

    
}

?>
