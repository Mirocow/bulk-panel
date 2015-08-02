<?php $this->beginContent('//layouts/main'); ?>
    <div class="wrapper">
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
                    <?php $this->widget('zii.widgets.CMenu', [
                        'items' => [
                            [
                                'label' => Yii::t('Common/Navbar','Главная'),
                                'url' => ['/site/index']
                            ],
                            [
                                'label' => Yii::t('Common/Navbar','Регистрация'),
                                'itemOptions' => ['class' => 'dropdown'],
                                'linkOptions'=> [
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                ],
                                'url' => ['#'],
                                'visible' => Yii::app()->user->isGuest,
                                'items' => [
                                    [
                                        'label' => Yii::t('Common/Navbar','Как клиент'),
                                        'url' => ['/client/defaultClient/register/'],
                                    ],
                                    [
                                        'label' => Yii::t('Common/Navbar','Как реселлер'),
                                        'url' => ['/site/resellerClaim'],
                                    ],
                                ],
                            ],
                            [
                                'label'=> Yii::t('Common/Navbar', 'Кабинет реселлера'),
                                'url' => ['/reseller/sites/index'],
                                'visible' => AuthHelper::isReseller(),
                            ],
                            [
                                'label'=> Yii::t('Common/Navbar', 'Кабинет клиента'),
                                'url' => ['/client/campaign/index'],
                                'visible' => AuthHelper::isClient(),
                            ],
                        ],
                        'submenuHtmlOptions' => ['class' => 'dropdown-menu'],
                        'htmlOptions' => ['class' => 'nav navbar-nav'],
                    ]); ?>
                    <?php $this->widget('zii.widgets.CMenu', [
                        'submenuHtmlOptions' => ['class' => 'dropdown-menu'],
                        'htmlOptions' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            [
                                'label' => Yii::t('Common/Navbar','Язык'),
                                'url' => ['#'],
                                'itemOptions' => ['class' => 'dropdown'],
                                'linkOptions'=> [
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                ],
                                'items' => Yii::app()->urlManager->getLanguageMenuItems(),
                            ],
                            [
                                'label' => Yii::t('Common/Main','Войти'),
                                'itemOptions' => ['class' => 'dropdown'],
                                'linkOptions'=> [
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                ],
                                'url' => ['#'],
                                'visible' => Yii::app()->user->isGuest,
                                'items' => [
                                    [
                                        'label' => Yii::t('Common/Navbar','Как клиент'),
                                        'url' => ['/client/defaultClient/index'],
                                    ],
                                    [
                                        'label' => Yii::t('Common/Navbar','Как реселлер'),
                                        'url'=> ['/site/login'],
                                    ],
                                ],
                            ],
                            [
                                'label' => Yii::t('Common/Navbar','Выход') .' ('.Yii::app()->user->name.')',
                                'url' => ['site/logout'],
                                'htmlOptions' => ['class' => 'pull-right'],
                                'visible' => !Yii::app()->user->isGuest
                            ]
                        ],
                    ]); ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <?=$content;?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="copyright">
                <p>&copy; 2015 BULKRESELLER.RU</p>
            </div>
        </div>
    </footer>
<?php $this->endContent(); ?>