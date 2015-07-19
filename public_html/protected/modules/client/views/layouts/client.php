<?php
/* @var $this ClientBaseController */
?>
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
                        array('label'=>'Кампании', 'url'=>array('/client/campaign/index')),
                        array('label'=>'Шаблоны', 'url'=>array('/client/template/index')),
                        array('label'=>'База получателей', 'url'=>array('/client/receivers/index')),
                        array('label'=>'Отправители', 'url'=>array('/client/senders/index')),
                    ),
                    'htmlOptions' => ['class' => 'nav navbar-nav'],
                )); ?>
                <?php $this->widget('zii.widgets.CMenu', [
                    'encodeLabel' => false,
                    'items' => [
                        [
                            'label' => 'Информация',
                            'itemOptions' => ['class' => 'dropdown'],
                            'linkOptions'=> [
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ],
                            'url' => ['#'],
                            'items' => [
                                [
                                    'label' => 'Тарифы',
                                    'url' => ['/client/page/tariffs']
                                ],
                                [
                                    'label' => 'Контакты',
                                    'url' => ['/client/page/contact']
                                ],
                                [
                                    'label' => 'Реквизиты',
                                    'url' => ['/client/page/invoiceDetails']
                                ],
                            ]
                        ],
                        [
                            'label' => 'Баланс: '.$this->user->getBalance().' <i class="fa fa-rub"></i>',
                            'url' => ['/client/payment/index'],
                            'itemOptions' => ['class' => 'total-balance']
                        ],
                        [
                            'label' => 'Выход ('.Yii::app()->user->name.')',
                            'url' => ['/client/defaultClient/logout'],
                            'htmlOptions' => ['class' => 'pull-right'],
                            'visible' => !Yii::app()->user->isGuest,
                        ]
                    ],
                    'submenuHtmlOptions' => ['class' => 'dropdown-menu'],
                    'htmlOptions' => ['class' => 'nav navbar-nav navbar-right'],
                ]); ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <?=$content;?>
    </div>
<?php $this->endContent(); ?>