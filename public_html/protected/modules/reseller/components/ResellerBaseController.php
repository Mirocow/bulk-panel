<?php

class ResellerBaseController extends Controller
{
    public $layout = 'reseller';
    public $site;
    public $user;

    public function filters() {
        return [
            ['application.filters.SiteFilter'],
            ['application.filters.ResellerFilter'],
        ];
    }

    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)) return false;

        $this->user = Reseller::model()->findByPk(Yii::app()->user->getId());
        return $this->user || Yii::app()->user->isGuest;
    }
}