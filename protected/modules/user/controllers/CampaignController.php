<?php
class CampaignController extends UserBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Campaign',[
            'criteria'=>array(
                'with' => [
                    'receiver',
                    'template' => [
                        'with' => ['service', 'templateType']
                    ],
                ],
                'condition'=>'t.user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.name ASC',
                'attributes' => [
                    'id' => [
                        'asc' => 'id ASC',
                        'desc' => 'id DESC',
                    ],
                    'status' => [
                        'asc' => 'status ASC',
                        'desc' => 'status DESC',
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
}