<?php $this->showMessages(); ?>
    <h2 class="page-title">
        Шаблоны
    </h2>
    <div class="row">
        <div class="col-md-12 form-group">
            <a href="<?=$this->createUrl('/user/template/create')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Добавить шаблон</a>
        </div>
    </div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'id',
        [
            'name' => 'type',
            'type' => 'raw',
            'value' => 'Html::GetTemplateType($data->templateType->name, $data->templateType->class)',
        ],
        'sender.name',
        'name',
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetTemplateButton($data->id)',
        ]
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped']
));
?>