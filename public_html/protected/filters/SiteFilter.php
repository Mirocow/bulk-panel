<?php
class SiteFilter extends CFilter
{
    public function preFilter($filterChain) {
        if(Domain::isSubDomain()) {
            Yii::app()->request->redirect(Yii::app()->createUrl('/user/'), true);
            return false;
        }
        return true;
    }
    public function postFilter($filterChain) {}
}