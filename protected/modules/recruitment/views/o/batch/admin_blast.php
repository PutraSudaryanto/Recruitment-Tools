<?php
/**
 * Recruitment Sessions (recruitment-sessions)
 * @var $this BatchController
 * @var $batch RecruitmentSessions
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 8 March 2016, 12:04 WIB
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Recruitment Sessions'=>array('manage'),
		'Create',
	);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'recruitment-sessions-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'on_post' => '',
	),
)); ?>
<div class="dialog-content">

	<fieldset>
		<p>Peserta akan dikirimkan email undangan tes termasuk didalamnya informasi tes yang akan dilaksanakan dan sebuah kartu masuk yang dapat digunakan oleh peserta untuk dapat mengikuti tes.</p>
		
		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php //echo $form->errorSummary($batch); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($batch,'blasting_subject'); ?>
			<div class="desc">
				<?php echo $form->textField($batch,'blasting_subject', array('maxlength'=>64, 'class'=>'span-9')); ?>
				<?php echo $form->error($batch,'blasting_subject'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($batch->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


