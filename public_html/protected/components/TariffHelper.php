<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 19:48
 */


class TariffHelper
{
    public static function getPackage($siteId = null)
    {
        $data = [];
        if($siteId)
        {
            $tariffPackage = TariffPackage::model()->findByAttributes(['site_id' => $siteId]);
            if($tariffPackage)
            {
                $tariffModels = Tariff::model()->findAll([
                    'condition' => 'tariff_package_id = :tariffPackageId',
                    'params' => [':tariffPackageId' => $tariffPackage->getPrimaryKey()],
                    'order' => 'service_id, country_id, operator_id',
                ]);

                $baseTariffModels = Tariff::model()->findAll([
                    'condition' => 'tariff_package_id = :tariffPackageId',
                    'params' => [':tariffPackageId' => $tariffPackage->parent_id],
                    'order' => 'service_id, country_id, operator_id',
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
                                $service['tariff'] = $tariff;
                            elseif($country && !$operator)
                            {
                                $country['tariff'] = $tariff;
                                $service['countries'][] = $country;
                            }
                            else
                            {
                                $operator['tariff'] = $tariff;
                                $country['operators'][] = $operator;
                                $service['countries'][] = $country;
                            }
                            $data[] = $service;
                        }

                        $service = ['name' => $tariffModel->service->name];
                        $country = self::getCountry($tariffModel);
                        $operator = self::getOperator($tariffModel);
                    }
                    elseif($tariffModel->country_id != $countryId)
                    {
                        if(!$first)
                        {
                            if($country && !$operator)
                            {
                                $country['tariff'] = $tariff;
                                $service['countries'][] = $country;
                            }
                            else
                            {
                                $operator['tariff'] = $tariff;
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
                            $operator['tariff'] = $tariff;
                            $country['operators'][] = $operator;
                        }
                        $operator = self::getOperator($tariffModel);
                    }

                    $serviceId = $tariffModel->service_id;
                    $countryId = $tariffModel->country_id;
                    $operatorId = $tariffModel->operator_id;

                    $tariff = [
                        'price' => $tariffModel->price,
                        'basePrice' => $baseTariffModels[$index]->price,
                        'id' => $tariffModel->getPrimaryKey(),
                        'baseId' => $baseTariffModels[$index]->getPrimaryKey(),
                    ];

                    $first = false;
                }
                if(!$country && !$operator)
                    $service['tariff'] = $tariff;
                elseif($country && !$operator)
                {
                    $country['tariff'] = $tariff;
                    $service['countries'][] = $country;
                }
                else
                {
                    $operator['tariff'] = $tariff;
                    $country['operators'][] = $operator;
                    $service['countries'][] = $country;
                }
                $data[] = $service;
            }
        }
        elseif(Yii::app()->user->isReseller())
        {
            $reseller = Reseller::model()->findByPk(Yii::app()->user->getId());
            if($reseller)
            {
                $tariffPackage = TariffPackage::model()->findByPk($reseller->tariff_package_id);

                if ($tariffPackage)
                {
                    $tariffModels = Tariff::model()->findAll([
                        'condition' => 'tariff_package_id = :tariffPackageId',
                        'params' => [':tariffPackageId' => $tariffPackage->id],
                        'order' => 'service_id, country_id, operator_id',
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
                                    $service['tariff'] = $tariff;
                                elseif($country && !$operator)
                                {
                                    $country['tariff'] = $tariff;
                                    $service['countries'][] = $country;
                                }
                                else
                                {
                                    $operator['tariff'] = $tariff;
                                    $country['operators'][] = $operator;
                                    $service['countries'][] = $country;
                                }
                                $data[] = $service;
                            }

                            $service = ['name' => $tariffModel->service->name];
                            $country = self::getCountry($tariffModel);
                            $operator = self::getOperator($tariffModel);
                        }
                        elseif($tariffModel->country_id != $countryId)
                        {
                            if(!$first)
                            {
                                if($country && !$operator)
                                {
                                    $country['tariff'] = $tariff;
                                    $service['countries'][] = $country;
                                }
                                else
                                {
                                    $operator['tariff'] = $tariff;
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
                                $operator['tariff'] = $tariff;
                                $country['operators'][] = $operator;
                            }
                            $operator = self::getOperator($tariffModel);
                        }

                        $serviceId = $tariffModel->service_id;
                        $countryId = $tariffModel->country_id;
                        $operatorId = $tariffModel->operator_id;

                        $tariff = [
                            'price' => $tariffModel->price,
                            'id' => $tariffModel->getPrimaryKey(),
                        ];

                        $first = false;
                    }
                    if(!$country && !$operator)
                        $service['tariff'] = $tariff;
                    elseif($country && !$operator)
                    {
                        $country['tariff'] = $tariff;
                        $service['countries'][] = $country;
                    }
                    else
                    {
                        $operator['tariff'] = $tariff;
                        $country['operators'][] = $operator;
                        $service['countries'][] = $country;
                    }
                    $data[] = $service;
                }
            }
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