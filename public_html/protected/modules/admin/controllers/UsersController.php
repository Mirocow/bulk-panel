<?php

class UsersController extends AdminBaseController
{
    public function actionIndex($clients = null)
    {
        $dataProvider = new CActiveDataProvider('User',[
            'criteria' => [
                'condition' => 'site_id',
            ],
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'id' => [
                        'asc' => 't.id asc',
                        'desc' => 't.id desc',
                    ],
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
                    'site_id' => [
                        'asc' => 't.site_id asc',
                        'desc' => 't.site_id desc',
                    ],
                ]
            ],
            'pagination' => [
                'pageSize'=>20,
            ],
        ]);
        //@todo VIEW CLIENTS
        $this->render('index', compact('dataProvider'));
    }
    public function actionView($id)
    {
        $model = User::model()->findByPk($id);
        $transaction = new Transaction();

        if(!$model)
            throw new CHttpException(404);

        if(isset($_POST['Transaction']))
        {
            $transaction->attributes = $_POST['Transaction'];
            //$transaction->in = 0;
            $transaction->method = '';
            $transaction->occurred = new CDbExpression('NOW()');
            $transaction->status = Transaction::STATUS_COMPLETE;
            $transaction->user_id = $id;
            if($transaction->validate() && $transaction->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Сохранено');
                $this->redirect(['/admin/users/index']);
            }
        }

        $this->render('view', compact('model', 'transaction'));
    }

    public function actionDelete($id)
    {
        User::model()->deleteByPk($id);
        Yii::app()->user->setFlash('SUCCESS', 'Пользователь удален');
        $this->redirect(['/admin/users/index']);
    }
}