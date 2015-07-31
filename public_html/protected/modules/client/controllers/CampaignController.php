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
                        'asc' => 't.id ASC',
                        'desc' => 't.id DESC',
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

        if($model->status != Campaign::STATUS_SENDING)
        {
            $model->delete();
            Yii::app()->user->setFlash('SUCCESS', 'Кампания удалена!');
        }
        else {
            Yii::app()->user->setFlash('ERROR', 'В данный момент кампанию удалить нельзя');
        }

        $this->redirect(['/client/campaign/index/']);
    }
    public function actionCreate($id)
    {
        $model = new Campaign();
        $serviceId = intval($id);

        if(!$service = Service::model()->findByPk($serviceId))
            throw new CHttpException(404);

        if($serviceId === Service::SERVICE_WHATSAPP) //WhatsApp
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
                            Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['WhatsappCampaign']))
                $campaign->validate();

            $this->render('whatsapp/create', compact('model','campaign','templates','receivers', 'service'));
        }
        elseif($serviceId === Service::SERVICE_SKYPE) //Skype
        {
            $campaign = new SkypeCampaign();

            $templates = CHtml::listData(Template::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');

            if(isset($_POST['Campaign']) && isset($_POST['SkypeCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['SkypeCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate())
                    {
                        if($campaign->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['SkypeCampaign']))
                $campaign->validate();

            $this->render('skype/create', compact('model','campaign','templates', 'service'));
        }
        elseif($serviceId === Service::SERVICE_INSTAGRAM) //Instagram
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
                    if($campaign->validate() && $campaign->save())
                    {
                        Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                        $this->redirect(['/client/campaign/index/']);

                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['InstagramCampaign']))
                $campaign->validate();

            $this->render('instagram/create', compact('model','campaign', 'service'));
        }
        elseif($serviceId === Service::SERVICE_VK) //VK
        {
            $campaign = new VkCampaign();

            if(isset($_POST['Campaign']) && isset($_POST['VkCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['VkCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate()&& $campaign->save())
                    {
                        Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                        $this->redirect(['/client/campaign/index/']);
                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['VkCampaign']))
                $campaign->validate();

            $this->render('vk/create', compact('model','campaign', 'service'));
        }
        elseif($serviceId === Service::SERVICE_SMS) //SMS
        {
            $campaign = new SmsCampaign();

            $templates = CHtml::listData(Template::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');
            $receivers = CHtml::listData(Receiver::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');

            if(isset($_POST['Campaign']) && isset($_POST['SmsCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['SmsCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate())
                    {
                        if($campaign->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['SmsCampaign']))
                $campaign->validate();

            $this->render('sms/create', compact('model','campaign','templates','receivers', 'service'));
        }
        elseif($serviceId === Service::SERVICE_VOICE) //Voice
        {
            $campaign = new VoiceCampaign();

            $templates = CHtml::listData(Template::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');
            $receivers = CHtml::listData(Receiver::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $serviceId]), 'id', 'name');

            if(isset($_POST['Campaign']) && isset($_POST['VoiceCampaign']))
            {
                $model->attributes = $_POST['Campaign'];
                $model->created = new CDbExpression('NOW()');
                $model->status = Campaign::STATUS_PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $campaign->attributes = $_POST['VoiceCampaign'];

                if($model->validate() && $model->save())
                {
                    $campaign->setPrimaryKey($model->getPrimaryKey());
                    if($campaign->validate())
                    {
                        if($campaign->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', Yii::t('Common/Flash', 'Капания сохранена'));
                            $this->redirect(['/client/campaign/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }

            if(isset($_POST['Campaign']))
                $model->validate();
            if(isset($_POST['VoiceCampaign']))
                $campaign->validate();

            $this->render('voice/create', compact('model','campaign', 'templates', 'receivers', 'service'));
        }
        else
            $this->redirect(['/client/campaign/index']);
    }
}