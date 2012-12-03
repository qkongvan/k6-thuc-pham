<?php

/**
 * Form Model JLChangeEmailForm dùng để xử lý việc thay đổi email của user
 * 
 * @author huytbt
 * @date 2011-06-04
 * @version 1.0
 */
class ChangeEmailForm extends CFormModel
{
    //public $verifyPassword;
    /**
     * email
     */
    public $email;
    /**
     * verifyEmail
     */
    public $verifyEmail;
    //private $__user;
    
    /**
	 * Thiết lập các quy tắc xác thực
	 */
    public function rules() {
        return array(
            array('email, verifyEmail', 'required'),
            //array('verifyPassword', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (minimal length 6 symbols).")),
            //array('verifyPassword', 'verifyPassword'),
            array('email', 'email'),
            array('email', 'uniqueEmail'),
            array('verifyEmail', 'compare', 'compareAttribute'=>'email', 'message' => UserModule::t("Retype Email is incorrect.")),
        );
    }
    
    /**
     * Phương thức verifyPassword($attribute, $params) dùng để xác thực mật khẩu của user
     *
     * @param type $attribute
     * @param type $params 
     */
    public function verifyPassword($attribute, $params)
    {
        $strPassword = UserModule::encryptPassword($this->verifyPassword, $this->__user->saltkey);
        if ($strPassword != $this->__user->password)
            $this->addError('verifyPassword', UserModule::t('The password you gave is incorrect.'));
    }
    
    /**
     * Phương thức uniqueEmail($attribute, $params) dùng để kiểm tra email đã tồn tại chưa
     *
     * @param type $attribute
     * @param type $params 
     */
    public function uniqueEmail($attribute, $params)
    {
        $find = User::model()->notsafe()->findByAttributes(array('email'=>$this->email));
        if (isset($find))
            $this->addError('email', UserModule::t("This user's email address already exists."));
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
}
