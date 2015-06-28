<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 1:22
 */

class CampaignStatus
{
    const PENDING = 1;
    const CANCELED = 2;
    const FINISHED = 3;

    public static function getStatus($status)
    {
        switch($status)
        {
            case self::PENDING: return 'В обработке';
            case self::CANCELED: return 'Отменен';
            case self::FINISHED: return 'Завершен';
            default: return 'Свяжитесь с нами';
        }
    }
}