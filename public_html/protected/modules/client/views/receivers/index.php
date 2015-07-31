<?php $this->showMessages(); ?>
    <h2 class="page-title">
    <?=Yii::t('Module/User', 'Базы получателей')?>
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/client/receivers/create')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> <?=Yii::t('Module/User', 'Добавить базу получателей')?></a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        [
            'header' => Yii::t('Module/User', 'Название службы'),
            'name' => 'service.name',
            'value' => 'Service::getServiceName($data->service, true)',
            'type' => 'raw',
        ],
        [
            'header' => Yii::t('Module/User', 'Название'),
            'name' => 'name',
        ],
        [
            'header' => Yii::t('Module/User', 'Дата создания'),
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