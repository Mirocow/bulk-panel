<?php
class AdminFilter extends CFilter
{
    public function preFilter($filterChain) {
        if(AuthHelper::isAdmin())
            return true;
        else
        {
            Yii::app()->request->redirect(Yii::app()->createUrl('/admin'), true);
            return false;
        }
    }
    public function postFilter($filterChain) {}
}