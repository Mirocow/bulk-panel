<?php $this->showMessages(); ?>
    <h2 class="page-title">
    Базы получателей
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/client/receivers/create')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Добавить получателей</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'service.name',
        'name',/*
        [
            'name' => 'total_entries',
            'value' => 'Html::NVL($data->total_entries)',
        ],
        [
            'name' => 'total_valid',
            'value' => 'Html::NVL($data->total_valid)',
        ],*/
        [
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetReceiversDeleteButton($data->id, true)',
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