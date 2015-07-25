<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Template */
/* @var $template SkypeTemplate */

?>
<?php $this->showMessages($model); ?>
<?php $this->showMessages($template); ?>
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
                <i class="fa fa-plus"></i> Создание нового шаблона
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
            <div class="form-group">
                <?=$form->label($template, 'file')?>
                <?php echo $form->fileField($template, 'file', ['class' => 'form-control', 'placeholder' => 'Файл']); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>