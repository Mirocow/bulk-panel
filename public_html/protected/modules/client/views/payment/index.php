<?php
 /* @var $this PaymentController */
?>
<?php $this->showMessages(); ?>
    <h2 class="page-title">
        Баланс
        <span class="label label-success">
            <?=$this->user->getBalance()?>
            <i class="fa fa-rub"></i>
        </span>
        <a href="<?=$this->createUrl('/client/payment/pay')?>" class="btn btn btn-success" title="Пополнить"><i class="fa fa-plus"></i></a>
    </h2>

    <h3>
        История платежей
    </h3>
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
    'htmlOptions' => ['class' => 'items table table-striped'],
    'pager' => [
        'htmlOptions' => ['class' => 'pagination'],
        'selectedPageCssClass' => 'active',
    ]
));
?>