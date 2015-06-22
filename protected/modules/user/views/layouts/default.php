<?php
    /* @var $this DefaultUserController */
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
                <a class="navbar-brand" href="#"><?=$this->site->title?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Вход', 'url'=>array('/user/defaultUser/index')),
                        array('label'=>'Регистрация', 'url'=>array('/user/defaultUser/register')),
                    ),
                    'htmlOptions' => ['class' => 'nav navbar-nav'],
                )); ?>
                <?php /*$this->widget('zii.widgets.CMenu', [
                    'items' => [
                        array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'htmlOptions' => ['class' => 'pull-right'], 'visible'=>!Yii::app()->user->isGuest)
                    ],
                    'htmlOptions' => ['class' => 'nav navbar-nav pull-right'],
                ]); */?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        <?=$content;?>
    </div>
<?php $this->endContent(); ?>