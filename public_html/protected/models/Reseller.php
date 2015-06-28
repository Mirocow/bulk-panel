<?php

/**
 * This is the model class for table "reseller".
 *
 * The followings are the available columns in table 'reseller':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $organization_name
 * @property integer $status
 * @property double $balance
 * @property string $phone
 * @property string $email
 * @property string $created
 * @property integer $tariff_package_id
 *
 * The followings are the available model relations:
 * @property TariffPackage $tariffPackage
 * @property Site[] $sites
 * @property Style[] $styles
 */
class Reseller extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reseller';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, name, organization_name, status, balance, phone, email, created, tariff_package_id', 'required'),
			array('status, tariff_package_id', 'numerical', 'integerOnly'=>true),
			array('balance', 'numerical'),
			array('organization_name, phone', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, name, organization_name, status, balance, phone, email, created, tariff_package_id', 'safe', 'on'=>'search'),
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
			'tariffPackage' => array(self::BELONGS_TO, 'TariffPackage', 'tariff_package_id'),
			'sites' => array(self::HAS_MANY, 'Site', 'reseller_id'),
			'styles' => array(self::HAS_MANY, 'Style', 'reseller_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'name' => 'Name',
			'organization_name' => 'Organization Name',
			'status' => 'Status',
			'balance' => 'Balance',
			'phone' => 'Phone',
			'email' => 'Email',
			'created' => 'Created',
			'tariff_package_id' => 'Tariff Package',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('organization_name',$this->organization_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('tariff_package_id',$this->tariff_package_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reseller the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function countUsers()
    {
        $usersCount = 0;
        foreach($this->sites as $site)
        {
            $usersCount += count($site->users);
        }

        return $usersCount;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
