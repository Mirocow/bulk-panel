<?php

/**
 * This is the model class for table "whatsapp_campaign".
 *
 * The followings are the available columns in table 'whatsapp_campaign':
 * @property integer $campaign_id
 * @property integer $sent
 * @property integer $receiver_id
 * @property integer $whatsapp_template_id
 *
 * The followings are the available model relations:
 * @property Receiver $receiver
 * @property Campaign $campaign
 * @property WhatsappTemplate $whatsappTemplate
 */
class WhatsappCampaign extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'whatsapp_campaign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('campaign_id, receiver_id, whatsapp_template_id', 'required'),
			array('campaign_id, sent, receiver_id, whatsapp_template_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('campaign_id, sent, receiver_id, whatsapp_template_id', 'safe', 'on'=>'search'),
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
			'receiver' => array(self::BELONGS_TO, 'Receiver', 'receiver_id'),
			'campaign' => array(self::BELONGS_TO, 'Campaign', 'campaign_id'),
			'whatsappTemplate' => array(self::BELONGS_TO, 'WhatsappTemplate', 'whatsapp_template_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'campaign_id' => 'Campaign',
			'sent' => 'Sent',
			'receiver_id' => 'Receiver',
			'whatsapp_template_id' => 'Whatsapp Template',
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

		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('whatsapp_template_id',$this->whatsapp_template_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WhatsappCampaign the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
