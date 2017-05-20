<?php
/**
 * Recruitments (recruitments)
 * @var $this ScannerController
 * @var $data Recruitments
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 12 March 2016, 23:23 WIB
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<div class="sep">
	<h3>Event Information</h3>
	<?php 
	if($user->event_logo != '')
		$logo = Yii::app()->request->baseUrl.'/public/recruitment/user_photos/'.$user->event_logo;
	else
		$logo = Yii::app()->request->baseUrl.'/public/recruitment/recruitment_default.png';
	
	$this->widget('application.components.system.FDetailView', array(
		'data'=>$event,
		'attributes'=>array(
			array(
				'name'=>'event_logo',
				'value'=>'<img src="'.Utility::getTimThumb($logo, 300, 300, 3).'" alt="'.$event->event_name.'">',
				'type'=>'raw',
			),
			array(
				'name'=>'event_name',
				'value'=>$event->event_name,
			),
			array(
				'name'=>'event_desc',
				'value'=>$event->event_desc,
				'type'=>'raw',
			),
			array(
				'name'=>'start_date',
				'value'=>Utility::dateFormat($event->start_date),
			),
			array(
				'name'=>'finish_date',
				'value'=>!in_array($event->finish_date, array('0000-00-00','1970-01-01')) ? Utility::dateFormat($event->finish_date) : 'Selesai',
			),
		),
	)); ?>
</div>