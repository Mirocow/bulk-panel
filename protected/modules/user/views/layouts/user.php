<?php
/* @var $this UserBaseController */
?>
<?php $this->beginContent('//layouts/main'); ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=$this->createUrl('/user/campaign/index')?>"><?=$this->site->title?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Рассылки', 'url'=>array('/user/campaign/index')),
                        array('label'=>'Шаблоны', 'url'=>array('/user/template/index')),
                        array('label'=>'База получателей', 'url'=>array('/user/receivers/index')),
                        array('label'=>'Отправители', 'url'=>array('/user/senders/index')),
                    ),
                    'htmlOptions' => ['class' => 'nav navbar-nav'],
                )); ?>
                <?php $this->widget('zii.widgets.CMenu', [
                    'encodeLabel' => false,
                    'items' => [
                        array('label' => 'Контакты', 'url' => ['/user/page/contact']),
                        array('label' => 'Реквизиты', 'url' => ['/user/page/invoiceDetails']),
                        array('label' => 'Баланс: '.$this->user->getBalance().' <i class="fa fa-rub"></i>', 'url' => ['/user/payment/index'], 'itemOptions' => ['class' => 'total-balance']),
                        array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/user/defaultUser/logout'), 'htmlOptions' => ['class' => 'pull-right'], 'visible'=>!Yii::app()->user->isGuest)
                    ],
                    'htmlOptions' => ['class' => 'nav navbar-nav pull-right'],
                ]); ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <?= BreadCrumbs::render($this->breadcrumbs) ?>
        <?=$content;?>
    </div>
<?php $this->endContent(); ?>