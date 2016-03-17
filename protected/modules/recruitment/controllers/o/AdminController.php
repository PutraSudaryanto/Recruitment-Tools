<?php
/**
 * AdminController
 * @var $this AdminController
 * @var $model Recruitments
 * @var $form CActiveForm
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Manage
 *	Import
 *	Blast
 *	Add
 *	Edit
 *	View
 *	RunAction
 *	Delete
 *	Publish
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 1 March 2016, 13:52 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			} else {
				$this->redirect(Yii::app()->createUrl('site/login'));
			}
		} else {
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('manage','import','blast','add','edit','view','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && in_array(Yii::app()->user->level, array(1,2))',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('manage'));
	}	

	/**
	 * Manages all models.
	 */
	public function actionManage() 
	{
		$model=new Recruitments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Recruitments'])) {
			$model->attributes=$_GET['Recruitments'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = 'Recruitments Manage';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_manage',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionImport() 
	{
		ini_set('max_execution_time', 0);
		ob_start();
		
		$path = 'public/recruitment/event_excel';

		// Generate path directory
		if(!file_exists($path)) {
			@mkdir($path, 0755, true);

			// Add File in Article Folder (index.php)
			$newFile = $path.'/index.php';
			$FileHandle = fopen($newFile, 'w');
		} else
			@chmod($path, 0755, true);
		
		$error = array();
		
		if(isset($_GET['id'])) {
			$eventId = $_GET['id'];
			$url = Yii::app()->controller->createUrl('edit',array('id'=>$_GET['id']));			
		} else {
			$eventId = $_POST['recruitmentId'];
			$url = Yii::app()->controller->createUrl('manage');
		}
		$model = Recruitments::getInfo($eventId);
		
		if(isset($_FILES['usersExcel'])) {
			$fileName = CUploadedFile::getInstanceByName('usersExcel');
			if(in_array(strtolower($fileName->extensionName), array('xls','xlsx')) && $eventId != '') {
				$file = time().'_'.Utility::getUrlTitle($model->event_name).'.'.strtolower($fileName->extensionName);
				if($fileName->saveAs($path.'/'.$file)) {
					Yii::import('ext.excel_reader.OExcelReader');
					$xls = new OExcelReader($path.'/'.$file);
					
					for ($row = 2; $row <= $xls->sheets[0]['numRows']; $row++) {
						$no				= trim($xls->sheets[0]['cells'][$row][1]);
						$test_number	= strtolower(trim($xls->sheets[0]['cells'][$row][2]));
						$email			= strtolower(trim($xls->sheets[0]['cells'][$row][3]));
						$password		= trim($xls->sheets[0]['cells'][$row][4]);
						$displayname	= trim($xls->sheets[0]['cells'][$row][5]);
						$major			= trim($xls->sheets[0]['cells'][$row][6]);
						//echo $no.' '.$test_number.' '.$password.' '.$email.' '.$displayname.' '.$major;
						
						$user = RecruitmentUsers::model()->findByAttributes(array('email' => strtolower($email)), array(
							'select' => 'user_id, email',
						));
						if($user == null)
							$userId = RecruitmentUsers::insertUser($email, $password, $displayname, $major);
						else
							$userId = $user->user_id;
						
						if($test_number != '') {
							$eventUser = RecruitmentEventUser::model()->find(array(
								'select'    => 'event_user_id',
								'condition' => 'recruitment_id= :recruitment AND user_id= :user AND test_number= :number',
								'params'    => array(
									':recruitment' => $model->recruitment_id,
									':user' => $userId,
									':number' => strtolower($test_number),
								),
							));
						} else {
							$eventUser = RecruitmentEventUser::model()->find(array(
								'select'    => 'event_user_id',
								'condition' => 'recruitment_id= :recruitment AND user_id= :user',
								'params'    => array(
									':recruitment' => $model->recruitment_id,
									':user' => $userId,
								),
							));								
						}
						//echo $model->recruitment_id.' '.$userId.' '.$test_number.' '.$password.' '.$major;
						if($eventUser == null)
							RecruitmentEventUser::insertUser($model->recruitment_id, $userId, $test_number);
					}
					
					Yii::app()->user->setFlash('success', 'Import Recruitment Event User Success.');
					$this->redirect(array('manage'));
					
				} else
					Yii::app()->user->setFlash('errorFile', 'Gagal menyimpan file.');
			} else {
				Yii::app()->user->setFlash('errorFile', 'Hanya file .xls dan .xlsx yang dibolehkan.');
				if($eventId == '')
					Yii::app()->user->setFlash('errorEvent', 'Recruitment Event cannot be blank.');
			}
		}

		ob_end_flush();
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = $url;
		$this->dialogWidth = 600;

		$this->pageTitle = 'Import Recruitment Event User';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_import',array(
			'model'=>$model,
			'eventFieldRender'=>isset($_GET['id']) ? true : false,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionBlast($id) 
	{
		ini_set('max_execution_time', 0);
		ob_start();
		
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Recruitments'])) {
			$model->attributes=$_POST['Recruitments'];
			$model->scenario = 'blastForm';
			
			if($model->save()) {
				$criteria=new CDbCriteria;
				$criteria->compare('t.publish',1);
				$criteria->compare('t.recruitment_id',$id);
				
				$user = RecruitmentEventUser::model()->findAll($criteria);
				if($user != null) {
					$i = 0;
					foreach($user as $key => $val) {
						$i++;
						$message = 'testing email';
						if(SupportMailSetting::sendEmail($val->user->email, $val->user->displayname, $model->blasting_subject, $message, 1, null, $attachment)) {
							RecruitmentEventUser::model()->updateByPk($val->event_user_id, array(
								'sendemail_status'=>1, 
								'sendemail_id'=>Yii::app()->user->id,
							));
						}
						
						if($i%50 == 0) {
							$event = $val->user->displayname.' '.$val->user->email.' '.$val->recruitment->event_name;
							SupportMailSetting::sendEmail(SupportMailSetting::getInfo(1,'mail_contact'), 'Ommu Support', 'Send Email Blast: '.$event.' ('.$i.')', $event, 1, null, $attachment);
						}
					}
				}
				Recruitments::model()->updateByPk($id, array('blasting_status'=>1));
		
				Yii::app()->user->setFlash('success', 'Blasting success.');
				$this->redirect(array('manage'));
			}			
		}
		
		ob_end_flush();
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;

		$this->pageTitle = 'Blasting';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_blast',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$model=new Recruitments;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Recruitments'])) {
			$model->attributes=$_POST['Recruitments'];
			
			/*
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('manage'),
							'id' => 'partial-recruitments',
							'msg' => '<div class="errorSummary success"><strong>Recruitments success created.</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			*/
				
			if($model->save()) {
				Yii::app()->user->setFlash('success', 'Recruitments success created.');
				$this->redirect(Yii::app()->controller->createUrl('edit', array('id'=>$model->recruitment_id)));
			}
		}
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;

		$this->pageTitle = 'Create Recruitments';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id) 
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Recruitments'])) {
			$model->attributes=$_POST['Recruitments'];
			
			/*
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('manage'),
							'id' => 'partial-recruitments',
							'msg' => '<div class="errorSummary success"><strong>Recruitments success updated.</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			*/
				
			if($model->save()) {
				Yii::app()->user->setFlash('success', 'Recruitments success updated.');
				$this->redirect(array('manage'));
			}
		}

		$this->pageTitle = 'Update Recruitments';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_edit',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;		

		$this->pageTitle = 'View Recruitments';
		$this->pageDescription = '';
		$this->pageMeta = $setting->meta_keyword;
		$this->render('admin_view',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunAction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = $_GET['action'];

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', $id);

			if($actions == 'publish') {
				Recruitments::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				Recruitments::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				Recruitments::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				Recruitments::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				if($model->delete()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-recruitments',
						'msg' => '<div class="errorSummary success"><strong>Recruitments success deleted.</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = 'Recruitments Delete.';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		if($model->publish == 1) {
			$title = Phrase::trans(276,0);
			$replace = 0;
		} else {
			$title = Phrase::trans(275,0);
			$replace = 1;
		}

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				//change value active or publish
				$model->publish = $replace;

				if($model->update()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-recruitments',
						'msg' => '<div class="errorSummary success"><strong>Recruitments success published.</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = $title;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_publish',array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = Recruitments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Phrase::trans(193,0));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recruitments-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
