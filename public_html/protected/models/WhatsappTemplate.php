<?php

/**
 * This is the model class for table "whatsapp_template".
 *
 * The followings are the available columns in table 'whatsapp_template':
 * @property integer $template_id
 * @property integer $type
 * @property string $text_content
 * @property string $file_name
 * @property integer $sender_id
 *
 * The followings are the available model relations:
 * @property WhatsappCampaign[] $whatsappCampaigns
 * @property Sender $sender
 * @property Template $template
 */
class WhatsappTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'whatsapp_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template_id, type, sender_id', 'required'),
			array('template_id, type, sender_id', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>45),
			array('text_content', 'safe'),
            array('file', 'file', 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('template_id, type, text_content, file_name, sender_id', 'safe', 'on'=>'search'),
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
			'whatsappCampaigns' => array(self::HAS_MANY, 'WhatsappCampaign', 'whatsapp_template_id'),
			'sender' => array(self::BELONGS_TO, 'Sender', 'sender_id'),
			'template' => array(self::BELONGS_TO, 'Template', 'template_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'template_id' => 'Template',
			'type' => 'Type',
			'text_content' => 'Text Content',
			'file_name' => 'File Name',
			'sender_id' => 'Sender',
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

		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('text_content',$this->text_content,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('sender_id',$this->sender_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WhatsappTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public $file;
}
