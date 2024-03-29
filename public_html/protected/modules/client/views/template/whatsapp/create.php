<?php
/* @var $this TemplateController */
/* @var $form CActiveForm */
/* @var $model Template */
/* @var $template WhatsappTemplate */
/* @var $sendersListData string[] */
/* @var $service Service */

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
                <i class="<?=$service->icon?>" style="color: #<?=$service->color?>;"></i> <?=Yii::t('Module/User', 'Новый шаблон')?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Название')?></label>
                <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User', 'Название')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Отправитель')?></label>
                <?php echo $form->dropDownList($template, 'sender_id', $sendersListData, ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Текстовое содержимое')?></label>
                <?php echo $form->textArea($template, 'text_content', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User', 'Текстовое содержимое')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/User', 'Файл')?></label>
                <?php echo $form->fileField($template, 'file', ['class' => 'form-control', 'placeholder' => Yii::t('Module/User', 'Файл')]); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>