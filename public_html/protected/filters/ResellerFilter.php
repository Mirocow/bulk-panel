<?php
class ResellerFilter extends CFilter
{
    public function preFilter($filterChain) {
        if(Yii::app()->user->isReseller())
            return true;
        else
        {
            Yii::app()->request->redirect(Yii::app()->createUrl('/site/login'), true);
            return false;
        }
    }
    public function postFilter($filterChain) {}
}