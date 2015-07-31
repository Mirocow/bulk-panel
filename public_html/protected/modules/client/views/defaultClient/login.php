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
                            <?php echo $form->textField($model,'username', ['class' => 'form-control', 'placeholder' => Yii::t('Common/Main', 'Логин')]); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->passwordField($model,'password', ['class' => 'form-control', 'placeholder' => Yii::t('Common/Main', 'Пароль')]); ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <?php echo $form->checkBox($model,'rememberMe'); ?> <?=Yii::t('Common/Main','Запомнить меня')?>
                            </label>
                        </div>
                        <input class="btn btn-sm btn-success" type="submit" value="<?=Yii::t('Common/Main','Войти')?>">
                        <a href="<?=$this->createUrl('/client/defaultClient/register');?>" class="btn btn-xs btn-secondary btn-link pull-right"><?=Yii::t('Common/Main','Зарегистрироваться')?></a>
                    </fieldset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>