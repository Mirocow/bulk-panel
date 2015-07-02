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
                <a class="navbar-brand" href="<?=$this->createUrl('/site/index')?>"><i class="fa fa-envelope-o"></i> BulkReseller</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $this->widget('zii.widgets.CMenu', [
                    'items' => [
                        [
                            'label' => 'Главная',
                            'url' => ['site/index']
                        ],
                        [
                            'label' => 'Регистрация',
                            'itemOptions' => ['class' => 'dropdown'],
                            'linkOptions'=> [
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ],
                            'url' => ['#'],
                            'visible' => Yii::app()->user->isGuest,
                            'items' => [
                                [
                                    'label' => 'Как клиент',
                                    'url' => ['site/register'],
                                ],
                                [
                                    'label' => 'Как реселлер',
                                    'url' => ['site/resellerClaim'],
                                ],
                            ],
                        ],
                        [
                            'label'=>'Кабинет реселлера',
                            'url' => ['reseller/sites/index'],
                            'visible' => AuthHelper::isReseller(),
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
                            'label'=>'Войти',
                            'itemOptions' => ['class' => 'dropdown'],
                            'linkOptions'=> [
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ],
                            'url' => ['#'],
                            'items' => [
                                [
                                    'label' => 'Клиент',
                                    'url' => ['#'],
                                    'visible' => Yii::app()->user->isGuest
                                ],
                                [
                                    'label' => 'Реселлер',
                                    'url'=> ['site/login'],
                                    'visible' => Yii::app()->user->isGuest,
                                ],
                            ],
                        ],
                        [
                            'label' => 'Выход ('.Yii::app()->user->name.')',
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
<?php $this->endContent(); ?>