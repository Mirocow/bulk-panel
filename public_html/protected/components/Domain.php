<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 20.06.15
 * Time: 10:25
 */

class Domain
{
    public static function isSubDomain()
    {
        $host = Domain::getDomain();

        if(Site::model()->countByAttributes(['domain' => $host]) || in_array($_SERVER['REMOTE_ADDR'], Domain::remoteAddrs()))
        {
            return true;
        }
        else
            return false;
    }

    /**
     * @return Site
     */
    public static function getCurrentSite()
    {
        $host = Domain::getDomain();

        if(in_array($_SERVER['REMOTE_ADDR'], Domain::remoteAddrs()))
            return Site::model()->findByPk(1);
        else
            return Site::model()->findByAttributes(['domain' => $host]);
    }
    public static function getDomain()
    {
        return $_SERVER['SERVER_NAME'];
    }
    public static function getCurrentSiteId()
    {
        $site = Domain::getCurrentSite();
        if($site)
            return $site->id;
        else
            return null;
    }
    public static function remoteAddrs()
    {
        return ['127.0.0.1'];
    }
}