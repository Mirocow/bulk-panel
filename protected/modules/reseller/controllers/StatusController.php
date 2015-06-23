<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 23:52
 */
class StatusController extends Controller
{
    public $layout = 'reseller';
    public function actionIndex()
    {
        $reseller = Reseller::model()->findByPk(Yii::app()->user->getId());
        $this->render('index', compact('reseller'));
    }
}