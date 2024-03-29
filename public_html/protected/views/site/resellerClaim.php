<?php
/* @var $this SiteController */
/* @var $model Reseller */
/* @var $form CActiveForm */
?>
<h2><?=Yii::t('Common/Main', 'Подать заявку')?></h2>
<div class="container">
    <div class="row">
        <?php $this->showMessages($model) ?>
        <div class="col-xs-12 col-sm-12">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableAjaxValidation'=>true,
            )); ?>
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
                <?=$form->label($model, 'organization_name')?>
                <?php echo $form->textField($model,'organization_name', ['class' => 'form-control', 'placeholder' => Yii::t('Common/Main', 'ООО Рога и копыта')]); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'email')?>
                <?php echo $form->textField($model,'email', ['class' => 'form-control', 'placeholder' => 'admin@ultrasms.ru']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'phone')?>
                <?php echo $form->textField($model,'phone', ['class' => 'form-control', 'placeholder' => '+79031234500']); ?>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-lg btn-success" type="submit"><i class="fa fa-check"></i> <?=Yii::t('Common/Main', 'Отправить заявку')?></button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>