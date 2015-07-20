<?php
class ClientFilter extends CFilter
{
    public function preFilter($filterChain) {
        if(AuthHelper::isClient())
            return true;
        else
        {
            Yii::app()->request->redirect(Yii::app()->createUrl('/client/'), true);
            return false;
        }
    }
    public function postFilter($filterChain) {}
}