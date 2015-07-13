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
    public static function getSenderListData($service_id)
    {
        $senders = Sender::model()->findByAttributes(['service_id' => $service_id, 'user_id' => Yii::app()->user->getId()]);

        $listData = [];
        foreach($senders as $sender)
            $listData[] = ['id' => $sender->id, 'text' => $sender->name];

        return $listData;
    }
    public static function getReceiverListData($serviceId = null)
    {
        $params = ['user_id' => Yii::app()->user->getId()];

        if($serviceId)
            $params['service_id'] = $serviceId;

        $receivers = Receiver::model()->findAllByAttributes($params);

        $listData = [];
        foreach($receivers as $receiver)
            $listData[] = ['id' => $receiver->id, 'text' => $receiver->name];

        return $listData;
    }
}