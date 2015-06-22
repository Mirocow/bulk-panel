<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 20.06.15
 * Time: 18:53
 */

class ModelHelper
{
    public static function getServiceListData($id = null)
    {
        if($id !== null)
            $services = Site::model()->findByPk($id)->services;
        else
            $services = Service::model()->findAll();
        $listData = [];
        foreach($services as $service)
            $listData[] = ['id' => $service->id, 'text' => $service->name, 'icon' => 'service-icon '.$service->icon, 'color' => $service->color];

        return $listData;
    }
    public static function getTypeListData()
    {
        $templateTypes = Domain::getCurrentSite()->services[0]->templateTypes; //@todo Optimize

        $listData = [];
        foreach($templateTypes as $templateType)
            $listData[] = ['id' => $templateType->id, 'text' => $templateType->name, 'class' => 'type-icon '.$templateType->class];

        return $listData;
    }
}