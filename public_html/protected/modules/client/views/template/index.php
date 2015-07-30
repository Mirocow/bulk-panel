<?php
/* @var $this TemplateController */
/* @var $services Service[] */
/* @var $dataProvider CActiveDataProvider */
?>
<?php $this->showMessages(); ?>
    <h2 class="page-title">
        <?=Yii::t('Modules/User','Шаблоны')?>
    </h2>
    <div class="row">
        <div class="col-md-12 form-group">
            <div class="dropdown">
                <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-plus"></i> <?=Yii::t('Modules/User','Новый шаблон')?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php foreach($services as $service): ?>
                        <li>
                            <a href="<?=$this->createUrl('/client/template/create',['id' => $service->id])?>" class="btn btn-sm btn-white" style="text-align: left;">
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
        [
            'header' => Yii::t('Modules/User','Название службы'),
            'name' => 'service.name',
            'value' => 'Service::getName($data->service, true)',
            'type' => 'raw',
        ],
        [
            'header' => Yii::t('Modules/User','Название'),
            'name' => 'name',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetTemplateButton($data->id, true)',
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