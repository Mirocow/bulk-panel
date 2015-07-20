<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 22.06.15
 * Time: 23:00
 */

class TemplateStatus
{
    const PENDING = 1;
    const APPROVED = 2;
    const DECLINED = 3;

    public static function getStatus($status)
    {
        switch($status)
        {
            case self::PENDING: return 'В обработке';
            case self::APPROVED: return 'Одобрен';
            case self::DECLINED: return 'Отклонен';
            default: return 'Свяжитесь с нами';
        }
    }
}