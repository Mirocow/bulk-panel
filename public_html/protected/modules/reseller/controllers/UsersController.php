<?php

class UsersController extends ResellerBaseController
{
    public $layout = 'reseller';
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User',[
            'criteria' => [
                'with' => [
                    'site' => [
                        'with' => ['reseller']
                    ]
                ],
                'condition'=>'reseller.id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ],
            'countCriteria' => [
                'with' => [
                    'site' => [
                        'with' => ['reseller']
                    ]
                ],
                'condition'=>'reseller.id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ],
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'login' => [
                        'asc' => 't.login asc',
                        'desc' => 't.login desc',
                    ],
                    'name' => [
                        'asc' => 't.name asc',
                        'desc' => 't.name desc',
                    ],
                    'balance' => [
                        'asc' => 't.balance asc',
                        'desc' => 't.balance desc',
                    ],
                    'created' => [
                        'asc' => 't.created asc',
                        'desc' => 't.created desc',
                    ],
                    'last_login' => [
                        'asc' => 't.last_login asc',
                        'desc' => 't.last_login desc',
                    ],
                ]
            ],
            'pagination' => [
                'pageSize'=>20,
            ],
        ]);

        $this->render('index', compact('dataProvider'));
    }
    public function actionView($id)
    {
        $transaction = new Transaction();

        $model = User::model()->with([
            'site' => [
                'with' => [
                    'reseller' => [
                        'condition' => '`reseller`.`id` = :resellerId',
                        'params' => [':resellerId' => Yii::app()->user->getId()],
                    ]
                ]
            ]
        ])->findByAttributes(['id' => $id]);

        if(!$model)
            throw new CHttpException(404);

        $paymentsDataProvider = new CActiveDataProvider('Transaction',[
            'criteria'=>array(
                'condition'=>'t.user_id = :userId',
                'params' => [':userId' => $id]
            ),
            'countCriteria'=>array(
                'condition'=>'user_id = :userId',
                'params' => [':userId' => $id]
            ),
            'sort' => [
                'defaultOrder' => 't.occurred DESC',
                'attributes' => [
                    'status' => [
                        'asc' => 'status ASC',
                        'desc' => 'status DESC',
                    ],
                    'amount' => [
                        'asc' => 'amount ASC',
                        'desc' => 'amount DESC',
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

        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Пользователь сохранен');
                $this->redirect(['/reseller/users/view/', 'id' => $id]);
            }
        }

        if(isset($_POST['Transaction']))
        {
            $transaction->attributes = $_POST['Transaction'];
            $transaction->method = '';
            $transaction->occurred = new CDbExpression('NOW()');
            $transaction->status = Transaction::STATUS_COMPLETE;
            $transaction->user_id = $id;
            if($transaction->validate() && $transaction->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Сохранено');
                $this->redirect(['/reseller/users/view', 'id' => $id]);
            }
        }

        $this->render('view', compact('model', 'paymentsDataProvider', 'transaction'));
    }
}
