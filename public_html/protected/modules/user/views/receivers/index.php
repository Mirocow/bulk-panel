<?php $this->showMessages(); ?>
    <h2 class="page-title">
    Базы получателей
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/user/receivers/create')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Добавить получателей</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        [
            'header' => 'Название службы',
            'name' => 'service.name',
            'value' => 'Service::getName($data->service, true)',
            'type' => 'raw',
        ],
        [
            'header' => 'Название',
            'name' => 'name',
        ],/*
        [
            'name' => 'total_entries',
            'value' => 'Html::NVL($data->total_entries)',
        ],
        [
            'name' => 'total_valid',
            'value' => 'Html::NVL($data->total_valid)',
        ],*/
        [
            'header' => 'Дата создания',
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetReceiversDeleteButton($data->id)',
        ]
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped'],
    'pager' => [
        'htmlOptions' => ['class' => 'pagination'],
        'selectedPageCssClass' => 'active',
    ]
));
?>