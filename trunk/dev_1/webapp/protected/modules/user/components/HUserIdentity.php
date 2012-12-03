<?php

/**
 * Component dùng để xác thực
 * 
 * @class       HUserIdentity
 * @author      huytbt
 * @version     1.0
 * @date        2011-05-23
 */
class HUserIdentity extends CUserIdentity
{
	/**
	 * id
	 */
	private $_id;
	/**
	 * ERROR_EMAIL_INVALID
	 */
	const ERROR_EMAIL_INVALID = 3;
	/**
	 * ERROR_STATUS_NOTACTIV
	 */
	const ERROR_STATUS_NOTACTIV = 4;
	/**
	 * ERROR_STATUS_BAN
	 */
	const ERROR_STATUS_BAN = 5;
    
	/**
	 * Phương thức authenticate() dùng để xác thực username và password của User có đúng không
     *  
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//$record = User::model()->findByAttributes(array('username'=>$this->username));
		if (strpos($this->username,"@")) {
			$record=User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		} else {
			$record=User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		}
        if($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if($record->password !== UserModule::encryptPassword($this->password, $record->saltkey))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $record->id;
            $this->setState('superuser', $record->superuser);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
	}
    
    /**
     * Phương thức getId() trả về ID của User
     *  
     * @return integer the ID of the user record
     */
	public function getId()
	{
		return $this->_id;
	}
}
