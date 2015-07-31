<?php $this->showMessages(); ?>
    <h2 class="page-title">
    Отправители
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/user/senders/create')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Добавить отправителя</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        [
            'header' => 'Название службы',
            'name' => 'service.name',
            'value' => 'Service::getServiceName($data->service, true)',
            'type' => 'raw',
        ],
        [
            'header' => 'Название',
            'name' => 'name',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetSenderButton($data->id)',
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