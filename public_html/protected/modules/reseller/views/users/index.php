<h2 class="page-title">
    Ваши клиенты
</h2>

<?php $this->showMessages(); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns'=>array(
        'login',
        'name',
        'balance',
        [
            'header' => 'Последний вход',
            'name' => 'last_login',
            'value' => 'Html::SQLDateFormat($data->last_login)',
        ],
        [
            'header' => 'Зарегистрирован',
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::GetUserButton($data->id)',
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