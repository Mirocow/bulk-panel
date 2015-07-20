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
                <i class="fa fa-pencil"></i> <?=$model->title?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'title')?>
                <?php echo $form->textField($model, 'title', ['class' => 'form-control', 'placeholder' => 'Название стиля']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($model, 'content')?>
                <?php echo $form->textArea($model, 'content', ['class' => 'form-control', 'placeholder' => 'CSS-Код']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/reseller/style/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>