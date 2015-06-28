<?php

class AuthHelper
{
    public static function isReseller()
    {
        return Yii::app()->user->getState('__id')!==null && Yii::app()->user->getState('role') === 'RESELLER';
    }
    public static function isUser()
    {
        return Yii::app()->user->getState('__id')!==null && Yii::app()->user->getState('role') === 'USER';
    }
}