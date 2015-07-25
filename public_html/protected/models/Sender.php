<?php

/**
 * This is the model class for table "sender".
 *
 * The followings are the available columns in table 'sender':
 * @property integer $id
 * @property string $name
 * @property integer $has_avatar
 * @property string $file_name
 * @property integer $user_id
 * @property integer $service_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Service $service
 * @property WhatsappTemplate[] $whatsappTemplates
 */
class Sender extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sender';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, user_id, service_id', 'required'),
			array('has_avatar, user_id, service_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
            array('file','file','allowEmpty' => true),
			array('file_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, has_avatar, file_name, user_id, service_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'whatsappTemplates' => array(self::HAS_MANY, 'WhatsappTemplate', 'sender_id'),
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
			'has_avatar' => 'Has Avatar',
			'file_name' => 'File Name',
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
		$criteria->compare('has_avatar',$this->has_avatar);
		$criteria->compare('file_name',$this->file_name,true);
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
	 * @return Sender the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public $file;
}
