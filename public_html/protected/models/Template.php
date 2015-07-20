<?php

/**
 * This is the model class for table "template".
 *
 * The followings are the available columns in table 'template':
 * @property integer $id
 * @property string $name
 * @property string $text_content
 * @property string $file_name
 * @property integer $status
 * @property string $created
 * @property integer $sender_id
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $template_type_id
 *
 * The followings are the available model relations:
 * @property Campaign[] $campaigns
 * @property Sender $sender
 * @property Service $service
 * @property User $user
 * @property TemplateType $templateType
 */
class Template extends CActiveRecord
{
    public $file;
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
			array('name, status, created, sender_id, service_id, user_id, template_type_id', 'required'),
			array('status, sender_id, service_id, user_id, template_type_id', 'numerical', 'integerOnly'=>true),
			array('text_content, file_name', 'safe'),
            array('file', 'file', 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, text_content, file_name, status, created, sender_id, service_id, user_id, template_type_id', 'safe', 'on'=>'search'),
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
			'campaigns' => array(self::HAS_MANY, 'Campaign', 'template_id'),
			'sender' => array(self::BELONGS_TO, 'Sender', 'sender_id'),
			'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'templateType' => array(self::BELONGS_TO, 'TemplateType', 'template_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'text_content' => 'Текст',
			'file_name' => 'File Name',
			'status' => 'Статус',
			'created' => 'Создана',
			'sender_id' => 'Отправитель',
			'service_id' => 'Служба',
			'user_id' => 'User',
			'template_type_id' => 'Тип',
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
		$criteria->compare('text_content',$this->text_content,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('template_type_id',$this->template_type_id);

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
