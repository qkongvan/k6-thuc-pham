<?php

/**
 * Form Model ForgotPasswordForm dùng để xử lý việc gửi email lấy lại mật khẩu cho user
 * 
 * @author huytbt
 * @date 2011-06-03
 * @version 1.0
 */
class ForgotPasswordForm extends CFormModel
{
    /**
     * id
     */
    public $id;
    /**
     * email
     */
    public $email;
    /**
     * username
     */
    public $username;
    /**
     * verifyCode
     */
    public $verifyCode;
    private $__user;
    
    /**
	 * Thiết lập các quy tắc xác thực
	 */
    public function rules() {
        return array(
            array('username, verifyCode', 'required'),
            array('username', 'length', 'min'=>5, 'message' => UserModule::t("Incorrect username (minimal length 6 symbols).")),
            array('username', 'checkUserExists'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }
    
    /**
     * Phương thức checkUserExists($attribute, $params) dùng để kiểm tra xem username có tồn tại không
     *
     * @param type $attribute
     * @param type $params 
     */
    public function checkUserExists($attribute, $params)
    {
        $validator = new CEmailValidator;
        if (strpos($this->username, '@') !== false){
            if ($validator->validateValue($this->username))
            {
                $user = User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
            } else {
                $this->addError('username', UserModule::t("{attribute} is not a valid email address.", array('{attribute}' => $this->username)));
            }
        } else {
            $user = User::model()->notsafe()->findByUserName($this->username);
        }
        if (isset($user)) {
            $this->__user = $user;
        } else {
            $this->addError('username', UserModule::t('User "{path}" does not exist.', array('{path}' => $this->username)));
        }
    }
    
    /**
     * Phương thức getUser($user) dùng để get thuộc tính user
     *
     * @param type $user 
     */
    public function getUser()
    {
        return $this->__user;
    }
    
    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => UserModule::t("Username or Email"),
		);
	}
}

