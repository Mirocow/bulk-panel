<?php
/* @var $this CampaignController */
/* @var $dataProvider CActiveDataProvider */
?>
<?php $this->showMessages(); ?>
<h2 class="page-title">
    Кампании
</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'id',
        'name',
        [
            'header' => 'Реселлер',
            'name' => 'user.site.reseller.organization_name',
        ],
        [
            'header' => 'Сайт',
            'name' => 'user.site.name',
        ],
        [
            'header' => 'Служба',
            'name' => 'service.name',
        ],
        [
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'name' => 'status',
            'value' => 'CampaignStatus::getStatus($data->status, true)',
            'type' => 'raw',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetCampaignAdminViewButton($data->id)',
        ],
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped'],
    'pager' => [
        'htmlOptions' => ['class' => 'pagination'],
        'selectedPageCssClass' => 'active',
    ]
));
?>


