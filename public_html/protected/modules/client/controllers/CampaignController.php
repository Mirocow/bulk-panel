<?php
class CampaignController extends ClientBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Campaign',[
            'criteria'=>array(
                'with' => ['service'],
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

        $services = Service::getActive();

        $this->render('index', compact('dataProvider','services'));
    }

    public function actionDelete($id)
    {
        $model = Campaign::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);

        if(!$model)
            throw new CHttpException(404);

        $serviceId = intval($model->service_id);

        if($serviceId === 1) //WHATSAPP
        {
            if($model->status != Campaign::STATUS_SENDING)
            {
                $model->delete();
                Yii::app()->user->setFlash('SUCCESS', 'Кампания удалена!');
            }
            else {
                Yii::app()->user->setFlash('ERROR', 'В данный момент кампанию удалить нельзя');
            }
        }
        elseif($serviceId === 4) //Instagram
        {
            if($model->status != Campaign::STATUS_SENDING)
            {
                $model->delete();
                Yii::app()->user->setFlash('SUCCESS', 'Кампания удалена!');
            }
            else {
                Yii::app()->user->setFlash('ERROR', 'В данный момент кампанию удалить нельзя');
            }
        }

        $this->redirect(['/client/campaign/index/']);
    }
    public function actionCreate($id)
    {
        $model = new Campaign();
        $serviceId = intval($id);

        if($serviceId === 1)
        {
            $campaign = new WhatsappCampaign();

            $templates = CHtml::listData(Template::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');
            $receivers = CHtml::listData(Receiver::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');

            if(isset($_POST['Campaign']) && isset($_POST['WhatsappCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['WhatsappCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate())
                    {
                        if($campaign->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            $this->render('whatsapp/create', compact('model','campaign','templates','receivers'));
        }
        elseif($serviceId === 4) //Instagram
        {
            $campaign = new InstagramCampaign();

            if(isset($_POST['Campaign']) && isset($_POST['InstagramCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['InstagramCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate())
                    {
                        if($campaign->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            $this->render('instagram/create', compact('model','campaign'));
        }
        else
            $this->redirect(['/client/campaign/index']);
    }
}