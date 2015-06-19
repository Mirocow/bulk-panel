<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 19.06.15
 * Time: 16:38
 */

class SitesController extends Controller
{
    public $layout = 'reseller';

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Site',[
            'criteria'=>array(
                'condition'=>'reseller_id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ),
            'countCriteria'=>array(
                'condition'=>'reseller_id = :resellerId',
                'params' => [':resellerId' => Yii::app()->user->getId()]
            ),
            'sort' => [
                'defaultOrder' => 't.created DESC',
                'attributes' => [
                    'name' => [
                        'asc' => 't.name ASC',
                        'desc' => 't.name DESC',
                    ],
                    'url' => [
                        'asc' => 't.url ASC',
                        'desc' => 't.url DESC',
                    ],
                    'domain' => [
                        'asc' => 't.domain ASC',
                        'desc' => 't.domain DESC',
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
    public function actionView($id)
    {
        $model = Site::model()->findByAttributes(['id' => $id, 'reseller_id' => Yii::app()->user->getId()]);
        $styles = CHtml::listData(Reseller::model()->findByPk(Yii::app()->user->getId())->styles, 'id', 'title');
        array_unshift($styles, '--');

        if(isset($_POST['Site']))
        {
            $model->attributes = $_POST['Site'];

            if(!$model->style_id)
                $model->style_id = null;

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Сайт сохранен');
                $this->redirect(['/reseller/sites/view/', 'id' => $id]);
            }
        }

        $this->render('view', compact('model', 'styles'));
    }

    public function actionDelete($id)
    {
        Site::model()->deleteAllByAttributes(['id' => $id, 'reseller_id' => Yii::app()->user->getId()]);
        Yii::app()->user->setFlash('SUCCESS', 'Сайт удален!');
        $this->redirect(['/reseller/sites/index/']);
    }

    public function actionCreate()
    {
        $model = new Site();
        $styles = CHtml::listData(Reseller::model()->findByPk(Yii::app()->user->getId())->styles, 'id', 'title');
        array_unshift($styles, '--');

        if(isset($_POST['Site']))
        {
            $model->attributes = $_POST['Site'];
            $model->created = new CDbExpression('NOW()');

            if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('SUCCESS', 'Новый сайт создан!');
                $this->redirect(['/reseller/sites/index']);
            }
        }

        $this->render('create', compact('model', 'styles'));
    }
}