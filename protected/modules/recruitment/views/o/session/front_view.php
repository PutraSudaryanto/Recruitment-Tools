<?php
/**
 * Recruitment Sessions (recruitment-sessions)
 * @var $this SessionController
 * @var $model RecruitmentSessions
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:52 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Recruitment Sessions'=>array('manage'),
		$model->session_id,
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
			'name'=>'session_id',
			'value'=>$model->session_id,
			//'value'=>$model->session_id != '' ? $model->session_id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'recruitment_id',
			'value'=>$model->recruitment_id,
			//'value'=>$model->recruitment_id != '' ? $model->recruitment_id : '-',
		),
		array(
			'name'=>'session_name',
			'value'=>$model->session_name,
			//'value'=>$model->session_name != '' ? $model->session_name : '-',
		),
		array(
			'name'=>'session_info',
			'value'=>'value'=>$model->session_info != '' ? $model->session_info : '-',
			//'value'=>$model->session_info != '' ? CHtml::link($model->session_info, Yii::app()->request->baseUrl.'/public/visit/'.$model->session_info, array('target' => '_blank')) : '-',
			'type'=>'raw',
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
