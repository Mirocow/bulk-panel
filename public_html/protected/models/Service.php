<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property integer $id
 * @property string $name
 * @property string $icon
 * @property string $color
 *
 * The followings are the available model relations:
 * @property Receiver[] $receivers
 * @property Sender[] $senders
 * @property TemplateType[] $templateTypes
 * @property Site[] $sites
 * @property Template[] $templates
 */
class Service extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, icon', 'required'),
			array('name, icon, color', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, icon, color', 'safe', 'on'=>'search'),
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
			'receivers' => array(self::HAS_MANY, 'Receiver', 'service_id'),
			'senders' => array(self::HAS_MANY, 'Sender', 'service_id'),
			'templateTypes' => array(self::MANY_MANY, 'TemplateType', 'service_has_template_type(service_id, template_type_id)'),
			'sites' => array(self::MANY_MANY, 'Site', 'site_has_service(service_id, site_id)'),
			'templates' => array(self::HAS_MANY, 'Template', 'service_id'),
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
			'icon' => 'Icon',
			'color' => 'Color',
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
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('color',$this->color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Service the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getActive()
    {
        return self::model()->findAllByAttributes(['active' => 1]);
    }
}
