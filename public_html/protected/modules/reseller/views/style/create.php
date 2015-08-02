<?php
/* @var $this StyleController */
/* @var $form CActiveForm */
/* @var $model Style */
?>

<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-plus"></i> <?=Yii::t('Module/Reseller', 'Новый стиль')?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label><?=Yii::t('Module/Reseller', 'Название')?></label>
                <?php echo $form->textField($model, 'title', ['class' => 'form-control', 'placeholder' => Yii::t('Module/Reseller', 'Название')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/Reseller', 'CSS-Код')?></label>
                <?php echo $form->textArea($model, 'content', ['class' => 'form-control', 'placeholder' => Yii::t('Module/Reseller', 'CSS-Код')]); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>