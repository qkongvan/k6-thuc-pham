<?php

class UserModule extends HWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	/**
     * Phương thức createSalt() dùng để tạo ra một mã Salt cho user
     * 
     * @param $intLength int Độ dài chuỗi Salt được sinh ra
     * @return string Mã ngẫu nhiên Salt
     */
    public static function createSalt($intLength = 13)
    {
        return substr(uniqid(), 0, $intLength);
    }

    /**
     * Phương thức encryptPassword($strPassword, $strSalt) trả về mật khẩu được sinh từ $strPassword, $strSalt, Yii::app()->params['systemSalt']
     * 
     * @param string $strPassword Mật khẩu của user
     * @param string $strSalt Salt của user
     * @return string Mật khẩu dùng để lưu vào CSDL hoặc sử dụng cho việc kiểm tra đăng nhập
     */
    public static function encryptPassword($strPassword, $strSalt)
    {
        $strMD5 = md5($strPassword);
        $hash = $strSalt . $strMD5 . Yii::app()->params['systemSalt'];
        $strEncrypt = sha1(md5($hash));
        
        return $strEncrypt;
    }
}
