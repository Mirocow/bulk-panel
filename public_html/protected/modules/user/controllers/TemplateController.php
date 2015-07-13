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
                'with' => ['templateType','sender','service'],
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
                    'sender.name' => [
                        'asc' => 'sender.name ASC',
                        'desc' => 'sender.name DESC',
                    ],
                    'templateType.name' => [
                        'asc' => 'templateType.name ASC',
                        'desc' => 'templateType.name DESC',
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
        $model = Template::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId(), 'status' => TemplateStatus::PENDING]);
        $serviceModels = Domain::getCurrentSite()->services;
        $services = json_encode(ModelHelper::getServiceListData(Domain::getCurrentSiteId()));

        $types = CHtml::listData($serviceModels[0]->templateTypes,'id','name');
        $typesListData = json_encode(ModelHelper::getTypeListData());

        $senderModels = Sender::model()->findByAttributes(['service_id' => $serviceModels[0]->id, 'user_id' => Yii::app()->user->getId()]);
        $sendersListData = json_encode(ModelHelper::getSenderListData($serviceModels[0]->id));

        if(isset($_POST['Template']))
        {
            $model->attributes = $_POST['Template'];

            if(empty($_FILES['Template']['name']['file']) && $model->templateType->attachment == 1)
            {
                Yii::app()->user->setFlash('ERROR', 'Для данного типа шаблона нужно прикрепить файл');
            }
            elseif($model->text_content == '' && $model->templateType->text == 1)
            {
                Yii::app()->user->setFlash('ERROR', 'Для данного типа шаблона нужно указать текст');
            }
            else
            {
                if($model->validate() && $model->save())
                {
                    if(!empty($_FILES['Template']['name']['file']))
                    {
                        $model->file = CUploadedFile::getInstance($model,'file');
                        $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$model->file->extensionName;
                        $model->file->saveAs($path);

                        $model->file_name = $model->getPrimaryKey().'.'.$model->file->extensionName;
                        $model->save();
                    }

                    Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                    $this->redirect(['/user/template/index/']);
                }
            }
        }

        $mainForm = $this->actionGetView($model->id, $model->service_id, $model->template_type_id, false);

        $this->render('view', compact('model','services', 'servicesArray', 'types', 'typesListData', 'sendersListData', 'mainForm'));
    }

    public function actionDelete($id)
    {
        Template::model()->deleteAllByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);
        Yii::app()->user->setFlash('SUCCESS', 'Шаблон удален!');
        $this->redirect(['/user/templates/index/']);
    }

    public function actionCreate()
    {
        $model = new Template();
        $serviceModels = Domain::getCurrentSite()->services;
        $services = json_encode(ModelHelper::getServiceListData(Domain::getCurrentSiteId()));

        $types = CHtml::listData($serviceModels[0]->templateTypes,'id','name');
        $typesListData = json_encode(ModelHelper::getTypeListData());

        $senderModels = Sender::model()->findByAttributes(['service_id' => $serviceModels[0]->id, 'user_id' => Yii::app()->user->getId()]);
        $sendersListData = json_encode(ModelHelper::getSenderListData($serviceModels[0]->id));

        $service = $serviceModels[0]->getPrimaryKey();
        $type = $serviceModels[0]->templateTypes[0]->getPrimaryKey();

        if(count($senderModels) == 0)
        {
            Yii::app()->user->setFlash('ERROR', 'Добавьте хотя бы одного отправителя');
            $this->redirect(['/user/senders/index']);
        }

        if(isset($_POST['Template']))
        {
            $model->attributes = $_POST['Template'];
            $model->created = new CDbExpression('NOW()');
            $model->status = TemplateStatus::PENDING;
            $model->user_id = Yii::app()->user->getId();

            if(empty($_FILES['Template']['name']['file']) && $model->templateType->attachment == 1)
            {
                Yii::app()->user->setFlash('ERROR', 'Для данного типа шаблона нужно прикрепить файл');
            }
            elseif($model->text_content == '' && $model->templateType->text == 1)
            {
                Yii::app()->user->setFlash('ERROR', 'Для данного типа шаблона нужно указать текст');
            }
            else
            {
                if($model->validate() && $model->save())
                {
                    if(!empty($_FILES['Template']['name']['file']))
                    {
                        $model->file = CUploadedFile::getInstance($model,'file');
                        $path = Yii::getPathOfAlias('webroot').'/files/template/'.$model->getPrimaryKey().'.'.$model->file->extensionName;
                        $model->file->saveAs($path);

                        $model->file_name = $model->getPrimaryKey().'.'.$model->file->extensionName;
                        $model->save();
                    }

                    Yii::app()->user->setFlash('SUCCESS', 'Шаблон сохранен');
                    $this->redirect(['/user/template/index/']);
                }
            }
        }

        $mainForm = $this->actionGetView($service, $type, null, false, $model);

        $this->render('create', compact('model','services', 'servicesArray', 'types', 'typesListData', 'mainForm', 'service', 'type', 'sendersListData'));
    }

    public function actionGetView($service, $type, $id = null, $render = true, $currentModel = null)
    {
        $form = new CActiveForm();
        if($id == null)
        {
            if(!$currentModel)
                $model = new Template();
            else
                $model = $currentModel;
        }
        else
            $model = Template::model()->findByAttributes(['id' => $id, 'user_id' => Yii::app()->user->getId()]);

        $serviceTemplate = ServiceHasTemplateType::model()->findByAttributes(['service_id' => $service, 'template_type_id' => $type]);

        if($serviceTemplate && $model)
        {
            if($render)
                $this->renderPartial('forms/'.$serviceTemplate->file, compact('model', 'form'));
            else
                return $this->renderPartial('forms/'.$serviceTemplate->file, compact('model', 'form'), true);
        }
    }
}