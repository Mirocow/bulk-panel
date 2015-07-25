<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 20.06.15
 * Time: 13:42
 */

class TemplateController extends UserBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Template',[
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
                    'type' => [
                        'asc' => 'type ASC',
                        'desc' => 'type DESC',
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

        $services = Service::getActive(Service::ACTION_TEMPLATE, $this->site);

        $this->render('index', compact('dataProvider','services'));
    }

    public function actionView($id)
    {
        $model = Template::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId(), 'status' => TemplateStatus::PENDING]);
        if(!$model)
            throw new CHttpException(404);

        $serviceId = intval($model->service_id);

        if($serviceId === 1) //WHATSAPP
        {
            $template = WhatsappTemplate::model()->findByPk($model->getPrimaryKey());
            $sendersListData = CHtml::listData(Sender::model()->findAllByAttributes(['service_id' => $serviceId, 'user_id' => Yii::app()->user->getId()]), 'id', 'name');

            if(isset($_POST['Template']) && isset($_POST['WhatsappTemplate']))
            {

                $model->attributes = $_POST['Template'];

                $template->attributes = $_POST['WhatsappTemplate'];

                if($model->validate() && $model->save())
                {
                    if($template->validate())
                    {
                        if(!empty($_FILES['WhatsappTemplate']['name']['file']))
                        {
                            $template->file = CUploadedFile::getInstance($template,'file');
                            $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$template->file->extensionName;
                            $template->file->saveAs($path);

                            $template->file_name = $model->getPrimaryKey().'.'.$template->file->extensionName;
                        }
                        if($template->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                            $this->redirect(['/user/template/index/']);
                        }
                    }
                }
            }

            $this->render('whatsapp/view', compact('model', 'template','sendersListData'));
        }
        elseif($serviceId === 9) //Voice
        {
            $template = VoiceTemplate::model()->findByPk($model->getPrimaryKey());

            if(isset($_POST['Template']) && isset($_POST['VoiceTemplate']))
            {

                $model->attributes = $_POST['Template'];

                $template->attributes = $_POST['VoiceTemplate'];

                if($model->validate() && $model->save())
                {
                    if(!empty($_FILES['VoiceTemplate']['name']['file']))
                    {
                        $template->file = CUploadedFile::getInstance($template,'file');
                        $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$template->file->extensionName;
                        $template->file->saveAs($path);

                        $template->file_name = $model->getPrimaryKey().'.'.$template->file->extensionName;

                        if($template->validate() && $template->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                            $this->redirect(['/user/template/index/']);
                        }
                    }
                }
            }

            $this->render('voice/view', compact('model', 'template','sendersListData'));
        }
        else
            $this->redirect(['/user/template/index']);
    }

    public function actionDelete($id)
    {
        $model = Template::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);

        if(!$model)
            throw new CHttpException(404);

        $serviceId = intval($model->service_id);

        if($serviceId === 1) //WHATSAPP
        {
            $template = WhatsappTemplate::model()->findByPk($model->getPrimaryKey());
            
            foreach($template->whatsappCampaigns as $campaign)
            {
                if($campaign->campaign->status == Campaign::STATUS_PENDING)
                {
                    Yii::app()->user->setFlash('ERROR', 'Данный шаблон используется одной из кампаний');
                    $this->redirect(['/user/template/index/']);
                    die();
                }
            }

            Yii::app()->user->setFlash('SUCCESS', 'Шаблон удален!');
            $model->delete();
        }
        elseif($serviceId === 9) //Voice
        {
            $template = VoiceTemplate::model()->findByPk($model->getPrimaryKey());


            foreach($template->voiceCampaigns as $campaign)
            {
                if($campaign->campaign->status == Campaign::STATUS_PENDING)
                {
                    Yii::app()->user->setFlash('ERROR', 'Данный шаблон используется одной из кампаний');
                    $this->redirect(['/user/template/index/']);
                    die();
                }
            }

            Yii::app()->user->setFlash('SUCCESS', 'Шаблон удален!');
            $model->delete();
        }

        $this->redirect(['/user/template/index/']);
    }

    public function actionCreate($id)
    {
        $serviceId = intval($id);
        $model = new Template();

        if($serviceId === 1) //WHATSAPP
        {
            $template = new WhatsappTemplate();
            $sendersListData = CHtml::listData(Sender::model()->findAllByAttributes(['service_id' => $serviceId, 'user_id' => Yii::app()->user->getId()]), 'id', 'name');

            if(isset($_POST['Template']) && isset($_POST['WhatsappTemplate']))
            {

                $model->attributes = $_POST['Template'];
                $model->created = new CDbExpression('NOW()');
                $model->status = TemplateStatus::PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $template->attributes = $_POST['WhatsappTemplate'];
                $template->type = 0;

                if($model->validate() && $model->save())
                {
                    $template->template_id = $model->getPrimaryKey();
                    if($template->validate())
                    {
                        if(!empty($_FILES['WhatsappTemplate']['name']['file']))
                        {
                            $template->file = CUploadedFile::getInstance($template,'file');
                            $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$template->file->extensionName;
                            $template->file->saveAs($path);

                            $template->file_name = $model->getPrimaryKey().'.'.$template->file->extensionName;
                        }
                        if($template->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                            $this->redirect(['/user/template/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }
            $this->render('whatsapp/create', compact('model', 'template','sendersListData'));
        }
        elseif($serviceId === 9) //Voice
        {
            $template = new VoiceTemplate();

            if(isset($_POST['Template']) && isset($_POST['VoiceTemplate']))
            {

                $model->attributes = $_POST['Template'];
                $model->created = new CDbExpression('NOW()');
                $model->status = TemplateStatus::PENDING;
                $model->user_id = Yii::app()->user->getId();
                $model->service_id = $serviceId;

                $template->attributes = $_POST['VoiceTemplate'];

                if($model->validate() && $model->save())
                {
                    $template->template_id = $model->getPrimaryKey();
                    if(!empty($_FILES['VoiceTemplate']['name']['file']))
                    {
                        $template->file = CUploadedFile::getInstance($template,'file');
                        $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$template->file->extensionName;
                        $template->file->saveAs($path);

                        $template->file_name = $model->getPrimaryKey().'.'.$template->file->extensionName;

                        if($template->validate() && $template->save())
                        {
                            Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                            $this->redirect(['/user/template/index/']);
                        }
                        else
                            $model->delete();
                    }
                    else
                        $model->delete();
                }
            }
            $this->render('voice/create', compact('model', 'template'));
        }
        else
            $this->redirect(['/user/template/index']);
    }
}