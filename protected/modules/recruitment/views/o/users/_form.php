<?php
/**
 * Recruitment Users (recruitment-users)
 * @var $this UsersController
 * @var $model RecruitmentUsers
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:54 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'recruitment-users-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="clearfix publish">
		<?php echo $form->labelEx($model,'enabled'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'enabled'); ?>
			<?php echo $form->labelEx($model,'enabled'); ?>
			<?php echo $form->error($model,'enabled'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'salt'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'salt',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'salt'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'email'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'email'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'username'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'username'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'password'); ?>
		<div class="desc">
			<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
			<?php echo $form->error($model,'password'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'displayname'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'displayname',array('size'=>60,'maxlength'=>64)); ?>
			<?php echo $form->error($model,'displayname'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'photos'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'photos',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'photos'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'creation_date'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'creation_date'); ?>
			<?php echo $form->error($model,'creation_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'creation_ip'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'creation_ip',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'creation_ip'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->update_date != '0000-00-00' ? $model->update_date = date('d-m-Y', strtotime($model->update_date)) : '') : '';
			//echo $form->textField($model,'update_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'update_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'update_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'update_ip'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'update_ip',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'update_ip'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'lastlogin_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->lastlogin_date != '0000-00-00' ? $model->lastlogin_date = date('d-m-Y', strtotime($model->lastlogin_date)) : '') : '';
			//echo $form->textField($model,'lastlogin_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'lastlogin_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'lastlogin_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'lastlogin_ip'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'lastlogin_ip',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'lastlogin_ip'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->modified_date != '0000-00-00' ? $model->modified_date = date('d-m-Y', strtotime($model->modified_date)) : '') : '';
			//echo $form->textField($model,'modified_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'modified_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'modified_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'modified_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'modified_id'); ?>
			<?php echo $form->error($model,'modified_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Phrase::trans(1,0) : Phrase::trans(2,0), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php /*
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Phrase::trans(1,0) : Phrase::trans(2,0) ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Phrase::trans(4,0), array('id'=>'closed')); ?>
</div>
*/?>
<?php $this->endWidget(); ?>


