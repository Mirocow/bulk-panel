<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 19.06.15
 * Time: 16:38
 */

class SitesController extends ResellerBaseController
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
        $services = json_encode(ModelHelper::getServiceListData());
        $activeServices = json_encode(ModelHelper::getServiceListData($id));
        $styles = CHtml::listData(Reseller::model()->findByPk(Yii::app()->user->getId())->styles, 'id', 'title');
        array_unshift($styles, '--');

        $tariffs = TariffHelper::getTariffs($id);

        if(isset($_POST['Site']))
        {
            if(isset($_POST['Services']))
            {
                if(count($_POST['Services']) > 0)
                {
                    $model->attributes = $_POST['Site'];
                    SiteHasService::model()->deleteAllByAttributes(['site_id' => $id]);

                    foreach($_POST['Services'] as $service)
                    {
                        $link = new SiteHasService();
                        $link->site_id = $id;
                        $link->service_id = intval($service);
                        $link->save();
                    }

                    if(isset($_POST['Price']))
                    {
                        foreach($_POST['Price'] as $id=>$price)
                        {
                            $tariff = Tariff::model()->findByAttributes(['site_id' => Domain::getCurrentSiteId(), 'id' => $id]);
                            if($tariff)
                            {
                                $tariff->price = $price;
                                $tariff->save();
                            }
                        }
                    }

                    if(!$model->style_id)
                        $model->style_id = null;

                    if($model->validate() && $model->save())
                    {
                        Yii::app()->user->setFlash('SUCCESS', 'Сайт сохранен');
                        $this->redirect(['/reseller/sites/view/', 'id' => $model->getPrimaryKey()]);
                    }
                }
                else
                    Yii::app()->user->setFlash('ERROR', 'Выберите хотя бы один сервис');
            }
        }

        $this->render('view', compact('model', 'styles','services','activeServices', 'tariffs'));
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
        $services = json_encode(ModelHelper::getServiceListData());
        $styles = CHtml::listData(Reseller::model()->findByPk(Yii::app()->user->getId())->styles, 'id', 'title');
        array_unshift($styles, '--');

        $tariffs = TariffHelper::getTariffs();

        if(isset($_POST['Site']))
        {
            if(isset($_POST['Services']))
            {
                if (count($_POST['Services']) > 0)
                {
                    $model->attributes = $_POST['Site'];
                    $model->created = new CDbExpression('NOW()');
                    $model->reseller_id = Yii::app()->user->getId();

                    if($model->validate() && $model->save())
                    {
                        foreach($_POST['Services'] as $service)
                        {
                            $link = new SiteHasService();
                            $link->site_id = $model->getPrimaryKey();
                            $link->service_id = intval($service);
                            $link->save();
                        }

                        //Добавляем тарифы сайту
                        foreach(Tariff::model()->findAllByAttributes(['root' => 1]) as $rootTariff)
                        {
                            $newTariff = new Tariff();
                            $newTariff->attributes = $rootTariff->attributes;
                            $newTariff->root = 0;
                            $newTariff->parent_id = $rootTariff->getPrimaryKey();
                            $newTariff->site_id = $model->getPrimaryKey();
                            $newTariff->type = 'SECONDARY_CLIENT';

                            if(isset($_POST['Price'][$rootTariff->getPrimaryKey()]))
                                $newTariff->price = $_POST['Price'][$rootTariff->getPrimaryKey()];

                            $newTariff->save();
                        }

                        Yii::app()->user->setFlash('SUCCESS', 'Новый сайт создан!');
                        $this->redirect(['/reseller/sites/index']);
                    }
                }
                else
                    Yii::app()->user->setFlash('ERROR', 'Выберите хотя бы один сервис');
            }

        }

        $this->render('create', compact('model', 'styles', 'services', 'tariffs'));
    }
}