<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Template */
/* @var $template SmsTemplate */
/* @var $sendersListData string[] */
/* @var $service Service */
?>
<?php $this->showMessages($template); ?>
<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
        'htmlOptions' => [
            'enctype' => 'multipart/form-data',
        ],
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="<?=$service->icon?>" style="color: #<?=$service->color?>;"></i> <?=$model->name?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?=$form->label($model, 'name')?>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => 'Название']); ?>
            </div>
            <div class="form-group">
                <?=$form->label($template, 'text_content')?>
                <?php echo $form->textArea($template, 'text_content', ['class' => 'form-control', 'placeholder' => 'Текстовое содержимое']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            <a href="<?=$this->createUrl('/user/template/delete', ['id' => $model->id])?>" class="btn btn-danger pull-right delete-submit"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>