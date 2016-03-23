<?php
/**
 * Visits (visits)
 * @var $this AdminController
 * @var $model Visits
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 26 January 2016, 13:00 WIB
 * @link https://github.com/oMMuCo
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Visits'=>array('manage'),
		'Upload',
	);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'book-grants-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		'on_post' => '',
	),
)); ?>
<div class="dialog-content">
	<fieldset>
		<?php if($eventFieldRender == false) {?>
			<div class="clearfix">
				<label>Recruitment Event <span class="required">*</span></label>
				<div class="desc">
					<?php if(Recruitments::getEvent() != null)
						echo CHtml::dropDownList('recruitmentId', $select, Recruitments::getEvent(), array('empty' => 'Pilih event'));
					else						
						echo CHtml::dropDownList('recruitmentId', $select, array('empty' => 'Pilih event')); ?>
					<?php if(Yii::app()->user->hasFlash('errorEvent')) {
						echo '<div class="errorMessage">'.Yii::app()->user->getFlash('errorEvent').'</div>';
					}?>
				</div>
			</div>
		<?php }?>
		
		<div class="clearfix">
			<label>Excel <span class="required">*</span></label>
			<div class="desc">
				<input type="file" name="usersExcel">
				<?php if(Yii::app()->user->hasFlash('errorFile')) {
					echo '<div class="errorMessage">'.Yii::app()->user->getFlash('errorFile').'</div>';
				}?>
				<div class="pt-10"><a off_address="" target="_blank" class="template" href="<?php echo Yii::app()->request->baseUrl;?>/externals/recruitment/event_user_bundle.xls" title="User Bundle Template">User Bundle Template</a> <a off_address="" target="_blank" class="template" href="<?php echo Yii::app()->request->baseUrl;?>/externals/recruitment/event_user_direct.xls" title="User Direct Template">User Direct Template</a></div>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton('Import Users' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>
