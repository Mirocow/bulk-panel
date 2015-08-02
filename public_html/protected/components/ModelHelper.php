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
            $services = Service::getActive();
        $listData = [];
        foreach($services as $service) {
            if(intval($service->active))
                $listData[] = ['id' => $service->id, 'text' => $service->getName(), 'icon' => 'service-icon ' . $service->icon, 'color' => $service->color];
        }

        return $listData;
    }
    public static function getTypeListData($id = null)
    {
        if($id)
            $templateTypes = Site::model()->findByPk($id)->services[0]->templateTypes; //@todo Optimize
        else
            $templateTypes = Service::getActive()[0]->templateTypes;

        $listData = [];
        foreach($templateTypes as $templateType)
            $listData[] = ['id' => $templateType->id, 'text' => $templateType->name, 'class' => 'type-icon '.$templateType->class];

        return $listData;
    }
    public static function getSenderListData($service_id)
    {
        $senders = Sender::model()->findAllByAttributes(['service_id' => $service_id, 'user_id' => Yii::app()->user->getId()]);

        $listData = [];
        foreach($senders as $sender)
            $listData[] = ['id' => intval($sender->id), 'text' => $sender->name];

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