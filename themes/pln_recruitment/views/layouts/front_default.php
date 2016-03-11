<?php $this->beginContent('//layouts/default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.public.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	if($module == null) {
		if($controller == 'site') {
			if($action == 'index')
				$class = 'main';
			else if($action == 'login')
				$class = 'login';
			else
				$class = $action;
		} else
			$class = $controller;
	} else {
		if($controller == 'site') {
			$class = $module;
			if($action == 'login')
				$class = 'login';
		} else
			$class = $module.'-'.$controller;
	}
?>
<?php //echo $this->dialogDetail == true ? (empty($this->dialogWidth) ? 'class="boxed clearfix"' : 'class="clearfix"') : 'class="clearfix"';?>

<div id="<?php echo $class;?>" class="box-wrap">
	<?php if($this->dialogDetail == false && $this->pageTitleShow == true) {?>
		<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
	<?php }?>
	<div class="box-content">
		<?php echo $content;?>
	</div>	
</div>

<?php $this->endContent(); ?>