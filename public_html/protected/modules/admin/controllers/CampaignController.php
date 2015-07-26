<?php

class CampaignController extends AdminBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Campaign',[
            'criteria' => [
                'with' => ['service'],
            ],
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'id' => [
                        'asc' => 'id ASC',
                        'desc' => 'id DESC',
                    ],
                    'status' => [
                        'asc' => 'status ASC',
                        'desc' => 'status DESC',
                    ],
                    'user.site.name' => [
                        'asc' => 'user.site.name ASC',
                        'desc' => 'user.site.name DESC',
                    ],
                    'user.site.reseller.organization_name' => [
                        'asc' => 'user.site.reseller.organization_name ASC',
                        'desc' => 'user.site.reseller.organization_name DESC',
                    ],
                    'created' => [
                        'asc' => 'created ASC',
                        'desc' => 'created DESC',
                    ],
                    'service.name' => [
                        'asc' => 'service.name ASC',
                        'desc' => 'service.name DESC',
                    ],
                    'name' => [
                        'asc' => 't.name ASC',
                        'desc' => 't.name DESC',
                    ],
                ]
            ],
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ]);

        $this->render('index', compact('dataProvider'));
    }

    public function actionView($id)
    {
        $model = Campaign::model()->findByPk($id);
        if(!$model)
            throw new CHttpException(404);

        $statuses = CampaignStatus::getStatuses();

        if(isset($_POST['Campaign']))
        {
            $model->attributes = $_POST['Campaign'];

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Кампания сохранена');
                $this->redirect(['/admin/campaign/index']);
            }
        }

        $this->render('view', compact('model', 'statuses'));
    }
}