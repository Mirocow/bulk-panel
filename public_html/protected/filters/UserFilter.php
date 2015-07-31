<?php
class UserFilter extends CFilter
{
    public function preFilter($filterChain) {
        if(AuthHelper::isUser())
            return true;
        else
        {
            Yii::app()->request->redirect(Yii::app()->createUrl('/user/'), true);
            return false;
        }
    }
    public function postFilter($filterChain) {}
}