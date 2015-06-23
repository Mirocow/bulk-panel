<?php

/**
 * This is the model class for table "tariff_package".
 *
 * The followings are the available columns in table 'tariff_package':
 * @property integer $id
 * @property string $name
 * @property integer $root
 * @property integer $site_id
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Reseller[] $resellers
 * @property Tariff[] $tariffs
 * @property Site $site
 * @property TariffPackage $parent
 * @property TariffPackage[] $tariffPackages
 */
class TariffPackage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tariff_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, root, site_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, root, site_id, parent_id', 'safe', 'on'=>'search'),
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
			'resellers' => array(self::HAS_MANY, 'Reseller', 'tariff_package_id'),
			'tariffs' => array(self::HAS_MANY, 'Tariff', 'tariff_package_id'),
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
			'parent' => array(self::BELONGS_TO, 'TariffPackage', 'parent_id'),
			'tariffPackages' => array(self::HAS_MANY, 'TariffPackage', 'parent_id'),
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
			'root' => 'Root',
			'site_id' => 'Site',
			'parent_id' => 'Parent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('root',$this->root);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TariffPackage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
