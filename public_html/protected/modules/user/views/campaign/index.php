<?php
/* @var $this CampaignController */
/* @var $services Service[] */
/* @var $dataProvider CActiveDataProvider */
?>
<?php $this->showMessages(); ?>
<h2 class="page-title">
    Кампании
</h2>
<div class="row">
    <div class="col-md-12 form-group">
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-plus"></i> Новая кампания
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php foreach($services as $service): ?>
                    <li>
                        <a href="<?=$this->createUrl('/user/campaign/create',['id' => $service->id])?>" class="btn btn-sm btn-white" style="text-align: left;">
                            <i class="<?=$service->icon?>" style="color: #<?=$service->color?>"></i> <?=$service->name?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
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
            'name' => 'service.name',
        ],
        [
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'name' => 'status',
            'value' => 'CampaignStatus::getStatus($data->status)',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetCampaignDeleteButton($data->id, $data->status, true)',
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


