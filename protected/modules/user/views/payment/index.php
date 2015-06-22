<?php $this->showMessages(); ?>
    <h2 class="page-title">
        История баланса
    </h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        [
            'header' => '',
            'name' => 'in',
            'value' => '$data->getType()',
        ],
        [
            'header' => 'Время совершения',
            'name' => 'occurred',
            'value' => 'Html::SQLDateFormat($data->occurred)',
        ],
        'method',
        [
            'name' => 'status',
            'value' => '$data->getStatus()',
        ],
    ),
    'itemsCssClass' => 'table table-striped',
    'htmlOptions' => ['class' => 'items table table-striped']
));
?>