<?php
class SendersController extends UserBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Sender',[
            'criteria'=>array(
                'with' => ['service'],
                'condition'=>'user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'user_id = :userId',
                'params' => [':userId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.name ASC',
                'attributes' => [
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
        $model = Sender::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);
        $services = CHtml::listData(Service::getActive(Service::ACTION_SENDER, $this->site), 'id', 'name');

        if(isset($_POST['Sender']))
        {
            $model->attributes = $_POST['Sender'];

            if($model->validate() && $model->save())
            {
                if($_FILES['Sender']['name']['file'] != '')
                {
                    $model->file = CUploadedFile::getInstance($model,'file');
                    $path = Yii::getPathOfAlias('webroot').'/files/sender_avatars/'.$model->getPrimaryKey().'.'.$model->file->extensionName;
                    $model->file->saveAs($path);

                    $model->file_name = $model->getPrimaryKey().'.'.$model->file->extensionName;
                    $model->has_avatar = 1;
                    $model->save();
                }
                elseif($model->has_avatar == 1) {
                    $model->has_avatar = 0;
                    $model->save();
                }

                Yii::app()->user->setFlash('SUCCESS', 'Отправитель сохранен');
                $this->redirect(['/user/senders/index/', 'id' => $id]);
            }
        }

        $this->render('view', compact('model','services'));
    }

    public function actionDelete($id)
    {
        $sender = Sender::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);
        if(!$sender)
            $this->redirect(['/user/senders/index/']);

        foreach($sender->templates as $template)
        {
            foreach($template->campaigns as $campaign)
            {
                if($campaign->status == Campaign::STATUS_PENDING)
                {
                    Yii::app()->user->setFlash('ERROR', 'Данный отправитель используется одной из кампаний');
                    $this->redirect(['/user/senders/index/']);
                    die();
                }
            }
        }
        $sender->delete();
        Yii::app()->user->setFlash('SUCCESS', 'Отправитель удален!');
        $this->redirect(['/user/senders/index/']);
    }

    public function actionCreate()
    {
        $model = new Sender();
        $services = CHtml::listData(Service::getActive(Service::ACTION_SENDER, $this->site), 'id', 'name');

        if(isset($_POST['Sender']))
        {
            $model->attributes = $_POST['Sender'];
            $model->user_id = Yii::app()->user->getId();
            $model->has_avatar = 0;

            if($model->validate() && $model->save())
            {
                if($_FILES['Sender']['name']['file'] != '')
                {
                    $model->file = CUploadedFile::getInstance($model,'file');
                    $path = Yii::getPathOfAlias('webroot').'/files/sender_avatars/'.$model->getPrimaryKey().'.'.$model->file->extensionName;
                    $model->file->saveAs($path);

                    $model->file_name = $model->getPrimaryKey().'.'.$model->file->extensionName;
                    $model->has_avatar = 1;
                    $model->save();
                }

                Yii::app()->user->setFlash('SUCCESS', 'Отправитель создан!');
                $this->redirect(['/user/senders/index']);
            }
        }

        $this->render('create', compact('model','services'));
    }

    public function actionGetJson($service_id)
    {
        echo json_encode(ModelHelper::getSenderListData($service_id));
    }
}