<?php /* @var $this ResellerBaseController */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=$this->createUrl('/site/index')?>">
                    <img alt="Brand" src="<?=Yii::app()->request->baseUrl?>/images/navlogo.png">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Статус', 'url'=>array('/reseller/status/index')),
                        array('label'=>'Клиенты', 'url'=>array('/reseller/users/index')),
                        array('label'=>'Сайты', 'url'=>array('/reseller/sites/index'), 'visible' => AuthHelper::isReseller()),
                        array('label'=>'Стили', 'url'=>array('/reseller/style/index'), 'visible' => AuthHelper::isReseller()),
                    ),
                    'htmlOptions' => ['class' => 'nav navbar-nav'],
                )); ?>
                <?php $this->widget('zii.widgets.CMenu', [
                    'encodeLabel' => false,
                    'items' => [
                        array('label' => 'Баланс: '.$this->user->getBalance().' <i class="fa fa-rub"></i>', 'url' => ['#'], 'itemOptions' => ['class' => 'total-balance']),
                        array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'htmlOptions' => ['class' => 'pull-right'], 'visible'=>!Yii::app()->user->isGuest)
                    ],
                    'htmlOptions' => ['class' => 'nav navbar-nav navbar-right'],
                ]); ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        <?=$content;?>
    </div>
<?php $this->endContent(); ?>