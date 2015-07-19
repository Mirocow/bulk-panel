<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 19:48
 */


class TariffHelper
{
    public static function getTariffs($siteId = null)
    {
        $data = [];
        if($siteId)
        {
            $tariffModels = Tariff::model()->findAll([
                'condition' => 'site_id = :siteId AND root = 0',
                'params' => [':siteId' => $siteId],
                'order' => 'service_id, country_id, operator_id, tariff_threshold_id',
            ]);

            $serviceId = null;
            $countryId = null;
            $operatorId = null;

            $service = [];
            $operator = [];
            $country = [];

            $first = true;
            $tariff = null;

            foreach($tariffModels as $index => $tariffModel)
            {
                if($tariffModel->service_id != $serviceId)
                {
                    if(!$first)
                    {
                        if(!$country && !$operator)
                            $service['tariff'][] = $tariff;
                        elseif($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                        $data[] = $service;
                    }

                    $service = ['name' => $tariffModel->service->name, 'class' => $tariffModel->service->icon, 'color' => $tariffModel->service->color];
                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->country_id != $countryId)
                {
                    if(!$first)
                    {
                        if($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                    }

                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->operator_id != $operatorId)
                {
                    if(!$first)
                    {
                        $operator['tariff'][] = $tariff;
                        $country['operators'][] = $operator;
                    }
                    $operator = self::getOperator($tariffModel);
                }
                else {
                    if(!$country && !$operator)
                        $service['tariff'][] = $tariff;
                    elseif($country && !$operator)
                    {
                        $country['tariff'][] = $tariff;
                    }
                    else
                    {
                        $operator['tariff'][] = $tariff;
                    }
                }

                $serviceId = $tariffModel->service_id;
                $countryId = $tariffModel->country_id;
                $operatorId = $tariffModel->operator_id;

                $tariff = [
                    'price' => $tariffModel->price,
                    'basePrice' => $tariffModel->parent->price,
                    'id' => $tariffModel->getPrimaryKey(),
                    'baseId' => $tariffModel->parent_id,
                    'threshold' => [
                        'name' => $tariffModel->tariffThreshold->name,
                        'amount' => $tariffModel->tariffThreshold->amount,
                    ],
                ];

                $first = false;
            }
            if(!$country && !$operator)
                $service['tariff'][] = $tariff;
            elseif($country && !$operator)
            {
                $country['tariff'][] = $tariff;
                $service['countries'][] = $country;
            }
            else
            {
                $operator['tariff'][] = $tariff;
                $country['operators'][] = $operator;
                $service['countries'][] = $country;
            }
            $data[] = $service;
        }
        elseif(AuthHelper::isReseller())
        {
            $tariffModels = Tariff::model()->findAll([
                'condition' => 'site_id IS NULL AND root = 1 AND type=:type',
                'params' => [':type' => 'RESELLER'],
                'order' => 'service_id, country_id, operator_id, tariff_threshold_id',
            ]);

            $serviceId = null;
            $countryId = null;
            $operatorId = null;

            $service = [];
            $operator = [];
            $country = [];

            $first = true;
            $tariff = null;

            foreach($tariffModels as $index => $tariffModel)
            {
                if($tariffModel->service_id != $serviceId)
                {
                    if(!$first)
                    {
                        if(!$country && !$operator)
                            $service['tariff'][] = $tariff;
                        elseif($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                        $data[] = $service;
                    }

                    $service = ['name' => $tariffModel->service->name, 'class' => $tariffModel->service->icon, 'color' => $tariffModel->service->color];
                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->country_id != $countryId)
                {
                    if(!$first)
                    {
                        if($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                    }

                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->operator_id != $operatorId)
                {
                    if(!$first)
                    {
                        $operator['tariff'][] = $tariff;
                        $country['operators'][] = $operator;
                    }
                    $operator = self::getOperator($tariffModel);
                }
                else {
                    if(!$country && !$operator)
                        $service['tariff'][] = $tariff;
                    elseif($country && !$operator)
                    {
                        $country['tariff'][] = $tariff;
                    }
                    else
                    {
                        $operator['tariff'][] = $tariff;
                    }
                }

                $serviceId = $tariffModel->service_id;
                $countryId = $tariffModel->country_id;
                $operatorId = $tariffModel->operator_id;

                $tariff = [
                    'price' => $tariffModel->price,
                    'id' => $tariffModel->getPrimaryKey(),
                    'threshold' => [
                        'name' => $tariffModel->tariffThreshold->name,
                        'amount' => $tariffModel->tariffThreshold->amount,
                    ],
                ];

                $first = false;
            }
            if(!$country && !$operator)
                $service['tariff'][] = $tariff;
            elseif($country && !$operator)
            {
                $country['tariff'][] = $tariff;
                $service['countries'][] = $country;
            }
            else
            {
                $operator['tariff'][] = $tariff;
                $country['operators'][] = $operator;
                $service['countries'][] = $country;
            }
            $data[] = $service;
        }
        elseif(AuthHelper::isClient())
        {
            $tariffModels = Tariff::model()->findAll([
                'condition' => 'site_id IS NULL AND root = 1 AND type=:type',
                'params' => [':type' => 'CLIENT'],
                'order' => 'service_id, country_id, operator_id, tariff_threshold_id',
            ]);

            $serviceId = null;
            $countryId = null;
            $operatorId = null;

            $service = [];
            $operator = [];
            $country = [];

            $first = true;
            $tariff = null;

            foreach($tariffModels as $index => $tariffModel)
            {
                if($tariffModel->service_id != $serviceId)
                {
                    if(!$first)
                    {
                        if(!$country && !$operator)
                            $service['tariff'][] = $tariff;
                        elseif($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                        $data[] = $service;
                    }

                    $service = ['name' => $tariffModel->service->name, 'class' => $tariffModel->service->icon, 'color' => $tariffModel->service->color];
                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->country_id != $countryId)
                {
                    if(!$first)
                    {
                        if($country && !$operator)
                        {
                            $country['tariff'][] = $tariff;
                            $service['countries'][] = $country;
                        }
                        else
                        {
                            $operator['tariff'][] = $tariff;
                            $country['operators'][] = $operator;
                            $service['countries'][] = $country;
                        }
                    }

                    $country = self::getCountry($tariffModel);
                    $operator = self::getOperator($tariffModel);
                }
                elseif($tariffModel->operator_id != $operatorId)
                {
                    if(!$first)
                    {
                        $operator['tariff'][] = $tariff;
                        $country['operators'][] = $operator;
                    }
                    $operator = self::getOperator($tariffModel);
                }
                else {
                    if(!$country && !$operator)
                        $service['tariff'][] = $tariff;
                    elseif($country && !$operator)
                    {
                        $country['tariff'][] = $tariff;
                    }
                    else
                    {
                        $operator['tariff'][] = $tariff;
                    }
                }

                $serviceId = $tariffModel->service_id;
                $countryId = $tariffModel->country_id;
                $operatorId = $tariffModel->operator_id;

                $tariff = [
                    'price' => $tariffModel->price,
                    'id' => $tariffModel->getPrimaryKey(),
                    'threshold' => [
                        'name' => $tariffModel->tariffThreshold->name,
                        'amount' => $tariffModel->tariffThreshold->amount,
                    ],
                ];

                $first = false;
            }
            if(!$country && !$operator)
                $service['tariff'][] = $tariff;
            elseif($country && !$operator)
            {
                $country['tariff'][] = $tariff;
                $service['countries'][] = $country;
            }
            else
            {
                $operator['tariff'][] = $tariff;
                $country['operators'][] = $operator;
                $service['countries'][] = $country;
            }
            $data[] = $service;
        }
        return $data;
    }


    public static function getCountry($model)
    {
        if($model->country)
            return ['name' => $model->country->name];
        else
            return null;
    }

    public static function getOperator($model)
    {
        if($model->operator)
            return ['name' => $model->operator->name];
        else
            return null;
    }
}