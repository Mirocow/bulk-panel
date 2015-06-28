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

        if(isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Пользователь сохранен');
                $this->redirect(['/reseller/users/view/', 'id' => $id]);
            }
        }

        $this->render('view', compact('model'));
    }
}
