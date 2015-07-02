<?php

class CampaignController extends AdminBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Campaign',[
            'criteria'=>array(
                'with' => [
                    'user' => [
                        'with' => [
                            'site' => [
                                'with' => ['reseller'],
                            ]
                        ]
                    ],
                    'receiver',
                    'template' => [
                        'with' => [
                            'service',
                            'templateType'
                        ]
                    ],
                ],
            ),
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
                    'receiver.name' => [
                        'asc' => 'receiver.name ASC',
                        'desc' => 'receiver.name DESC',
                    ],
                    'template.name' => [
                        'asc' => 'template.name ASC',
                        'desc' => 'template.name DESC',
                    ],
                    'template.service.name' => [
                        'asc' => 'template.service.name ASC',
                        'desc' => 'template.service.name DESC',
                    ],
                    'template.templateType.name' => [
                        'asc' => 'template.templateType.name ASC',
                        'desc' => 'template.templateType.name DESC',
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