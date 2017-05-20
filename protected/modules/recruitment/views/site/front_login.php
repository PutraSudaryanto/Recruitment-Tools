<?php
/**
 * @var $this SiteController
 * @var $model LoginForm
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Login',
	);
?>

<div name="post-on">
<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<fieldset>
		<div class="clearfix">
			<?php if(isset($_GET['event'])) {?>
				<?php echo $form->textField($model,'email', array('maxlength'=>32, 'placeholder'=>'Test Number')); ?>
			<?php } else {?>
				<?php echo $form->textField($model,'email', array('maxlength'=>32, 'placeholder'=>$model->getAttributeLabel('email'))); ?>
			<?php }?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="clearfix">
			<?php echo $form->passwordField($model,'password', array('maxlength'=>32, 'placeholder'=>$model->getAttributeLabel('password'))); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="clearfix">
			<?php echo CHtml::submitButton('Login', array('onclick' => 'setEnableSave()', 'class'=>'blue-button')); ?>
		</div>
	</fieldset>
<?php $this->endWidget(); ?>
</div>
