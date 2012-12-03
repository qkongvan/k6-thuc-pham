<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
	public $currentPassword;
	public $password;
	public $verifyPassword;
	
	public function rules() {
		return array(
			array('currentPassword, password, verifyPassword', 'required'),
			array('currentPassword', 'checkCurrentPassword'),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
		);
	}
	
	public function checkCurrentPassword($attribute,$params)
	{
		$user = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
		if (Yii::app()->getModule('user')->encrypting($this->$attribute) !== $user->password)
			$this->addError($attribute, UserModule::t("Current password is incorrect."));
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'currentPassword'=>UserModule::t("Current Password"),
			'password'=>UserModule::t("Password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
		);
	}
} 