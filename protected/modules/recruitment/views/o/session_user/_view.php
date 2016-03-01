<?php
/**
 * Recruitment Session Users (recruitment-session-user)
 * @var $this SessionuserController
 * @var $data RecruitmentSessionUser
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:53 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_seat')); ?>:</b>
	<?php echo CHtml::encode($data->session_seat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />


</div>