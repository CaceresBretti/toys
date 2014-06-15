<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

/*
$username="demo";
$password="demo";
$identity=new UserIdentity($username,$password);
$identity->authenticate();
Yii::app()->user->login($identity);
*/

?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>



<br><br>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));

?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
    <?php if(Yii::app()->crugeconnector->hasEnabledClients){ ?>
    <div class='crugeconnector'>
        <span>Use your Facebook or Google account:</span>
        <ul>
        <?php 
            $cc = Yii::app()->crugeconnector;
            foreach($cc->enabledClients as $key=>$config){
                $image = CHtml::image($cc->getClientDefaultImage($key));
                echo "<li>".CHtml::link($image,
                    $cc->getClientLoginUrl($key))."</li>";
            }
        ?>
        </ul>
    </div>
<?php } ?>
