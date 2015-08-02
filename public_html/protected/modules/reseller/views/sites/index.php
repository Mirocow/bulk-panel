<?php $this->showMessages(); ?>
<h2 class="page-title">
    <?=Yii::t('Module/Reseller', 'Ваши сайты')?>
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/reseller/sites/create')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> <?=Yii::t('Module/Reseller', 'Создать новый сайт')?></a>
        <a href="<?=$this->createUrl('/reseller/sites/manual')?>" class="btn btn-xs btn-warning pull-right"><?=Yii::t('Module/Reseller', 'Инструкция по настройке')?> <i class="fa fa-question"></i></a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array (
        [
            'header' => Yii::t('Module/Reseller', 'Название'),
            'name' => 'name',
        ],
        [
            'header' => 'URL',
            'name' => 'url',
        ],
        [
            'header' => Yii::t('Module/Reseller', 'Домен'),
            'name' => 'domain',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetSiteButton($data->id)',
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