<?php

/**
 * This is the model class for table "tariff".
 *
 * The followings are the available columns in table 'tariff':
 * @property integer $id
 * @property double $price
 * @property integer $root
 * @property integer $package
 * @property string $type
 * @property integer $operator_id
 * @property integer $country_id
 * @property integer $site_id
 * @property integer $parent_id
 * @property integer $service_id
 * @property integer $tariff_threshold_id
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property Operator $operator
 * @property Country $country
 * @property TariffThreshold $tariffThreshold
 * @property Tariff $parent
 * @property Tariff[] $tariffs
 * @property Site $site
 */
class Tariff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tariff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price, service_id, tariff_threshold_id', 'required'),
			array('root, package, operator_id, country_id, site_id, parent_id, service_id, tariff_threshold_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('type', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, price, root, package, type, operator_id, country_id, site_id, parent_id, service_id, tariff_threshold_id', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'operator' => array(self::BELONGS_TO, 'Operator', 'operator_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'tariffThreshold' => array(self::BELONGS_TO, 'TariffThreshold', 'tariff_threshold_id'),
			'parent' => array(self::BELONGS_TO, 'Tariff', 'parent_id'),
			'tariffs' => array(self::HAS_MANY, 'Tariff', 'parent_id'),
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'price' => 'Price',
			'root' => 'Root',
			'package' => 'Package',
			'type' => 'Type',
			'operator_id' => 'Operator',
			'country_id' => 'Country',
			'site_id' => 'Site',
			'parent_id' => 'Parent',
			'service_id' => 'Service',
			'tariff_threshold_id' => 'Tariff Threshold',
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
		$criteria->compare('price',$this->price);
		$criteria->compare('root',$this->root);
		$criteria->compare('package',$this->package);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('operator_id',$this->operator_id);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('tariff_threshold_id',$this->tariff_threshold_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tariff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
