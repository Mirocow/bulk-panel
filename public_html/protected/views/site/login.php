<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */
?>

<div class="row login-form">
    <div class="col-md-4 col-md-offset-4">
        <?php $this->showMessages($model) ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?=Yii::t('Common/Main', 'Вход')?></h3>
            </div>
            <div class="panel-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableAjaxValidation'=>true,
                )); ?>
                    <fieldset>
                        <div class="form-group">
                            <?php echo $form->textField($model,'username', ['class' => 'form-control', 'placeholder' => 'Логин']); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->passwordField($model,'password', ['class' => 'form-control', 'placeholder' => 'Пароль']); ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <?php echo $form->checkBox($model,'rememberMe'); ?> <?=Yii::t('Common/Main','Запомнить меня')?>
                            </label>
                        </div>
                        <button class="btn btn-sm btn-success" type="submit"><?=Yii::t('Common/Main','Войти')?></button>
                        <a href="<?=$this->createUrl('/site/resellerClaim');?>" class="btn btn-xs btn-secondary btn-link pull-right"><?=Yii::t('Common/Main','Подать заявку')?></a>
                    </fieldset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>