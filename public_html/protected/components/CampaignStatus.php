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

    public static function getStatus($status, $withIcon = false)
    {
        if(!$withIcon) {
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
        else {
            switch($status)
            {
                case self::STATUS_PENDING: return '<span class="text-info"><i class="fa fa-clock-o"></i> В обработке</span>';
                case self::STATUS_SENDING: return '<span class="text-warning"><i class="fa fa-cog fa-spin"></i> Выполняется</span>';
                case self::STATUS_SENT: return '<span class="text-success"><i class="fa fa-check"></i> Выполнена</span>';
                case self::STATUS_DECLINED: return '<span class="text-danger"><i class="fa fa-exclamation-circle"></i> Отклонена</span>';
                case self::STATUS_CANCELED: return '<span class="text-danger"><i class="fa fa-close"></i> Отменена</span>';
                default: return '<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Свяжитесь с нами</span>';
            }
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