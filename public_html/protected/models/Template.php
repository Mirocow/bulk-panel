<?php

/**
 * This is the model class for table "template".
 *
 * The followings are the available columns in table 'template':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $created
 * @property integer $service_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property SkypeTemplate $skypeTemplate
 * @property SmsTemplate $smsTemplate
 * @property Service $service
 * @property User $user
 * @property VoiceTemplate $voiceTemplate
 * @property WhatsappTemplate $whatsappTemplate
 */
class Template extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, created, service_id, user_id', 'required'),
			array('status, service_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, created, service_id, user_id', 'safe', 'on'=>'search'),
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
			'skypeTemplate' => array(self::HAS_ONE, 'SkypeTemplate', 'template_id'),
			'smsTemplate' => array(self::HAS_ONE, 'SmsTemplate', 'template_id'),
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'voiceTemplate' => array(self::HAS_ONE, 'VoiceTemplate', 'template_id'),
			'whatsappTemplate' => array(self::HAS_ONE, 'WhatsappTemplate', 'template_id'),
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
			'created' => 'Created',
			'service_id' => 'Service',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Template the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
