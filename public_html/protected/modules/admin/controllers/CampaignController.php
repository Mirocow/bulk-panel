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
        /* @var $model Campaign */
        $model = Campaign::model()->findByPk($id);
        if(!$model)
            throw new CHttpException(404);

        $serviceId = intval($model->service_id);

        $statuses = CampaignStatus::getStatuses();

        if($serviceId === Service::SERVICE_WHATSAPP) //WhatsApp
        {
            $campaign = $model->whatsappCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('whatsapp/view', compact('model','campaign','statuses'));
        }
        elseif($serviceId === Service::SERVICE_SKYPE) //Skype
        {
            $campaign = $model->skypeCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('skype/view', compact('model','campaign','statuses'));
        }
        elseif($serviceId === Service::SERVICE_INSTAGRAM) //Instagram
        {
            $campaign = $model->instagramCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('instagram/view', compact('model','campaign','statuses'));
        }
        elseif($serviceId === Service::SERVICE_VK) //VK
        {
            $campaign = $model->vkCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('vk/view', compact('model','campaign','statuses'));
        }
        elseif($serviceId === Service::SERVICE_SMS) //SMS
        {
            $campaign = $model->smsCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('sms/view', compact('model','campaign','statuses'));
        }
        elseif($serviceId === Service::SERVICE_VOICE) //Voice
        {
            $campaign = $model->voiceCampaign;

            if(isset($_POST['Campaign']))
            {
                $model->attributes = $_POST['Campaign'];

                if($model->validate() && $model->save())
                {
                    Yii::app()->user->setFlash('SUCCESS', 'Капания сохранена');
                    $this->redirect(['/admin/campaign/index/']);
                }
            }

            $this->render('voice/view', compact('model','campaign','statuses'));
        }
        else
            $this->redirect(['/admin/campaign/index']);
    }
}