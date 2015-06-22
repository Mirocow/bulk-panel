<?php

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $created
 * @property string $domain
 * @property string $email
 * @property string $title
 * @property string $contacts
 * @property string $invoice_details
 * @property string $head_name
 * @property string $e_wallets
 * @property string $yandex_money
 * @property integer $style_id
 * @property integer $reseller_id
 *
 * The followings are the available model relations:
 * @property Reseller $reseller
 * @property Style $style
 * @property Service[] $services
 * @property User[] $users
 */
class Site extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url, created, domain, reseller_id', 'required'),
			array('style_id, reseller_id', 'numerical', 'integerOnly'=>true),
			array('email, title, contacts, invoice_details, head_name, e_wallets, yandex_money', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, url, created, domain, email, title, contacts, invoice_details, head_name, e_wallets, yandex_money, style_id, reseller_id', 'safe', 'on'=>'search'),
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
			'reseller' => array(self::BELONGS_TO, 'Reseller', 'reseller_id'),
			'style' => array(self::BELONGS_TO, 'Style', 'style_id'),
			'services' => array(self::MANY_MANY, 'Service', 'site_has_service(site_id, service_id)'),
			'users' => array(self::HAS_MANY, 'User', 'site_id'),
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
			'url' => 'Url',
			'created' => 'Created',
			'domain' => 'Domain',
			'email' => 'Email',
			'title' => 'Title',
			'contacts' => 'Contacts',
			'invoice_details' => 'Invoice Details',
			'head_name' => 'Head Name',
			'e_wallets' => 'E Wallets',
			'yandex_money' => 'Yandex Money',
			'style_id' => 'Style',
			'reseller_id' => 'Reseller',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('contacts',$this->contacts,true);
		$criteria->compare('invoice_details',$this->invoice_details,true);
		$criteria->compare('head_name',$this->head_name,true);
		$criteria->compare('e_wallets',$this->e_wallets,true);
		$criteria->compare('yandex_money',$this->yandex_money,true);
		$criteria->compare('style_id',$this->style_id);
		$criteria->compare('reseller_id',$this->reseller_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Site the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
