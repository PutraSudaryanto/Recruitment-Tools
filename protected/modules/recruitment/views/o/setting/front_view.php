<?php
/**
 * Recruitment Settings (recruitment-setting)
 * @var $this SettingController
 * @var $model RecruitmentSetting
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:53 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Recruitment Settings'=>array('manage'),
		$model->id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'id',
			'value'=>$model->id,
			//'value'=>$model->id != '' ? $model->id : '-',
		),
		array(
			'name'=>'license',
			'value'=>$model->license,
			//'value'=>$model->license != '' ? $model->license : '-',
		),
		array(
			'name'=>'permission',
			'value'=>$model->permission,
			//'value'=>$model->permission != '' ? $model->permission : '-',
		),
		array(
			'name'=>'meta_keyword',
			'value'=>'value'=>$model->meta_keyword != '' ? $model->meta_keyword : '-',
			//'value'=>$model->meta_keyword != '' ? CHtml::link($model->meta_keyword, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_keyword, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'meta_description',
			'value'=>'value'=>$model->meta_description != '' ? $model->meta_description : '-',
			//'value'=>$model->meta_description != '' ? CHtml::link($model->meta_description, Yii::app()->request->baseUrl.'/public/visit/'.$model->meta_description, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'modified_date',
			'value'=>Utility::dateFormat($model->modified_date, true),
		),
		array(
			'name'=>'modified_id',
			'value'=>$model->modified_id,
			//'value'=>$model->modified_id != '' ? $model->modified_id : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Phrase::trans(4,0), array('id'=>'closed')); ?>
</div>
