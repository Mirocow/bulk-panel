<?php $this->showMessages(); ?>
    <h2 class="page-title">
    Отправители
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/client/senders/create')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Добавить отправителя</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'service.name',
        'name',
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetSenderButton($data->id, true)',
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