<?php
/**
 * @property Site $site
 * @property User $user
 */

class UserBaseController extends Controller
{
    public $layout = 'user';
    public $site;
    public $user;

    public function filters() {
        return [
            ['application.filters.UserFilter'],
        ];
    }

    public function beforeAction($action)
    {
        if($this->site = Domain::getCurrentSite()) // @todo
        {
            $this->user = User::model()->findByPk(Yii::app()->user->getId());
            return $this->user || Yii::app()->user->isGuest;
        }

        return false;
    }
}