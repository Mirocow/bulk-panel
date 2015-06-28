<?php
class ReceiversController extends UserBaseController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Receiver',[
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
                    'total_entries' => [
                        'asc' => 't.total_entries ASC',
                        'desc' => 't.total_entries DESC',
                    ],
                    'total_valid' => [
                        'asc' => 't.total_valid ASC',
                        'desc' => 't.total_valid DESC',
                    ],
                    'created' => [
                        'asc' => 't.created ASC',
                        'desc' => 't.created DESC',
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
        Receiver::model()->deleteAllByAttributes(['id' => $id]); //@todo Проверить на права
        Yii::app()->user->setFlash('SUCCESS', 'Отправитель удален!');
        $this->redirect(['/user/receivers/index/']);
    }

    public function actionCreate()
    {
        $model = new Receiver();
        $services = CHtml::listData(Domain::getCurrentSite()->services, 'id', 'name');

        if(isset($_POST['Receiver']))
        {
            $model->attributes = $_POST['Receiver'];
            $model->created = new CDbExpression('NOW()');
            $model->user_id = Yii::app()->user->getId();


            if($model->validate() && $model->save())
            {
                $model->file = CUploadedFile::getInstance($model,'file');
                $path = Yii::getPathOfAlias('webroot').'/files/receivers/'.$model->getPrimaryKey().'.'.$model->file->extensionName;
                $model->file->saveAs($path);

                Yii::app()->user->setFlash('SUCCESS', 'Отправитель создан!');
                $this->redirect(['/user/receivers/index']);
            }
        }

        $this->render('create', compact('model', 'services'));
    }

    public function actionGetJson($template_id = null)
    {
        $data = [];
        $receivers = [];
        if(!$template_id)
            $receivers = CHtml::listData($this->user->receivers, 'id', 'name');
        else
        {
            $template = Template::model()->findByPk($template_id);
            if($template)
                $receivers = CHtml::listData(Receiver::model()->findAllByAttributes(['user_id' => Yii::app()->user->getId(), 'service_id' => $template->service_id]), 'id', 'name');
        }

        foreach($receivers as $id => $value)
            $data[] = ['id' => $id, 'value' => $value];

        echo json_encode($data);
    }
}