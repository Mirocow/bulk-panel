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
                case self::STATUS_PENDING: return Yii::t('Model/Campaign', 'В обработке');
                case self::STATUS_SENDING: return Yii::t('Model/Campaign', 'Выполняется');
                case self::STATUS_SENT: return Yii::t('Model/Campaign', 'Выполнена');
                case self::STATUS_DECLINED: return Yii::t('Model/Campaign', 'Отклонена');
                case self::STATUS_CANCELED: return Yii::t('Model/Campaign', 'Отменена');
                default: return Yii::t('Model/Campaign', 'Свяжитесь с нами');
            }
        }
        else {
            switch($status)
            {
                case self::STATUS_PENDING: return '<span class="text-info"><i class="fa fa-clock-o"></i> ' . Yii::t('Model/Campaign', 'В обработке') . '</span>';
                case self::STATUS_SENDING: return '<span class="text-warning"><i class="fa fa-cog fa-spin"></i> ' . Yii::t('Model/Campaign', 'Выполняется') . '</span>';
                case self::STATUS_SENT: return '<span class="text-success"><i class="fa fa-check"></i> ' . Yii::t('Model/Campaign', 'Выполнена') . '</span>';
                case self::STATUS_DECLINED: return '<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' . Yii::t('Model/Campaign', 'Отклонена') . '</span>';
                case self::STATUS_CANCELED: return '<span class="text-danger"><i class="fa fa-close"></i> ' . Yii::t('Model/Campaign', 'Отменена') . '</span>';
                default: return '<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> ' . Yii::t('Model/Campaign', 'Свяжитесь с нами') . '</span>';
            }
        }
    }
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => Yii::t('Model/Campaign', 'В обработке'),
            self::STATUS_SENDING => Yii::t('Model/Campaign', 'Выполняется'),
            self::STATUS_SENT => Yii::t('Model/Campaign', 'Выполнена'),
            self::STATUS_DECLINED => Yii::t('Model/Campaign', 'Отклонена'),
            self::STATUS_CANCELED => Yii::t('Model/Campaign', 'Отменена'),
        ];
    }
}