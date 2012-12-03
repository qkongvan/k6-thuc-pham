<?php

/**
 * Form Model Registration dùng để xử lý việc đăng ký của user
 * 
 * @author huytbt
 * @date 2011-06-02
 * @version 1.0
 */
class RegistrationForm extends User {
    /**
     * textPassword
     */
    public $textPassword;
    /**
     * verifyPassword
     */
    public $verifyPassword;
    /**
     * verifyEmail
     */
    public $verifyEmail;
    /**
     * verifyCode
     */
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        $rules = CMap::mergeArray(parent::rules(), array(
                    array('textPassword, verifyPassword, verifyEmail, verifyCode', 'required'),
                    array('textPassword', 'length', 'max' => 128, 'min' => 6, 'message' => UserModule::t("Incorrect password (minimal length 6 symbols).")),
                    array('verifyPassword', 'compare', 'compareAttribute' => 'textPassword', 'message' => UserModule::t("Retype Password is incorrect.")),
                    array('verifyEmail', 'compare', 'compareAttribute' => 'email', 'message' => UserModule::t("Retype Email is incorrect.")),
                ));
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form')
            return $rules;
        else
            array_push($rules, array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()));
        
        return $rules;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(parent::attributeLabels(), array(
            'textPassword' => UserModule::t("Password"),
        ));
    }

}
