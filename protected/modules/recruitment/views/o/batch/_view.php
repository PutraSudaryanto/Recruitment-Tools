<?php
/**
 * Recruitment Sessions (recruitment-sessions)
 * @var $this BatchController
 * @var $data RecruitmentSessions
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 8 March 2016, 12:04 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->session_id), array('view', 'id'=>$data->session_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recruitment_id')); ?>:</b>
	<?php echo CHtml::encode($data->recruitment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_name')); ?>:</b>
	<?php echo CHtml::encode($data->session_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_info')); ?>:</b>
	<?php echo CHtml::encode($data->session_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_date')); ?>:</b>
	<?php echo CHtml::encode($data->session_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('session_time_start')); ?>:</b>
	<?php echo CHtml::encode($data->session_time_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_time_finish')); ?>:</b>
	<?php echo CHtml::encode($data->session_time_finish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>