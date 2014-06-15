<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{


		return array(
			//crugeconnector (Facebook, Google)
			'crugeconnector'=>array('class'=>'CrugeConnectorAction'),
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),


		);
	}

	/**
	*	Crungeconnector
	*	Login de Facebook o Google
	*/


	public function actionLoginSuccess(){

		$loginData = Yii::app()->crugeconnector->getStoredData();
		// loginData: remote user information in JSON format.
		$info = $loginData;

		//----------//
		//INFO OBTENIDA POR FACEBOOK
		$sustituir = array("id", "name", "first_", "middle_", "last_", "link", "username", "quotes", "favorite_teams", "gender", "timezone", "locale", "verified", "updated_time", "\"", ":", "{", "}");
		$info_filtrada = str_replace($sustituir, "", $info);
		$fb_datos = explode(",", $info_filtrada);
		$id = $fb_datos[0];
		$nombre = $fb_datos[1];
        //$nombre= "l30bravo";
		$first_name = $fb_datos[2];
		$middle_name = $fb_datos[3];
		$last_name = $fb_datos[4];
		$username = $fb_datos[5];
		$quotes = $fb_datos[6];
		$faborite_teams = $fb_datos[7];
		//----------//


		//----------//
		//CONEXION CON LA BASE DE DATOS

        $user=Users::model()->findByAttributes(array('name'=>$first_name));
        //echo "<h1>USER: $user->id</h1>";
        
		if(!$user){
            echo "<h1>ENTRO!!! $id $nombre</h1>";
            //$connection=Yii::app()->db;
            $sql="insert into users (id, name, password, facebook, rol, email, telefono, reputacion, foto) values ('$id', '$first_name', '110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0,2,'test@mail.cl', '1234', 1,'none');";
            $command = Yii::app()->db->createCommand($sql);
            $command->execute();
		}
		//----------//


		//----------//
		//AUTO-LOGIN CON YII
		$identity=new UserIdentity($first_name,"1234");
		$identity->authenticate();
		Yii::app()->user->login($identity);
		//----------//

		//$this->renderText('<h1>Bienvenido!</h1><p>'.$info_filtrada.'</p><p>Nombre: '.$nombre.'</p>');
		//$this->renderText('$mensaje');
        Header("Location: index.php?r=site/page&view=panel");


	}

	public function actionLoginError($message=''){
		$this->renderText('<h1>Login Error</h1><p>'.$message.'</p>');
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}






/*
*	TIME LINE ITEMS
*	Esto es lo que muestra las ultimas ventas en el index
*/

	public function UltimosItems(){
		//UPDATE
                $criteria = new CDbCriteria;
        		//$criteria->select = '*';
                $criteria->limit = 10;
                $criteria->order = 'id DESC';
                $results = Item::model()->findAll($criteria);
		        echo "<div>";
        		echo "<table class=\"table table-striped\">";
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


			echo "<tr><td><img style=\"width:150px; height:'150px';\" src=\"$path\"></td>";
			echo "<td><h4>$model->nombre</h4>$model->editorial<br>$model->precio</td>";
			echo "<td><input type=\"button\" value=\"Comprar\" href=\"#\" class=\"botonbuscar\"></td></tr>";			

			/*
                        echo "<div id= "."contenedor>";
                        echo "<div id="."buscavendereserva".">".$estado->nombre."</div>";
                        echo "<div id="."Foto".">"."<"."img style= "."float:left;"."width='100' height='100'"." src=".$path.">"."</div>";
                        echo "<div id="."Nombre".">"."<A HREF="."index.php?r=item/view&id=".$model->id.">".$model->nombre." </A></div>"."\n";
                        echo "<div id="."Editorial".">Editorial: ".$model->editorial."</div>"."\n";
                        echo "<div id="."Precio".">Precio: ".$model->precio."</div>"."\n";
                        echo "</div>";*/
                }
		echo "</table>";
		echo "</div>";
		//VERSION ANTIGUA
		/*
		$criteria1=new CDbCriteria;
		$criteria1->select='max(id) AS maxid';
		$row = Item::model()->find($criteria1);
		$somevariable = $row['maxid'];
		//echo $somevariable."<br><br><br>";

		for($f=0;$f<=$somevariable;$f++)
		{
			$criteria = new CDbCriteria;
			$criteria->condition = 'id=:itemid';
			$criteria->params=array(':itemid'=>$somevariable);
			$results = Item::model()->findAll($criteria);
			foreach($results AS $model){
				$foto = Foto::model()->findByAttributes(array('id_item'=>$model->id));
				$estado = Estados::model()->findByAttributes(array('id'=>$model->estado));
				//$path = "http://4.bp.blogspot.com/_AQgIg3PNJ2I/TP1G7J2IsQI/AAAAAAAAAGI/Li13nwPBcqQ/2191920556_74dd9bb3a7.jpg";
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
				$somevariable=$somevariable-1;
			}

		}
		*/
	}//fin UltimosItems()
}

