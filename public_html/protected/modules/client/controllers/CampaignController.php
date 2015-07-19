<?php
class CampaignController extends ClientBaseController
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

    public function actionDelete($id)
    {
        $campaign = Campaign::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);

        if($campaign)
        {
            if($campaign->status != Campaign::STATUS_SENDING)
            {
                $campaign->delete();
                Yii::app()->user->setFlash('SUCCESS', 'Кампания удалена!');
            }
            else {
                Yii::app()->user->setFlash('ERROR', 'В данный момент кампанию удалить нельзя');
            }
        }
        $this->redirect(['/client/campaign/index/']);
    }

    public function actionCreate()
    {
        $templateModels = $this->user->templates;
        $receiverModels = $this->user->receivers;

        if(!count($templateModels) || !count($receiverModels))
        {
            Yii::app()->user->setFlash('ERROR', 'Сначала добавьте хотя бы один шаблон и базу получателей');
            $this->redirect(['/client/campaign/index']);
        }

        $model = new Campaign();
        $templates = CHtml::listData($templateModels, 'id', 'name');
        $receivers = CHtml::listData(Receiver::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $templateModels[0]->service_id]), 'id', 'name');

        if(isset($_POST['Campaign']))
        {
            $model->attributes = $_POST['Campaign'];
            $model->user_id = Yii::app()->user->getId();
            $model->created = new CDbExpression('NOW()');
            $model->status = Campaign::STATUS_PENDING;

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Кампания создана!');
                $this->redirect(['/client/campaign/index']);
            }
        }

        $this->render('create', compact('model','templates', 'receivers'));
    }
}