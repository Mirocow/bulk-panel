<?php
/* @var $this DefaultUserController */
/* @var $model Reseller */
/* @var $form CActiveForm */
?>

<div class="container">
    <div class="row">
        <?php $this->showMessages($model) ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 well well-sm">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableAjaxValidation'=>true,
            )); ?>
                <legend><?=Yii::t('Common/Main', 'Регистрация клиента')?></legend>
                <div class="form-group">
                    <?=$form->label($model, 'login')?>
                    <?php echo $form->textField($model,'login', ['class' => 'form-control', 'placeholder' => '']); ?>
                </div>
                <div class="form-group">
                    <?=$form->label($model, 'password')?>
                    <?php echo $form->textField($model,'password', ['class' => 'form-control', 'placeholder' => '']); ?>
                </div>
                <div class="form-group">
                    <?=$form->label($model, 'name')?>
                    <?php echo $form->textField($model,'name', ['class' => 'form-control', 'placeholder' => Yii::t('Common/Main', 'Иванов Иван')]); ?>
                </div>
                <div class="form-group">
                    <?=$form->label($model, 'email')?>
                    <?php echo $form->textField($model,'email', ['class' => 'form-control', 'placeholder' => 'user@example.ru']); ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> <?=Yii::t('Common/Main', 'Зарегистрироваться')?></button>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>