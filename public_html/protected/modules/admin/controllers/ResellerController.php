<?php

class ResellerController extends AdminBaseController
{
    public function actionIndex()
    {
        $resellersDataProvider = new CActiveDataProvider('Reseller',[
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'login' => [
                        'asc' => 't.login asc',
                        'desc' => 't.login desc',
                    ],
                    'organization_name' => [
                        'asc' => 't.organization_name asc',
                        'desc' => 't.organization_name desc',
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
                ]
            ],
            'pagination' => [
                'pageSize'=>20,
            ],
        ]);

        $claimsDataProvider = new CActiveDataProvider('ResellerClaim',[
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'login' => [
                        'asc' => 't.login asc',
                        'desc' => 't.login desc',
                    ],
                    'organization_name' => [
                        'asc' => 't.organization_name asc',
                        'desc' => 't.organization_name desc',
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
                ]
            ],
            'pagination' => [
                'pageSize'=>20,
            ],
        ]);

        $claimsCount = ResellerClaim::model()->count();

        $this->render('index', compact('resellersDataProvider', 'claimsDataProvider', 'claimsCount'));
    }

    public function actionView($id)
    {
        $model = Reseller::model()->findByPk($id);

        if(!$model)
            throw new CHttpException(404);

        if(isset($_POST['Reseller']))
        {
            $model->attributes = $_POST['Reseller'];

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Реселлер сохранен');
                $this->redirect(['/admin/reseller/index']);
            }
        }

        $this->render('view', compact('model'));
    }

    public function actionApproveClaim($id)
    {
        $claim = ResellerClaim::model()->findByPk($id);
        if (!$claim)
            throw new CHttpException(404);

        $reseller = new Reseller();
        $reseller->attributes = $claim->attributes;
        $reseller->status = 3;
        if ($reseller->validate() && $reseller->save()) {
            $claim->delete();
            Yii::app()->user->setFlash('SUCCESS', 'Заявка успешно принята');
            $this->redirect(['/admin/reseller/view', 'id' => $reseller->getPrimaryKey()]);
        } else {
            var_dump($reseller->getErrors());
        }
    }

    public function actionDeclineClaim($id)
    {
        ResellerClaim::model()->deleteByPk($id);
        Yii::app()->user->setFlash('SUCCESS', 'Заявка удалена');
        $this->redirect(['/admin/reseller/index']);
    }

    public function actionDelete($id)
    {
        Reseller::model()->deleteByPk($id);
        Yii::app()->user->setFlash('SUCCESS', 'Реселлер удален');
        $this->redirect(['/admin/reseller/index']);
    }
}