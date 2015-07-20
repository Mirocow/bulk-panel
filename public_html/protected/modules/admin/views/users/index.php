<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */
?>
<h2 class="page-title">
    Пользователи
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
            'header' => 'Зарегистрирован',
            'name' => 'created',
            'value' => 'Html::SQLDateFormat($data->created)',
        ],
        [
            'header' => '',
            'type' => 'raw',
            'value' => 'Html::AdminGetUserButton($data->id)',
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