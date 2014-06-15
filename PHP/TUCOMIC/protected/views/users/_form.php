<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<h3>Regístrate con nosotros</h3>
	<p>Crea tu cuanta propia</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php 
		$int = rand(0,9);
		$dic = "0987654321";	
		$key=$hoy = date("Ymd");
		$id =$key+ $dic[$int]*10+$dic[$int]*$dic[$int]; 
		//echo "id : $id";
		
	 ?>
		<?php /*echo $form->labelEx($model,'id');*/ ?>
		<?php echo $form->hiddenField($model,'id',array('value'=>$id)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'facebook');*/ ?>
		<?php echo $form->hiddenField($model,'facebook', array('value'=>'0')); ?>
		<?php echo $form->error($model,'facebook'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'rol');*/ ?>
		<?php echo $form->hiddenField($model,'rol', array('value'=>'2')); ?>
		<?php echo $form->error($model,'rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono'); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'reputacion');*/ ?>
		<?php echo $form->hiddenField($model,'reputacion',array('value'=>'1')); ?>
		<?php echo $form->error($model,'reputacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php /*echo $form->textArea($model,'foto',array('rows'=>6, 'cols'=>50));*/ ?>
		<?php echo $form->fileField($model,'foto'); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
