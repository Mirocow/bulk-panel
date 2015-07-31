<?php
 /* @var $this PaymentController */
?>
<?php $this->showMessages(); ?>
    <h2 class="page-title">
        <?=Yii::t('Module/User', 'Баланс')?>
        <span class="label label-success">
            <?=$this->user->getBalance()?>
            <i class="fa fa-rub"></i>
        </span>
        <a href="<?=$this->createUrl('/client/payment/pay')?>" class="btn btn btn-success" title="<?=Yii::t('Module/User', 'Пополнить')?>"><i class="fa fa-plus"></i></a>
    </h2>

    <h3>
        <?=Yii::t('Module/User', 'История платежей')?>
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
            'header' => Yii::t('Module/User', 'Время совершения'),
            'name' => 'occurred',
            'value' => 'Html::SQLDateFormat($data->occurred)',
        ],
        [
            'header' => Yii::t('Module/User', 'Метод'),
            'name' => 'method',
        ],
        [
            'header' => Yii::t('Module/User', 'Статус'),
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