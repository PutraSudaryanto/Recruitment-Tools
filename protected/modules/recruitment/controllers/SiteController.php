<?php
/**
 * SiteController
 * @var $this SiteController
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Login
 *	Logout
 *	SendEmail
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class SiteController extends Controller
{
	/**
	 * Initialize public template
	 */
	public function init() 
	{
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
		//$this->pageGuest = true;
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','login','logout'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->pageTitle = 'Home';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_index');
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAbout()
	{
		$news = OmmuPages::model()->findByPk(6);
		
		$this->pageTitle = 'Home';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_about', array(
			'news'=>$news,
		));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!empty(Yii::app()->user->user_id))
			$this->redirect(Yii::app()->controller->createUrl('account/index'));

		else {
			$model=new LoginFormRecruitment;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginFormRecruitment']))
			{
				$model->attributes=$_POST['LoginFormRecruitment'];

				$jsonError = CActiveForm::validate($model);
				if(strlen($jsonError) > 2) {
					echo $jsonError;

				} else {
					if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
						// validate user input and redirect to the previous page if valid
						if($model->validate() && $model->login()) {
							RecruitmentUsers::model()->updateByPk(Yii::app()->user->user_id, array(
								'lastlogin_date'=>date('Y-m-d H:i:s'), 
								'lastlogin_ip'=>$_SERVER['REMOTE_ADDR'],
							));
							echo CJSON::encode(array(
								'redirect' => Yii::app()->controller->createUrl('account/index'),
							));
							//$this->redirect(Yii::app()->user->returnUrl);
						} else {
							print_r($model->getErrors());
						}
					}
				}
				Yii::app()->end();				
			}
			
			$this->pageTitle = 'Login';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('front_login',array(
				'model'=>$model,
			));			
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}