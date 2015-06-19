<?php
class Html
{
    public static function GetSiteButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/reseller/sites/view', 'id' => $id], ['class' => 'btn btn-sm btn-info pull-right']);
    }
    public static function GetUserButton($id)
    {
        return CHtml::link('<i class="fa fa-info"></i>', ['/reseller/users/view', 'id' => $id], ['class' => 'btn btn-sm btn-info pull-right']);
    }
    public static function GetStyleButton($id)
    {
        return CHtml::link('<i class="fa fa-folder-open"></i>', ['/reseller/style/view', 'id' => $id], ['class' => 'btn btn-sm btn-info pull-right']);
    }
    public static function SQLDateFormat($date)
    {
        return date('H:i:s Y.m.d', strtotime($date));
    }
}