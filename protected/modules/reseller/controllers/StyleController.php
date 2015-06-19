<?php

class StyleController extends Controller
{
    public $layout = 'reseller';

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Style',[
            'criteria'=>array(
                'condition'=>'reseller_id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'reseller_id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.title ASC',
                'attributes' => [
                    'title' => [
                        'asc' => 't.title ASC',
                        'desc' => 't.title DESC',
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
        $model = Style::model()->findByAttributes(['id' => $id, 'reseller_id' => Yii::app()->user->getId()]);

        if(isset($_POST['Style']))
        {
            $model->attributes = $_POST['Style'];

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Стиль сохранен');
                $this->redirect(['/reseller/styles/view/', 'id' => $id]);
            }
        }

        $this->render('view', compact('model'));
    }

    public function actionDelete($id)
    {
        Style::model()->deleteAllByAttributes(['id' => $id, 'reseller_id' => Yii::app()->user->getId()]);
        Yii::app()->user->setFlash('SUCCESS', 'Стиль удален!');
        $this->redirect(['/reseller/style/index']);
    }

    public function actionCreate()
    {
        $model = new Style();

        if(isset($_POST['Style']))
        {
            $model->attributes = $_POST['Style'];
            $model->reseller_id = Yii::app()->user->getId();

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Новый стиль создан!');
                $this->redirect(['/reseller/style/index']);
            }
        }

        $this->render('create', compact('model'));
    }
}