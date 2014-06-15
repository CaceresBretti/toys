<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */

$nombre = Yii::app()->user->name;
$userx=Users::model()->findByAttributes(array('name'=>$nombre));


?>
<script type="text/javascript" src="protected/views/item/tinymce/tinymce.min.js"></script>
<script>
	tinyMCE.init({
	mode : "textareas",
	editor_selector : "mceEditor",
	theme : "modern",
	theme_advanced_toolbar_location : "top",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	width: 800,
	height: 100,
	});
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'nombre :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'nombre',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'nombre'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'editorial :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'editorial',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'editorial'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'precio :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'precio'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'precio'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'escritor :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'escritor',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'escritor'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'dibujante :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'dibujante',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'dibujante'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'numero :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'numero',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'numero'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'saga :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textField($model,'saga',array('rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'saga'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'estado :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php /*echo $form->textField($model,'estado');*/ ?>
		<?php echo $form->dropDownList($model,'estado',Estados::model()->getEstados()); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'estado'); ?>
		</div>
	</div>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php /*echo $form->labelEx($model,'id_user');*/ ?>
		</div><div  style="float:left; width:100px;">
		<?php /*echo $form->textField($model,'id_user');*/ ?>
		<?php echo $form->hiddenField($model,'id_user', array('value'=>$userx->id)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'id_user'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'condicion :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php /*echo $form->textField($model,'condicion');*/ ?>
		<?php echo $form->dropDownList($model,'condicion',Condicion::model()->getCondiciones()); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'condicion'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'genero :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php /*echo $form->textField($model,'genero');*/ ?>
                <?php echo $form->dropDownList($model,'genero',Genero::model()->getGeneros()); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'genero'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'idioma :'); ?>
		</div><div  style="float:left; width:100px;">
		<?php /*echo $form->textField($model,'idioma');*/ ?>
                <?php echo $form->dropDownList($model,'idioma',Idioma::model()->getIdiomas()); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'idioma'); ?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div  style="float:left; width:100px;">
		<?php echo $form->labelEx($model,'descripcion '); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->textArea($model,'descripcion',array('class'=>'mceEditor','rows'=>6, 'cols'=>50)); ?>
		</div><div  style="float:left; width:100px;">
		<?php echo $form->error($model,'descripcion'); ?>
		</div>
	</div>
	<br><br><br>
	<br><br><br>
	<br><br><br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
