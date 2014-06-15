<!doctype html>
<?php
	$nombre = Yii::app()->user->name;
	$userx=Users::model()->findByAttributes(array('name'=>$nombre));
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo Yii::app()->name ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<script type="text/javascript" src="http://localhost/tucomic/themes/zoocroo/views/layouts/ajax.js"></script>

	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div id="wrapper"><!-- #wrapper -->

	<header><!-- header -->
		<h2><?php echo Yii::app()->name ?></h2>
	</header><!-- end of header -->
	<div>
		<br>
		<form method="GET" >
		<div style="float:left; width:30%"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/logo.png"  width="380" height="100"  alt=""></div>
		<div style="float:left"><input type="text" id="consulta" style="height: 50px;width: 700px" class="barrabuscar" ><div class="divider"></div><input type="button" value="Buscar" class="botonbuscar" onclick="buscar()"></div>
		<div style="float:left; width:60%"></div>
		</form>
	</div>
	<nav><!-- top nav -->
		<div class="menu">
            <!--
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a>
			    <ul>
   					<li><a href="#">The Team</a></li>
   					<li><a href="#">History</a></li>
   					<li><a href="">Vision</a></li>
   				</ul>
  			</li>
				<li><a href="#">Products</a>
					<ul>
						<li><a href="#">Widgets</a></li>
						<li><a href="#">Wodgets</a></li>
					</ul>
				</li>
				<li><a href="#">Contact Us</a></li>
			</ul>
            -->
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Inicio', 'url'=>array('/site/index')),
					array('label'=>'Busqueda avanzada', 'url'=>array('/site/page', 'view'=>'busquedaavanzada')),
					/*
					array('label'=>'Se vende', 'url'=>array('/site/index')),
					array('label'=>'Se busca', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Reservas', 'url'=>array('/site/page', 'view'=>'about')),*/
                    /*array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),*/
                    /*array('label'=>'Contacto', 'url'=>array('/site/contact')),*/
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		    array('label'=>'Registro', 'url'=>array('users/create'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
		    array('label'=>'Panel', 'url'=>array('/site/page', 'view'=>'panel'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            )); ?>

		</div>
	</nav><!-- end of top nav -->


	<section id="main"><!-- #main content and sidebar area -->
		<section id="container-zoo"><!-- #container -->
			<section id="content-zoo"><!-- #content -->
                <article>
                    <?php echo $content ?>
                </article>
                <!--
        		<article>
                    <h2><a href="#">Some CSS3 Transform Animation</a></h2>
                    <p>Hover over the nerds below</p>
                    <div class="moveem rotate">
                        <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/nerd1.png" alt="nerd" />
                    </div>
                    <div class="moveem slideright">
                        <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/nerd.png" alt="nerd" />
                    </div>
                </article>
                -->
			</section><!-- end of #content -->
		</section><!-- end of #container -->

		<aside id="sidebar"><!-- sidebar -->
		<?php

				/*
				*	MENU USUARIO
				*	menu de administración de cuenta e items
				*/

					//MENU ADMINISTRADOR
					if (!empty($userx)){
						echo "<h3>Mi Menú</h3>";
						if($userx->rol == 1){
						echo "<ul>";
							echo "<li><a href=\"index.php?r=users/admin\">Administrar Usuarios</a></li>";
							echo "<li><a href=\"index.php?r=item/admin\">Administrar Items</a></li>";
							echo "<li><a href=\"index.php?r=foto/admin\">Administrar Fotos</a></li>";
							echo "<li><a href=\"index.php?r=estados/admin\">Administrar Estados</a></li>";
							echo "<li><a href=\"index.php?r=condicion/admin\">Administrar Condiciones</a></li>";
							echo "<li><a href=\"index.php?r=genero/admin\">Administrar Generos</a></li>";
							echo "<li><a href=\"index.php?r=idioma/admin\">Administrar idioma</a></li>";
						echo "</ul>";
						}
						//MENU PARA USUARIOS NORMALES
						else{
							echo "<li><a href=\"index.php?r=item\">Mis Items</a></li>";
							echo "<li><a href=\"index.php?r=item\">Mis Compras</a></li>";
							echo "<li><a href=\"index.php?r=item\">Mis Ventas</a></li>";
						}
					}

				//CATEGORIAS
				echo "<h3>Generos</h3>";
				$results_genero = Genero::model()->findAll();
					echo "<ul>";
					foreach($results_genero AS $model){
						echo "<li><a href=\"#\"> $model->nombre </a></li>";
					}
					echo "</ul>";
		?>

				<h3>Editoriales</h3>
					<ul>
						<li><a href="#">Zinco</a></li>
						<li><a href="#">Forum</a></li>
						<li><a href="#">Norma</a></li>
						<li><a href="#">Panini</a></li>
						<li><a href="#">ECC</a></li>
					</ul>
		</aside>
		<!-- end of sidebar -->

	</section><!-- end of #main content and sidebar-->

	<footer>
		<section id="footer-area">

			<section id="footer-outer-block">
					<aside id="first" class="footer-segment">
							<h3>Blogroll</h3>
								<ul>
									<li><a href="#">one linkylink</a></li>
									<li><a href="#">two linkylinks</a></li>
									<li><a href="#">three linkylinks</a></li>
									<li><a href="#">four linkylinks</a></li>
									<li><a href="#">five linkylinks</a></li>
								</ul>
					</aside><!-- end of #first footer segment -->

					<aside id="second" class="footer-segment">
							<h3>Awesome Stuff</h3>
								<ul>
									<li><a href="#">one linkylink</a></li>
									<li><a href="#">two linkylinks</a></li>
									<li><a href="#">three linkylinks</a></li>
									<li><a href="#">four linkylinks</a></li>
									<li><a href="#">five linkylinks</a></li>
								</ul>
					</aside><!-- end of #second footer segment -->

					<aside id="third" class="footer-segment">
							<h3>Coolness</h3>
								<ul>
									<li><a href="#">one linkylink</a></li>
									<li><a href="#">two linkylinks</a></li>
									<li><a href="#">three linkylinks</a></li>
									<li><a href="#">four linkylinks</a></li>
									<li><a href="#">five linkylinks</a></li>
								</ul>
					</aside><!-- end of #third footer segment -->
					
					<aside id="fourth" class="footer-segment">
							<h3>Blahdyblah</h3>
								<p>Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
					</aside><!-- end of #fourth footer segment -->

			</section><!-- end of footer-outer-block -->

		</section><!-- end of footer-area -->
	</footer>

</div><!-- #wrapper -->
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
