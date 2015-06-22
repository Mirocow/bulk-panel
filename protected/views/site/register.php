<?php
/* @var $this SiteController */
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
                <legend>Регистрация</legend>
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
                    <?php echo $form->textField($model,'name', ['class' => 'form-control', 'placeholder' => 'Иванов Иван']); ?>
                </div>
                <div class="form-group">
                    <?=$form->label($model, 'email')?>
                    <?php echo $form->textField($model,'email', ['class' => 'form-control', 'placeholder' => 'admin@ultrasms.ru']); ?>
                </div>
                <button class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-check"></i> Зарегистрироваться</button>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>