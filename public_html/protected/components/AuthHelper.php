<?php

class AuthHelper
{
    const ROLE_USER = 1;
    const ROLE_RESELLER = 2;
    const ROLE_ADMIN = 3;

    public static function isReseller()
    {
        return Yii::app()->user->getState('role') === self::ROLE_RESELLER;
    }
    public static function isUser()
    {
        return Yii::app()->user->getState('role') === self::ROLE_USER;
    }
    public static function isAdmin()
    {
        return Yii::app()->user->getState('role') === self::ROLE_ADMIN;
    }

    public static function getIdentity($role, $username, $password)
    {
        switch($role)
        {
            case self::ROLE_USER: return new UserIdentity($username, $password);
            case self::ROLE_RESELLER: return new ResellerIdentity($username, $password);
            case self::ROLE_ADMIN: return new AdminIdentity($username, $password);
            default: throw new CHttpException(400);
        }
    }
}