<?php
/**
 * RecruitmentUserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * 
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
class RecruitmentUserIdentity extends CUserIdentity
{
	public $email;
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if(isset($_GET['event'])) {
			$record = RecruitmentEventUser::model()->findByAttributes(
				array(
					'recruitment_id' => $_GET['event'],
					'test_number' => strtolower($this->username),
				),
				array('order'=>'event_user_id DESC')
			);			
		} else
			$record = RecruitmentUsers::model()->findByAttributes(array('email' => strtolower($this->username)));
		
		if($record != null) {
			$salt = isset($_GET['event']) ? $record->user->salt : $record->salt;
			$password = isset($_GET['event']) ? $record->user->password : $record->password;
			$passwordTemporary = isset($_GET['event']) ? $record->user->password_temporary : $record->password_temporary;
			$creationDate = isset($_GET['event']) ? $record->user->creation_date : $record->creation_date;
		}
			
		if($record === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if(($this->password != '' && $passwordTemporary !== $this->password) && (($passwordTemporary !== '' || $passwordTemporary === '') && $password !== RecruitmentUsers::hashPassword($salt,$this->password)))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			$this->setState('user_id', $record->user_id);
			if(isset($_GET['event']))
				$this->setState('recruitment_id', $record->recruitment_id);
			$this->setState('creation_date', $creationDate);
			$this->setState('lastlogin_date', date('Y-m-d H:i:s'));
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;

	}

	public function getId() {
		return $this->_id;
	}

}