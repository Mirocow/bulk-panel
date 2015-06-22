<?php
/* @var $this CampaignController */
/* @var $dataProvider CActiveDataProvider */
?>
<?php $this->showMessages(); ?>
<h2 class="page-title">
    Кампании
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <a href="<?=$this->createUrl('/user/campaign/create')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Новая кампания</a>
    </div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'id',
        'name',
        [
            'header' => 'Служба',
            'name' => 'template.service.name',
        ],
        [
            'header' => 'Тип',
            'name' => 'template.templateType.name',
        ],
        [
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'name' => 'status',
            'value' => 'CampaignStatus::getStatus($data->status)',
        ],
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped']
));
?>


