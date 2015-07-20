<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property integer $id
 * @property integer $in
 * @property integer $status
 * @property double $amount
 * @property string $method
 * @property string $occurred
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Transaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('occurred, user_id', 'required'),
			array('in, status, user_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('method', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, in, status, amount, method, occurred, user_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'in' => 'In',
			'status' => 'Статус',
			'amount' => 'Сумма',
			'method' => 'Метод',
			'occurred' => 'Occurred',
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
		$criteria->compare('in',$this->in);
		$criteria->compare('status',$this->status);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('occurred',$this->occurred,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    const STATUS_PROCESS = 0;
    const STATUS_PENDING = 1;
    const STATUS_DECLINED = 2;
    const STATUS_ERROR = 3;
    const STATUS_COMPLETE = 4;

    public function getType()
    {
        return $this->in ? 'Поступление' : 'Списание';
    }

    public function getStatus()
    {
        switch($this->status)
        {
            case self::STATUS_PENDING: return 'В обработке';
            case self::STATUS_DECLINED: return 'Отклонена';
            case self::STATUS_COMPLETE: return 'Завершена';
            case self::STATUS_ERROR: return 'Ошибка';
            default: return 'Свяжитесь с нами';
        }
    }
}
