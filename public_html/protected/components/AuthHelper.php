<?php

class AuthHelper
{
    const ROLE_USER = 1;
    const ROLE_RESELLER = 2;
    const ROLE_ADMIN = 3;
    const ROLE_CLIENT = 4;

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
    public static function isClient()
    {
        return Yii::app()->user->getState('role') === self::ROLE_CLIENT;
    }

    public static function getIdentity($role, $username, $password)
    {
        switch($role)
        {
            case self::ROLE_USER: return new UserIdentity($username, $password);
            case self::ROLE_RESELLER: return new ResellerIdentity($username, $password);
            case self::ROLE_ADMIN: return new AdminIdentity($username, $password);
            case self::ROLE_CLIENT: return new ClientIdentity($username, $password);
            default: throw new CHttpException(400);
        }
    }

    public static function getRole()
    {
        if(Yii::app()->user->getState('role'))
        {
            switch(Yii::app()->user->getState('role'))
            {
                case self::ROLE_USER: return self::ROLE_USER;
                case self::ROLE_RESELLER: return self::ROLE_RESELLER;
                case self::ROLE_ADMIN: return self::ROLE_ADMIN;
                case self::ROLE_CLIENT: return self::ROLE_CLIENT;
                default: return null;
            }
        }

        return null;
    }
}