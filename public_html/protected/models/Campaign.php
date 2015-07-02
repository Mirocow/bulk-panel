<?php

/**
 * This is the model class for table "campaign".
 *
 * The followings are the available columns in table 'campaign':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property double $price
 * @property string $created
 * @property integer $sent
 * @property integer $template_id
 * @property integer $receiver_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Template $template
 * @property Receiver $receiver
 * @property User $user
 */
class Campaign extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'campaign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, created, template_id, receiver_id, user_id', 'required'),
			array('status, sent, template_id, receiver_id, user_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, price, created, sent, template_id, receiver_id, user_id', 'safe', 'on'=>'search'),
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
			'template' => array(self::BELONGS_TO, 'Template', 'template_id'),
			'receiver' => array(self::BELONGS_TO, 'Receiver', 'receiver_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'status' => 'Status',
			'price' => 'Price',
			'created' => 'Created',
			'sent' => 'Sent',
			'template_id' => 'Template',
			'receiver_id' => 'Receiver',
			'user_id' => 'User',
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
		$criteria->compare('status',$this->status);
		$criteria->compare('price',$this->price);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Campaign the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    const STATUS_PENDING = 1;
    const STATUS_SENDING = 2;
    const STATUS_SENT = 3;
}
