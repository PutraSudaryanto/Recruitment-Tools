<?php
/**
 * Recruitments (recruitments)
 * @var $this AdminController
 * @var $model Recruitments
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:52 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Recruitments'=>array('manage'),
		$model->recruitment_id,
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
			'name'=>'recruitment_id',
			'value'=>$model->recruitment_id,
			//'value'=>$model->recruitment_id != '' ? $model->recruitment_id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'event_name',
			'value'=>$model->event_name,
			//'value'=>$model->event_name != '' ? $model->event_name : '-',
		),
		array(
			'name'=>'event_desc',
			'value'=>'value'=>$model->event_desc != '' ? $model->event_desc : '-',
			//'value'=>$model->event_desc != '' ? CHtml::link($model->event_desc, Yii::app()->request->baseUrl.'/public/visit/'.$model->event_desc, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'event_type',
			'value'=>$model->event_type,
			//'value'=>$model->event_type != '' ? $model->event_type : '-',
		),
		array(
			'name'=>'start_date',
			'value'=>Utility::dateFormat($model->start_date),
		),
		array(
			'name'=>'finish_date',
			'value'=>Utility::dateFormat($model->finish_date),
		),
		array(
			'name'=>'creation_date',
			'value'=>Utility::dateFormat($model->creation_date, true),
		),
		array(
			'name'=>'creation_id',
			'value'=>$model->creation_id,
			//'value'=>$model->creation_id != '' ? $model->creation_id : '-',
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
