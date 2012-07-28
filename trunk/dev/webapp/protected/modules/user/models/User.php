<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $createtime
 * @property integer $lastvisit
 * @property integer $superuser
 * @property integer $status
 * @property string $saltkey
 * @property string $activkey
 *
 * The followings are the available model relations:
 * @property Profiles $id0
 */
class User extends HActiveRecord
{
	const STATUS_NOACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_BANED = -1;
	const SUPERUSER = 1;
	const NONSUPERUSER = 0;
	
	public $rePassword;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, saltkey', 'required'),
			array('username, email', 'unique'),
			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email, activkey', 'length', 'max'=>128),
			array('saltkey', 'length', 'max'=>16),
			array('email', 'email'),
			array('rePassword', 'required', 'on'=>'admin'),
			array('rePassword', 'checkRePassword', 'on'=>'admin'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, createtime, lastvisit, superuser, status, saltkey, activkey', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profile' => array(self::HAS_MANY, 'Profiles', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => UserModule::t('ID'),
			'username' => UserModule::t('Username'),
			'password' => UserModule::t('Password'),
			'rePassword' => UserModule::t('Retype Password'),
			'email' => UserModule::t('Email'),
			'createtime' => UserModule::t('Createtime'),
			'lastvisit' => UserModule::t('Lastvisit'),
			'superuser' => UserModule::t('Superuser'),
			'status' => UserModule::t('Status'),
			'saltkey' => UserModule::t('Saltkey'),
			'activkey' => UserModule::t('Activkey'),
		);
	}
	
	public function checkRePassword($attribute,$params)
	{
		Yii::import('application.modules.user.components.HUserIdentity');
		if($this->password != $this->rePassword)
			$this->addError('rePassword', UserModule::t('Incorrect retype password.'));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('lastvisit',$this->lastvisit);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('status',$this->status);
		$criteria->compare('saltkey',$this->saltkey,true);
		$criteria->compare('activkey',$this->activkey,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function scopes()
	{
		return array(
			'active'=>array(
				'condition'=>'status='.self::STATUS_ACTIVE,
			),
			'notactvie'=>array(
				'condition'=>'status='.self::STATUS_NOACTIVE,
			),
			'banned'=>array(
				'condition'=>'status='.self::STATUS_BANED,
			),
			'superuser'=>array(
				'condition'=>'superuser=1',
			),
			'notsafe'=>array(
				'select' => 'id, username, password, email, activkey, createtime, lastvisit, superuser, status, saltkey',
			),
		);
	}
	
	public function defaultScope()
	{
		return array(
			'select' => 'id, username, email, createtime, lastvisit, superuser, status',
		);
	}
	
	/**
	 * Phương thức findByUserName($strUsername) trả về thông tin user theo $strUsername
	 * 
	 * @param string $strUsername Username
	 */
	public function findByUserName($strUsername)
	{
		return $this->findByAttributes(array('username'=>$strUsername));
	}
	
	/**
	 * Phương thức encryptPassword($strPassword) dùng để tạo ra mã Salt và Password cho user
	 *
	 * @param string $strPassword Password
	 */
	public function encryptPassword($strPassword)
	{
		// Create new Salt
		$strSalt = UserModule::createSalt();
		$this->saltkey = $strSalt;

		// Create new Pasword
		$strPaswordEncryt = UserModule::encryptPassword($strPassword, $strSalt);
		$this->password = $strPaswordEncryt;
	}
	
	/**
	 * Phương thức beforeSave() dùng để thiết lập các thông tin mặc định khi tạo user
	 */
	public function beforeSave()
	{
		parent::beforeSave();
		
		if ($this->getIsNewRecord())
		{
			$this->createtime = time();
			$this->superuser = User::NONSUPERUSER;
			if ($this->scenario != 'admin') $this->status = User::STATUS_NOACTIVE;
			else $this->status = User::STATUS_ACTIVE;
		}
		return true;
	}
	
	/**
	 * Phương thức dùng để tạo ra mã activate code
	 */
	public function createCodeActivation()
	{
		$codeActivation = UserModule::encryptPassword(microtime(), UserModule::createSalt());
		$this->activkey = $codeActivation;
		return $codeActivation;
	}
}