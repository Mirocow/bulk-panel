<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property integer $id
 * @property string $name
 * @property string $icon
 * @property string $color
 * @property integer $active
 * @property integer $template
 * @property integer $receiver
 * @property integer $sender
 *
 * The followings are the available model relations:
 * @property Campaign[] $campaigns
 * @property Receiver[] $receivers
 * @property Sender[] $senders
 * @property Site[] $sites
 * @property Tariff[] $tariffs
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
			array('active, template, receiver, sender', 'numerical', 'integerOnly'=>true),
			array('name, icon, color', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, icon, color, active, template, receiver, sender', 'safe', 'on'=>'search'),
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
			'campaigns' => array(self::HAS_MANY, 'Campaign', 'service_id'),
			'receivers' => array(self::HAS_MANY, 'Receiver', 'service_id'),
			'senders' => array(self::HAS_MANY, 'Sender', 'service_id'),
			'sites' => array(self::MANY_MANY, 'Site', 'site_has_service(service_id, site_id)'),
			'tariffs' => array(self::HAS_MANY, 'Tariff', 'service_id'),
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
			'active' => 'Active',
			'template' => 'Template',
			'receiver' => 'Receiver',
			'sender' => 'Sender',
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
		$criteria->compare('active',$this->active);
		$criteria->compare('template',$this->template);
		$criteria->compare('receiver',$this->receiver);
		$criteria->compare('sender',$this->sender);

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

    /**
     * @param int $action
     * @param Site $site
     * @return static[]
     */
    public static function getActive($action = null, $site = null)
    {
        if(!$site)
        {
            $params = ['active' => 1];
            if($action === self::ACTION_RECEIVER)
                $params['receiver'] = 1;
            elseif($action === self::ACTION_SENDER)
                $params['sender'] = 1;
            elseif($action === self::ACTION_TEMPLATE)
                $params['template'] = 1;

            return self::model()->findAllByAttributes($params);
        }

        $services = [];
        foreach($site->services as $service)
        {
            if(intval($service->active)) {
                if(
                    ($action === self::ACTION_RECEIVER && $service->receiver) ||
                    ($action === self::ACTION_SENDER && $service->sender) ||
                    ($action === self::ACTION_TEMPLATE && $service->template)
                )
                    $services[] = $service;
            }
        }

        return $services;
    }

    public static function getName($service, $withIcon = false)
    {
        if(!$withIcon)
            return $service->name;
        else
            return '<i class="'.$service->icon.'" style="color: #'.$service->color.';"></i> '.$service->name;
    }

    const ACTION_RECEIVER = 1;
    const ACTION_SENDER = 2;
    const ACTION_TEMPLATE = 3;

    const SERVICE_WHATSAPP = 1;
    const SERVICE_SKYPE = 2;
    const SERVICE_VIBER = 3;
    const SERVICE_INSTAGRAM = 4;
    const SERVICE_VK = 5;
    const SERVICE_SMS = 6;
    const SERVICE_EMAIL = 7;
    const SERVICE_AVITO = 8;
    const SERVICE_VOICE = 9;
}
