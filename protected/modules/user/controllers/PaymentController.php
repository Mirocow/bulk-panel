<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 1:47
 */

class PaymentController extends UserBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Transaction',[
            'criteria'=>array(
                'condition'=>'t.user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.occurred DESC',
                'attributes' => [
                    'status' => [
                        'asc' => 'status ASC',
                        'desc' => 'status DESC',
                    ],
                    'in' => [
                        'asc' => 'in ASC',
                        'desc' => 'in DESC',
                    ],
                    'occurred' => [
                        'asc' => 'occurred ASC',
                        'desc' => 'occurred DESC',
                    ],
                    'method' => [
                        'asc' => 'method ASC',
                        'desc' => 'method DESC',
                    ],
                ]
            ],
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ]);

        $this->render('index', compact('dataProvider'));
    }
}