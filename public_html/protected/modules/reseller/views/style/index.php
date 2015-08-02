<?php
/* @var $this StyleController */
/* @var $dataProvider CActiveDataProvider */
?>
<h2 class="page-title">
    <?=Yii::t('Module/Reseller', 'Ваши CSS стили')?>
</h2>
<?php $this->showMessages(); ?>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/reseller/style/create')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> <?=Yii::t('Module/Reseller', 'Создать новый стиль')?></a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        [
            'header' => Yii::t('Module/Reseller', 'Название'),
            'name' => 'title',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetStyleButton($data->id)',
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