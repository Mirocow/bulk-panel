<?php

class AuthHelper
{
    const ROLE_USER = 1;
    const ROLE_RESELLER = 2;

    public static function isReseller()
    {
        return Yii::app()->user->getState('role') === 'RESELLER';
    }
    public static function isUser()
    {
        return Yii::app()->user->getState('role') === 'USER';
    }
}