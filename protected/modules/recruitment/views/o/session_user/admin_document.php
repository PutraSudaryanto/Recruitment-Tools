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
		<div class="clearfix">
			<label>Total Item</label>
			<div class="desc">
				<h5 class="mt-0 mb-0"><?php echo $itemCount;?> User</h5>
			</div>
		</div>
		
		<?php if($batch->documents == '') {?>
			<div class="clearfix">
				<label>Page Item <span class="required">*</span></label>
				<div class="desc">
					<?php echo CHtml::textField('pageItem', '', array('class'=>'span-4'));?>
					<?php if(Yii::app()->user->hasFlash('errorPageItem')) {
						echo '<div class="errorMessage">'.Yii::app()->user->getFlash('errorPageItem').'</div>';
					}?>
				</div>
			</div>
		<?php } else {?>
			<div class="clearfix">
				<label><?php echo $batch->getAttributeLabel('documents');?></label>
				<div class="desc">
					<?php $data = explode(',', $batch->documents);
					if(!empty($data)) {
						echo '<ul>';
						foreach($data as $key => $val) {
							$url = Yii::app()->request->baseUrl.'/public/recruitment/document_test/'.$val;?>
							<li><a target="_blank" href="<?php echo $url;?>" title="<?php echo $val;?>"><?php echo $val;?></a></li>
					<?php }
						echo '</ul>';
					}?>
				</div>
			</div>
			<div class="clearfix">
				<label><?php echo $batch->getAttributeLabel('document_date');?></label>
				<div class="desc">
					<?php echo Utility::dateFormat($batch->document_date, true)?>
				</div>
			</div>
		<?php }?>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($batch->documents == '' ? 'Generate Document' : 'Reset Document' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Phrase::trans(4,0), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>
