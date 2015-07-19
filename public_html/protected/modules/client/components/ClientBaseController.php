<?php
/**
 * @property Site $site
 * @property User $user
 */

class ClientBaseController extends Controller
{
    public $layout = 'client';
    public $user;

    public function filters() {
        return [
            ['application.filters.ClientFilter'],
        ];
    }

    public function beforeAction($action)
    {
        $this->user = User::model()->findByPk(Yii::app()->user->getId());
        return $this->user || Yii::app()->user->isGuest;

        return false;
    }
}