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
 * @property integer $user_id
 * @property integer $service_id
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property User $user
 * @property InstagramCampaign $instagramCampaign
 * @property SkypeCampaign $skypeCampaign
 * @property SmsCampaign $smsCampaign
 * @property VkCampaign $vkCampaign
 * @property VoiceCampaign $voiceCampaign
 * @property WhatsappCampaign $whatsappCampaign
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
			array('name, status, created, user_id, service_id', 'required'),
			array('status, user_id, service_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, price, created, user_id, service_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'instagramCampaign' => array(self::HAS_ONE, 'InstagramCampaign', 'campaign_id'),
			'skypeCampaign' => array(self::HAS_ONE, 'SkypeCampaign', 'campaign_id'),
			'smsCampaign' => array(self::HAS_ONE, 'SmsCampaign', 'campaign_id'),
			'vkCampaign' => array(self::HAS_ONE, 'VkCampaign', 'campaign_id'),
			'voiceCampaign' => array(self::HAS_ONE, 'VoiceCampaign', 'campaign_id'),
			'whatsappCampaign' => array(self::HAS_ONE, 'WhatsappCampaign', 'campaign_id'),
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
			'user_id' => 'User',
			'service_id' => 'Service',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('service_id',$this->service_id);

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

    protected function afterSave()
    {
        parent::afterSave();

    }

    const STATUS_PENDING = 1;
    const STATUS_SENDING = 2;
    const STATUS_SENT = 3;
    const STATUS_DECLINED = 4;
    const STATUS_CANCELED = 5;
}
