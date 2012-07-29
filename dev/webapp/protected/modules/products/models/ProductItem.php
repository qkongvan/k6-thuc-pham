<?php

/**
 * This is the model class for table "product_items".
 *
 * The followings are the available columns in table 'product_items':
 * @property string $id
 * @property string $name
 * @property string $image
 * @property integer $price
 * @property string $short_description
 * @property string $description
 * @property integer $status
 * @property integer $created
 * @property integer $modified
 */
class ProductItem extends HActiveRecord
{
	public $categories;
	// Set default value
	public $status = 1;
	// Thuộc tính dùng để xóa image
	public $removeImage;

	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductItem the static model class
	 */
	public static function model($className = __class__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, price, short_description, description', 'required'),
			array('price, status, removeImage', 'numerical', 'integerOnly' => true), 
			array('id', 'length', 'max' => 16), 
			array('name', 'length', 'max' => 255), 
			array('short_description, description, unit', 'safe'), 
			array('image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true), 
			array('image', 'unsafe'), // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, price, short_description, unit, description, status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('categoryitem' => array(self::HAS_MANY, 'ProductCategoryItem', 'item_id'), );
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
			'price' => 'Price', 
			'unit' => 'Unit', 
			'short_description' => 'Short Description', 
			'description' => 'Description', 
			'status' => 'Status', 
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('image', $this->image);
		$criteria->compare('price', $this->price);
		$criteria->compare('unit', $this->unit);
		$criteria->compare('short_description', $this->short_description, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created', $this->created);
		$criteria->compare('modified', $this->modified);
		if (is_array($this->categories)) {
			$criteria->with = array('categoryitem');
			$criteria->together = true;
			foreach ($this->categories as $cat)
				$criteria->compare('categoryitem.category_id', $cat, false, 'OR');
		}

		$criteria->order = 'created DESC';

		return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => Yii::app()->getModule('products')->entriesManageShow, ), ));
	}

	public function afterFind()
	{
		parent::afterFind();
		$categories = ProductCategoryItem::model()->findAllByAttributes(array('item_id' => $this->id));
		$arrCat = array();
		foreach ($categories as $cat)
			$arrCat[] = $cat->category_id;
		$this->categories = implode(",", $arrCat);
	}

	public function afterSave()
	{
		parent::afterSave();
		ProductCategoryItem::model()->deleteAllByAttributes(array('item_id' => $this->id));
		$arrCat = explode(",", $this->categories);
		foreach ($arrCat as $cat) {
			$model = new ProductCategoryItem;
			$model->category_id = $cat;
			$model->item_id = $this->id;
			$model->save();
		}
	}
}
