<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $created
 * @property string $last_login
 * @property integer $site_id
 *
 * The followings are the available model relations:
 * @property Campaign[] $campaigns
 * @property Receiver[] $receivers
 * @property Sender[] $senders
 * @property Template[] $templates
 * @property Transaction[] $transactions
 * @property Site $site
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, name, created', 'required'),
			array('site_id', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>64),
			array('email, last_login', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, name, email, created, last_login, site_id', 'safe', 'on'=>'search'),
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
			'campaigns' => array(self::HAS_MANY, 'Campaign', 'user_id'),
			'receivers' => array(self::HAS_MANY, 'Receiver', 'user_id'),
			'senders' => array(self::HAS_MANY, 'Sender', 'user_id'),
			'templates' => array(self::HAS_MANY, 'Template', 'user_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'user_id'),
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
			'login' => 'Login',
			'password' => 'Password',
			'name' => 'Name',
			'email' => 'Email',
			'created' => 'Created',
			'last_login' => 'Last Login',
			'site_id' => 'Site',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('site_id',$this->site_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getBalance()
    {
        $result = 0;
        foreach($this->transactions as $transaction)
        {
            if($transaction->in)
                $result += $transaction->amount;
            else
                $result -= $transaction->amount;
        }

        return $result;
    }

    public function getSentCount()
    {
        /* @var $campaign Campaign */
        $total = 0;
        $campaigns = Campaign::model()->findAllByAttributes(['user_id' => $this->getPrimaryKey(), 'status' => Campaign::STATUS_SENT]);

        foreach($campaigns as $campaign)
        {
            $total += $campaign->sent;
        }

        return $total;
    }
}
