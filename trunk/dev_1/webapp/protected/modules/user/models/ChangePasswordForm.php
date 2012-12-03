<?php

/**
 * Form Model JLChangePasswordForm dùng để xử lý việc thay đổi mật khẩu của user
 * 
 * @author huytbt
 * @date 2011-06-03
 * @version 1.0
 */
class ChangePasswordForm extends CFormModel
{
    /**
     * oldPassword
     */
    public $oldPassword;
    /**
     * password
     */
    public $password;
    /**
     * verifyPassword
     */
    public $verifyPassword;
    /**
     * user
     */
    private $__user;
    
    /**
	 * Thiết lập các quy tắc xác thực
	 */
    public function rules() {
        return array(
            array('oldPassword', 'required', 'on'=>'fullchange'),
            array('oldPassword', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (minimal length 6 symbols)."), 'on'=>'fullchange'),
            array('oldPassword', 'checkOldPassword', 'on'=>'fullchange'),
            array('password, verifyPassword', 'required'),
            array('password', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (minimal length 6 symbols).")),
            array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
        );
    }
    
    /**
     * Phương thức checkOldPassword($attribute, $params) dùng để xác thực mật khẩu cũ của user
     *
     * @param type $attribute
     * @param type $params 
     */
    public function checkOldPassword($attribute, $params)
    {
        $strOldPassword = UserModule::encryptPassword($this->oldPassword, $this->__user->saltkey);
        if ($strOldPassword != $this->__user->password)
            $this->addError('oldPassword', UserModule::t('The password you gave is incorrect.'));
    }
    
    /**
     * Phương thức setUser($user) dùng để set thuộc tính user
     *
     * @param type $user 
     */
    public function setUser($user)
    {
        $this->__user = $user;
    }
    
    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'oldPassword' => UserModule::t("Current Password"),
		);
	}
}
