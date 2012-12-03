<?php

/**
 * This model used to Form Login
 *
 * @author	huytbt
 * @version	1.0
 * @date	2011-10-30
 */
class LoginForm extends CFormModel
{
	/**
     * username
     */
	public $username;
    /**
     * password
     */
	public $password;
    /**
     * rememberMe
     */
	public $rememberMe;

    /**
     * identity
     */
	private $_identity;

	/**
	 * Phương thức dùng để thiết lập các quy tắc xác thực
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Phương thức dùng để khai báo các Label cho form
	 */
	public function attributeLabels()
	{
		return array(
			'username' => UserModule::t('Username'),
			'password' => UserModule::t('Password'),
			'rememberMe' => UserModule::t('Remember me next time'),
		);
	}

	/**
	 * Phương thức authenticate($attribute,$params) dùng để xác thực Username và Password có đúng không
         * @param $attribute
         * @param $params
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			Yii::import('application.modules.user.components.HUserIdentity');
			$this->_identity=new HUserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password', UserModule::t('Incorrect username or password.'));
		}
	}

	/**
	 * Phương thức dùng để kiểm tra đăng nhập
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		Yii::import('application.modules.user.components.HUserIdentity');
		if($this->_identity===null)
		{
			$this->_identity=new HUserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===HUserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
            
            // Update time last visit
            $user  = User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
            $user->lastvisit = time();
            $user->save();
            
			return true;
		}
		else
			return false;
	}
}