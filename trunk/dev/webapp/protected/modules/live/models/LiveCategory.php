<?php

Yii::import('behaviors.HNestedSetBehavior');

/**
 * This is the model class for table "product_categories".
 *
 * The followings are the available columns in table 'product_categories':
 * @property string $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property integer $is_active
 * @property integer $lft
 * @property integer $rgt
 * @property string $parent_id
 * @property integer $level
 * @property integer $root
 * @property integer $created
 * @property integer $modified
 */
class LiveCategory extends HActiveRecord
{
	// Set default value
	public $is_active = 1;
	public $current_parent;
    // Thuộc tính dùng để xóa image
    public $removeImage;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductCategorie the static model class
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
		return '{{live_categories}}';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see yii/framework/base/CModel::behaviors()
	 */
	public function behaviors()
	{
		return array(
			'HNestedSetBehavior'=>array(
				'class'=>'behaviors.HNestedSetBehavior',
		));
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('is_active, lft, rgt, level, removeImage', 'numerical', 'integerOnly'=>true),
			array('id, parent_id', 'length', 'max'=>16),
			array('name, image', 'length', 'max'=>255),
			array('description', 'safe'),
			array('parent_id', 'checkParent'),
			array('image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
			array('image', 'unsafe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, description, is_active, lft, rgt, parent_id, level', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkParent($attribute, $params)
	{
		if ($this->isNewRecord) return;
		
		if ($this->{$attribute} == $this->current_parent) return;
		
		$nodeToMove = self::model()->findByPk($this->{$attribute});
		if ($nodeToMove->isDescendantOf($this) || $this->{$attribute}==$this->id) {
			$this->addError($attribute, ProductsModule::t('Cannot move object to itself (or descendant of it)'));
		} else {
			$this->moveAsFirst($nodeToMove);
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'image' => 'Image',
			'description' => 'Description',
			'is_active' => 'Is Active',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'parent_id' => 'Parent',
			'level' => 'Level',
			'root' => 'Root',
			'created' => 'Created',
			'modified' => 'Modified',
            'removeImage' => 'Remove Image',
		);
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('root',$this->root);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => Yii::app()->getModule('products')->entriesManageShow,
			),
		));
	}
}