<?php
class Html
{
    public static function GetSiteButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/reseller/sites/view', 'id' => $id], ['class' => 'btn btn-xs btn-info pull-right']);
    }
    public static function GetUserButton($id)
    {
        return CHtml::link('<i class="fa fa-info"></i>', ['/reseller/users/view', 'id' => $id], ['class' => 'btn btn-xs btn-info pull-right']);
    }
    public static function GetStyleButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/reseller/style/view', 'id' => $id], ['class' => 'btn btn-xs btn-info pull-right']);
    }
    public static function GetSenderButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/user/senders/view', 'id' => $id], ['class' => 'btn btn-xs btn-info pull-right']);
    }
    public static function GetTemplateButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/user/template/view', 'id' => $id], ['class' => 'btn btn-xs btn-info pull-right']);
    }
    public static function GetReceiversDeleteButton($id)
    {
        return CHtml::link('<i class="fa fa-close"></i>', ['/user/receivers/delete', 'id' => $id], ['class' => 'btn btn-xs btn-danger pull-right']);
    }
    public static function GetCampaignDeleteButton($id, $status)
    {
        if($status == Campaign::STATUS_SENDING)
            return '';

        return CHtml::link('<i class="fa fa-close"></i>', ['/user/campaign/delete', 'id' => $id], ['class' => 'btn btn-xs btn-danger pull-right']);
    }
    public static function GetTemplateType($type, $class)
    {
        return '<i class="'.$class.'"></i> '.$type;
    }
    public static function NVL($data, $value = 'Обрабатывается...')
    {
        if($data)
            return $data;
        else
            return $value;
    }
    public static function SQLDateFormat($date)
    {
        return date('H:i:s Y.m.d', strtotime($date));
    }

}