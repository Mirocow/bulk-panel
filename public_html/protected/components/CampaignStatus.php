<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 23.06.15
 * Time: 1:22
 */

class CampaignStatus
{
    const STATUS_PENDING = 1;
    const STATUS_SENDING = 2;
    const STATUS_SENT = 3;
    const STATUS_DECLINED = 4;
    const STATUS_CANCELED = 5;

    public static function getStatus($status)
    {
        switch($status)
        {
            case self::STATUS_PENDING: return 'В обработке';
            case self::STATUS_SENDING: return 'Выполняется';
            case self::STATUS_SENT: return 'Выполнена';
            case self::STATUS_DECLINED: return 'Отклонена';
            case self::STATUS_CANCELED: return 'Отменена';
            default: return 'Свяжитесь с нами';
        }
    }
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'В обработке',
            self::STATUS_SENDING => 'Выполняется',
            self::STATUS_SENT => 'Выполнена',
            self::STATUS_DECLINED => 'Отклонена',
            self::STATUS_CANCELED => 'Отменена',
        ];
    }
}